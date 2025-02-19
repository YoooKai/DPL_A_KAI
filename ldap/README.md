### LDAP

Para documentar la instalación y configuración de LDAP (Lightweight Directory Access Protocol) en Ubuntu Server puedes seguir los siguientes pasos:

### 1. **Preparación del Entorno**

- **Requisitos:**
  - **Servidor:** Ubuntu Server 22.04 LTS.
  - **Cliente:** Ubuntu Desktop (para pruebas).
  - **Conectividad:** Asegúrate de que el servidor y el cliente tengan conectividad entre sí y acceso a Internet.
  - **Configuración de Red:** Configura los adaptadores de red en el servidor (uno en NAT para Internet y otro en red interna para la LAN).

### 2. **Configuración del Hostname y DNS**

- **Cambiar el Hostname del Servidor:**
  ```bash
  sudo hostnamectl set-hostname ldap-server.local
  ```
- **Editar el archivo `/etc/hosts`:**
  ```bash
  sudo nano /etc/hosts
  ```
  Añade la siguiente línea:
  ```
  192.168.1.8 ldap-server.local
  ```

### 3. **Actualización del Sistema**

- Actualiza los repositorios y el sistema:
  ```bash
  sudo apt update && sudo apt upgrade -y && sudo apt dist-upgrade -y
  ```

### 4. **Instalación de OpenLDAP**

- Instala los paquetes necesarios:
  ```bash
  sudo apt install slapd ldap-utils -y
  ```
- Durante la instalación, se te pedirá configurar una contraseña para el administrador de LDAP.

### 5. **Configuración Básica de OpenLDAP**

- Reconfigura `slapd`:
  ```bash
  sudo dpkg-reconfigure slapd
  ```
  - **Omitir configuración inicial:** No.
  - **Nombre del dominio DNS:** `ldap-server.local`.
  - **Nombre de la organización:** `ldap-server`.
  - **Contraseña de administrador:** `cursos1`.
  - **Base de datos:** H2.
  - **Borrar base de datos al purgar:** Sí.
  - **Mover base de datos antigua:** Sí.

### 6. **Verificación de la Configuración**

- Verifica la configuración con:
  ```bash
  sudo slapcat
  ```
  Deberías ver la información del dominio `ldap-server.local`.

### 7. **Creación de Estructuras en LDAP**

- **Crear una Unidad Organizativa (OU):**

  - Crea un archivo `ou.ldif`:
    ```bash
    sudo nano ou.ldif
    ```
    Contenido:
    ```
    dn: ou=informatica,dc=ldap-server,dc=local
    objectClass: top
    objectClass: organizationalUnit
    ou: informatica
    ```
  - Importa la OU:
    ```bash
    sudo ldapadd -x -D "cn=admin,dc=ldap-server,dc=local" -W -f ou.ldif
    ```

- **Crear un Grupo:**

  - Crea un archivo `grupo.ldif`:
    ```bash
    sudo nano grupo.ldif
    ```
    Contenido:
    ```
    dn: cn=informatica,ou=informatica,dc=ldap-server,dc=local
    objectClass: top
    objectClass: posixGroup
    cn: informatica
    gidNumber: 10000
    ```
  - Importa el grupo:
    ```bash
    sudo ldapadd -x -D "cn=admin,dc=ldap-server,dc=local" -W -f grupo.ldif
    ```

- **Crear un Usuario:**
  - Crea un archivo `usuario.ldif`:
    ```bash
    sudo nano usuario.ldif
    ```
    Contenido:
    ```
    dn: uid=clockworker,ou=informatica,dc=ldap-server,dc=local
    objectClass: top
    objectClass: account
    objectClass: posixAccount
    objectClass: inetOrgPerson
    cn: clockworker
    uid: clockworker
    uidNumber: 2000
    gidNumber: 10000
    homeDirectory: /home/clockworker
    loginShell: /bin/bash
    userPassword: cursos1
    sn: worker
    mail: clockworker@ldap-server.local
    givenName: clockworker
    ```
  - Importa el usuario:
    ```bash
    sudo ldapadd -x -D "cn=admin,dc=ldap-server,dc=local" -W -f usuario.ldif
    ```

### 8. **Configuración del Cliente LDAP**

- **Instalación de Paquetes en el Cliente:**
  ```bash
  sudo apt install ldap-utils libnss-ldap libpam-ldap -y
  ```
- **Configuración del Cliente:**

  - Durante la instalación, se te pedirá:
    - **URI del servidor LDAP:** `ldap://192.168.1.8`.
    - **Nombre del dominio LDAP:** `ldap-server.local`.
    - **Versión de LDAP:** 3.
    - **Usuario administrador:** `cn=admin,dc=ldap-server,dc=local`.
    - **Contraseña:** `cursos1`.

- **Editar `/etc/nsswitch.conf`:**

  ```bash
  sudo nano /etc/nsswitch.conf
  ```

  Cambia las líneas `passwd`, `group`, y `shadow` para incluir `ldap`:

  ```
  passwd:         compat ldap
  group:          compat ldap
  shadow:         compat ldap
  ```

- **Editar `/etc/pam.d/common-session`:**
  ```bash
  sudo nano /etc/pam.d/common-session
  ```
  Añade la siguiente línea al final:
  ```
  session optional pam_mkhomedir.so skel=/etc/skel umask=077
  ```

### 9. **Verificación del Cliente**

- **Verificar la Conexión LDAP:**
  ```bash
  ldapsearch -x -H ldap://192.168.1.8 -b "dc=ldap-server,dc=local"
  ```
- **Iniciar Sesión con el Usuario LDAP:**
  ```bash
  su - clockworker
  ```
  Deberías poder iniciar sesión con el usuario `clockworker`.

### 10. **Configuración de la Sesión Gráfica**

- **Instalar `libnss-ldapd`:**
  ```bash
  sudo apt install libnss-ldapd -y
  ```
- **Reiniciar el Sistema:**
  ```bash
  sudo reboot
  ```
- **Iniciar Sesión Gráfica:** Después del reinicio, deberías poder iniciar sesión gráfica con el usuario `clockworker`.

### 11. **Modificación y Eliminación de Entradas**

- **Modificar un Usuario:**

  - Crea un archivo `modificar.ldif`:
    ```bash
    sudo nano modificar.ldif
    ```
    Contenido:
    ```
    dn: uid=clockworker,ou=informatica,dc=ldap-server,dc=local
    changetype: modify
    replace: mail
    mail: nuevo@ldap-server.local
    ```
  - Aplica los cambios:
    ```bash
    sudo ldapmodify -x -D "cn=admin,dc=ldap-server,dc=local" -W -f modificar.ldif
    ```

- **Eliminar un Usuario:**
  ```bash
  sudo ldapdelete -x -D "cn=admin,dc=ldap-server,dc=local" -W "uid=clockworker,ou=informatica,dc=ldap-server,dc=local"
  ```

### 12. **Búsqueda en el Directorio**

- **Buscar Usuarios:**

  ```bash
  ldapsearch -x -H ldap://192.168.1.8 -b "dc=ldap-server,dc=local" "(uid=clockworker)"
  ```

- Con estos pasos, habrás configurado un servidor LDAP en Ubuntu Server y un cliente Ubuntu para autenticarse contra este servidor. Asegúrate de que todos los parámetros de red y configuración estén correctamente ajustados para evitar errores.

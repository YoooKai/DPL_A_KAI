
# Instalar certificado Let's Encrypt con certbot en ngink con host virtuales

### **Paso 1: Instalar Certbot (herramienta de Let's Encrypt)**

1. **Agregar el repositorio de Certbot**:
   El primer paso es añadir el repositorio oficial de Certbot a tu sistema. Esto permite instalar la versión más reciente de Certbot desde los repositorios de Ubuntu.

   ```bash
   sudo add-apt-repository ppa:certbot/certbot
   ```

2. **Actualizar los paquetes**:
   Después de agregar el repositorio, es necesario actualizar la lista de paquetes disponibles en tu sistema para que se pueda instalar la versión más reciente de Certbot.

   ```bash
   sudo apt update
   ```

3. **Instalar Certbot y el plugin de NGINX**:
   Ahora se instala **Certbot** y el plugin específico para **NGINX**, que se encarga de automatizar la configuración de SSL para tu servidor web NGINX.

   ```bash
   sudo apt install python3-certbot-nginx
   ```

   Aquí se utiliza **python3-certbot-nginx** en lugar de **python-cerbot-nginx**, ya que es la versión más actual compatible con Python 3.

### **Paso 2: Configurar el servidor NGINX**

1. **Editar la configuración del servidor NGINX**:
   Accede al directorio donde se encuentran los archivos de configuración de NGINX. En este directorio puedes definir cómo se manejan las solicitudes HTTP y HTTPS para tu dominio.

   ```bash
   cd /etc/nginx/sites-available
   ```

   Luego, edita o crea un archivo de configuración para tu dominio, por ejemplo **example.conf**, con la siguiente estructura:

   ```nginx
   server {
       listen 80;
       listen [::]:80;

       root /usr/share/nginx/html;  # Este es el directorio donde se encuentra tu página web
       index index.php index.html index.htm;

       server_name example.staging.keetup.com;  # Sustituye este dominio con el tuyo
   }
   ```

   **Nota**: Asegúrate de usar la ruta correcta para el directorio `root` y de colocar el dominio adecuado en `server_name`.

2. **Crear el enlace simbólico**:
   Para que la configuración que acabas de crear sea activada por NGINX, necesitas crear un enlace simbólico (un "link" hacia el archivo de configuración) en el directorio **sites-enabled**, que es donde NGINX carga las configuraciones activas.

   ```bash
   ln -s /etc/nginx/sites-available/example.conf /etc/nginx/sites-enabled/
   ```

   Aquí, `example.conf` es el archivo de configuración que creaste para tu dominio.

3. **Comprobar la configuración de NGINX**:
   Antes de reiniciar NGINX, es recomendable verificar que no haya errores en la configuración.

   ```bash
   sudo nginx -t
   ```

   Si todo está bien, el sistema mostrará un mensaje de éxito. Si hay algún error, NGINX te indicará dónde se encuentra.

4. **Recargar la configuración de NGINX**:
   Si la configuración es correcta, puedes recargar NGINX para que se apliquen los cambios:

   ```bash
   sudo systemctl reload nginx
   ```

### **Paso 3: Habilitar el firewall para HTTPS**

1. **Verificar el estado del firewall**:
   Es importante asegurarse de que el firewall permita el tráfico en los puertos de NGINX, tanto para HTTP (puerto 80) como para HTTPS (puerto 443).

   ```bash
   sudo ufw status
   ```

2. **Permitir el tráfico para NGINX completo**:
   Si no está habilitado el tráfico en el puerto 443 (HTTPS), puedes habilitarlo usando:

   ```bash
   sudo ufw allow 'Nginx Full'
   ```

   Esto abre tanto el puerto 80 (HTTP) como el puerto 443 (HTTPS) para que NGINX pueda servir contenido de manera segura.

3. **Verificar el estado del firewall de nuevo**:
   Después de permitir el tráfico, puedes volver a comprobar que se hayan habilitado correctamente los puertos para NGINX.

   ```bash
   sudo ufw status
   ```

### **Paso 4: Obtener el certificado SSL con Certbot**

1. **Generar el certificado SSL**:
   Para obtener el certificado SSL de **Let's Encrypt** para tu dominio, puedes ejecutar el siguiente comando:

   ```bash
   sudo certbot --nginx
   ```

   Este comando le dice a Certbot que use el plugin de NGINX para obtener y configurar el certificado SSL automáticamente. Durante el proceso, Certbot:

   - Detecta tu dominio.
   - Solicita el certificado a Let's Encrypt.
   - Configura automáticamente NGINX para que use HTTPS.

2. **Seleccionar el dominio**:
   Certbot te mostrará una lista de los dominios configurados en NGINX. Solo tienes que elegir el número correspondiente al dominio para el cual deseas generar el certificado.

3. **Redirigir todo el tráfico a HTTPS**:
   Certbot te preguntará si deseas redirigir automáticamente el tráfico HTTP a HTTPS (lo cual es muy recomendable). Es importante que selecciones **Sí** para garantizar que todo el tráfico se cifre.

4. **Verificación**:
   Una vez completado el proceso, Certbot configurará el certificado SSL para tu dominio, y el servidor NGINX comenzará a servir tu sitio web a través de HTTPS. Ahora, al visitar tu sitio, deberías ver un candado verde junto a la URL en el navegador, lo que indica que la conexión es segura.



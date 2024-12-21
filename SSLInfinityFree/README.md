

## **1. Generar la clave privada**  
```bash
sudo openssl genrsa -out dpl.certificado.rsa.key
```

- **`openssl genrsa`**: Este comando genera una **clave privada RSA**.  
- **`-out dpl.certificado.rsa.key`**: Guarda la clave en un archivo llamado `dpl.certificado.rsa.key`.  

La **clave privada** es un archivo importante, ya que:
- Se utiliza para firmar otros archivos (como el CSR o certificado).
- Debe mantenerse **segura y privada**, ya que quien la posea puede hacerse pasar por ti.

---

## **2. Generar una solicitud de firma de certificado (CSR)**  
```bash
sudo openssl req -new -key dpl.certificado.rsa.key -out dpl.certificado.rsa.csr
```

- **`openssl req -new`**: Crea una nueva **solicitud de firma de certificado (Certificate Signing Request o CSR)**.  
- **`-key dpl.certificado.rsa.key`**: Usa la clave privada generada previamente (`dpl.certificado.rsa.key`) para firmar la solicitud.  
- **`-out dpl.certificado.rsa.csr`**: Guarda el CSR en un archivo llamado `dpl.certificado.rsa.csr`.

###  **CSR**
- Es un archivo que contiene información sobre tu entidad (como nombre, organización, país, etc.).
- Es utilizado para solicitar un **certificado digital** a una autoridad de certificación (CA).  
- El CSR **no contiene la clave privada** pero está firmado con ella, de modo que demuestra que posees la clave.

Durante este paso, se te pedirá que completes información como:
- **Common Name**: Generalmente el dominio o subdominio (ejemplo: `www.tusitio.com` o `localhost`).
- **Organization Name**: Nombre de tu organización.
- **Country**:  `ES` para España
- Otros datos opcionales.

---

## **3. Generar un certificado autofirmado (CRT)**  
```bash
sudo openssl x509 -req -days 365 -in dpl.certificado.rsa.csr -signkey dpl.certificado.rsa.key -out dpl.certificado.rsa.crt
```

- **`openssl x509`**: Comando para manejar certificados X.509 (el formato estándar de certificados digitales).
- **`-req`**: Especifica que se usará una solicitud CSR para generar el certificado.
- **`-days 365`**: Define la validez del certificado en **365 días**.
- **`-in dpl.certificado.rsa.csr`**: Utiliza el CSR creado previamente como entrada.
- **`-signkey dpl.certificado.rsa.key`**: Firma el certificado usando la clave privada `dpl.certificado.rsa.key`.
- **`-out dpl.certificado.rsa.crt`**: Guarda el certificado generado en el archivo `dpl.certificado.rsa.crt`.

### Certificado autofirmado
- Un certificado autofirmado (self-signed) es un certificado que **tú mismo has firmado** en lugar de usar una autoridad de certificación externa (como Let's Encrypt o DigiCert).
- Es útil para pruebas locales, servidores de desarrollo o uso personal, **pero no es confiable públicamente**.
- Contiene tu **clave pública** y la información de tu CSR.

---

## **Archivos Generados**
1. **Clave privada** (`dpl.certificado.rsa.key`): Archivo **secreto** que debes proteger.  
2. **CSR** (`dpl.certificado.rsa.csr`): Solicitud de firma que se usa para crear el certificado.  
3. **Certificado** (`dpl.certificado.rsa.crt`): Certificado digital que se usará para **autenticar tu servidor o aplicación**.

<img src="img/3.png">
<img src="img/4.png">
---

## **Subir la clave privada**
Cuando necesitas subir una **Private Key y Certificate** en un sistema (por ejemplo, un servidor web, como Apache, Nginx o un panel de hosting), se refiere a lo siguiente:

Por ejemplo, en el caso de **InfinityFree**, tenemos que crear un dominio, damos click en 'manage', y allí, en `SSL certificate`. En este apartado, podemos hacer click a  "Add SSL Certificate" par añadirlo.

<img src="img/1.png">

Al hacer click, nos aparecen varias opciones. Hacemos click en `Upload Private Key and Certificate`:

<img src="img/2.png">

Ahora rellenamos las áreas de texto con:


1. **Private Key**: Copia y pega el contenido del archivo `dpl.certificado.rsa.key`.  
   Puedes visualizar su contenido con:  
   ```bash
   sudo cat dpl.certificado.rsa.key
   ```
   El contenido tendrá un formato como este:  
   ```
   -----BEGIN RSA PRIVATE KEY-----
   MIICXgIBAAKBgQC4w...
   -----END RSA PRIVATE KEY-----
   ```

2. **Certificate**: Copia y pega el contenido del archivo `dpl.certificado.rsa.crt`.  
   Puedes visualizar su contenido con:  
   ```bash
   sudo cat dpl.certificado.rsa.crt
   ```
   El certificado tendrá un formato como este:  
   ```
   -----BEGIN CERTIFICATE-----
   MIIDdzCC...
   -----END CERTIFICATE-----
   ```



<img src="img/5.png">
<img src="img/6.png">

Ahora, le damos a "Install SSL Certificate Automatically"

Y ya tendremos el certificado instalado en nuestro servidor web.

Para comprobarlo accedemos a nuestro dominio en el navegador utilizando `https://nombrededominio.com`



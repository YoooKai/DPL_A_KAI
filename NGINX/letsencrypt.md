
# Instalar certificado Let's Encrypt con certbot en ngink con host virtuales
Aquí tienes los pasos para configurar un nuevo host virtual **empresa4** desde cero en Nginx e instalar un certificado SSL con Let's Encrypt usando Certbot:

### **1. Crear el Directorio del Sitio Web**
Crea el directorio donde se almacenarán los archivos del sitio de `empresa4` (podemos usar otro host que ya tengamos creado, pero yo crearé otro nuevo):

```bash
sudo mkdir -p /var/www/empresa4/html
```

Asigna permisos apropiados:
```bash
sudo chown -R $root:$root /var/www/empresa4/html
sudo chmod -R 755 /var/www/empresa4
```

Crea un archivo de prueba en la raíz del sitio:
```bash
cd /var/www/empresa4/html

touch index.html

sudo nano index.html
```

Escribimos lo que sea, por ejemplo:

`<h1>Hola, soy empresa4</h1>`

---

### **2. Crear el Archivo de Configuración de Nginx**
Crea un nuevo archivo de configuración para `empresa4`:
```bash
sudo nano /etc/nginx/sites-available/empresa4
```

Agrega lo siguiente al archivo:

```nginx
server {
    listen 80;
    server_name empresa4.com www.empresa4.com;

    root /var/www/empresa4/html;
    index index.html;

    location / {
        try_files $uri $uri/ =404;
    }
}
```

Guarda y cierra el archivo.

---

### **3. Habilitar el Host Virtual**
Habilita el archivo de configuración creando un enlace simbólico en `sites-enabled`:
```bash
sudo ln -s /etc/nginx/sites-available/empresa4 /etc/nginx/sites-enabled/
```

Verifica la configuración de Nginx:
```bash
sudo nginx -t
```

Reinicia Nginx:
```bash
sudo systemctl reload nginx
```

---

### **4. Configurar el Archivo `/etc/hosts`**
Si estás configurando este host en un entorno local para pruebas, agrega el dominio a tu archivo `/etc/hosts`:
```bash
sudo nano /etc/hosts
```

Añade las siguientes líneas:
```
127.0.0.1 empresa4.com www.empresa4.com
```

Guarda y cierra el archivo.

---

## Hasta aquí, es lo mismo que hemos hecho anteriormente.

### **5. Instalar Certbot y Obtener el Certificado SSL**
Si no tienes Certbot instalado, instálalo:
```bash
sudo apt update
sudo apt install certbot python3-certbot-nginx
```

Ejecuta Certbot para configurar SSL para `empresa4`:
```bash
sudo certbot --nginx
```

Sigue las instrucciones:
1. Certbot detectará automáticamente tu configuración de Nginx.
2. Selecciona el dominio (`empresa4.com` y `www.empresa4.com`) para el que deseas instalar el certificado.
3. Certbot actualizará automáticamente el archivo de configuración de Nginx para usar SSL.

---

### **6. Verificar el Certificado**
Accede a `https://empresa4.com` en un navegador para verificar que el certificado está funcionando.

También puedes usar:
```bash
curl -I https://empresa4.com
```

---

### **7. Configuración Final (Redirección a HTTPS)**
Edita el archivo de configuración de Nginx para redirigir todo el tráfico HTTP a HTTPS:
```bash
sudo nano /etc/nginx/sites-available/empresa4
```

Actualiza el contenido a:

```nginx
server {
    listen 80;
    server_name empresa4.com www.empresa4.com;
    return 301 https://$host$request_uri; # Redirección a HTTPS
}

server {
    listen 443 ssl;
    server_name empresa4.com www.empresa4.com;

    ssl_certificate /etc/letsencrypt/live/empresa4.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/empresa4.com/privkey.pem;

    root /var/www/empresa4/html;
    index index.html;

    location / {
        try_files $uri $uri/ =404;
    }
}
```

Reinicia Nginx:
```bash
sudo systemctl reload nginx
```

---

### **8. Renovación Automática**
Verifica que Certbot haya configurado la renovación automática:
```bash
sudo systemctl list-timers | grep certbot
```

Prueba la renovación manualmente:
```bash
sudo certbot renew --dry-run
```


#
Crear carpetas de prueba 
```sh
sudo mkdir /var/www/prueba1.com/public
sudo mkdir /var/www/prueba2.com/public
```
Crear archivos html dentro de las carpetas
```sh
sudo nano /var/www/prueba1.com/public/index.html
sudo nano /var/www/prueba2.com/public/index.html
```

```sh
sudo chown -R www-data: /var/www/prueba1.com/public
sudo chown -R www-data: /var/www/prueba2.com/public
```

Virtualhosts

```sh
sudo cd /etc/apache2/sites-available
```                          
<VirtualHost *:80>
        ServerName prueba2.com
        ServerAlias www.prueba2.com
        ServerAdmin webmaster@prueba2.com
        DocumentRoot /var/www/html/prueba2.com/public
        <Directory /var/www/html/prueba2.com/public>
                options -Indexes +FollowSymlinks
                AllowOverride All
        </Directory>
        Errorlog ${APACHE_LOG_DIR}/prueba2.com-error.log
        CUSTOMLOG ${APACHE_LOG_DIR}/prueba1.com-access.log combined
</VirtualHost>


Habilitar sitios
```sh
a2ensite prueba1.com
a2ensite prueba2.com
sudo systemctl restart apache2
```
Configuracion del config de apache
```sh
sudo nano /etc/apache2/apche2.conf
```

ServerName localhost

Editar fichero /etc/hosts

127.0.0.1   prueba1.com
127.0.0.1   www.prueba1.com
127.0.0.1   prueba2.com
127.0.0.1   www.prueba2.com
```sh
```

sudo systemctl restart NetworkManager

Generar clave:
sudo openssl genrsa -out "server_key" 2048

Ver la clave:
sudo cat server_key

# en /etc/apache2/ssl
sudo openssl req -new -key server_key -out servercsl

sudo openssl x509 -req days 365 -in server

sudo cp default-ssl.comf copia-default-ssl.conf

Asegurarse de que SSLEngine está on

sudo nano default-ssl.conf

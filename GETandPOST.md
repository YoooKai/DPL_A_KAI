## Documenta en Github los métodos de paso de variables de formularios GET y POST enumerando los pasos a realizar. El documento debe tener un ejemplo de paso de dichas variables.


Cuando un usuario rellena un formulario en una página web los datos hay que enviarlos de alguna manera. Existen dos formas de envío de datos posibles: usando el método POST o usando el método GET. AMbos son métodos del protocolo HTTP, el cual está compuesto po un envío al servidor, conocido como petición, y una respuesta a dicha solicitud.

Las similitudes y las diferencias son los siguientes:

## GET

lleva los datos de forma "visible" al cliente (navegador web). El medio de envío es la URL y los datos los puede ver cualquiera.
Por ejemplo:
www.paginaweb.com/action.php?nombre=pepe&apellidos1=rodriguez
La longitud de la petición de GET está limitada.
Se pasa información al servidor en forma de atributo-valor, o añadiendo al final de la URL detrás de un símbolo de interrogación.

## POST

POST consiste en datos "ocultos" (porque el cliente no los ve) enviados por un formulario cuyo método de envío es post. Es adecuado para formularios. Los datos no son visibles.
Se puede utilizar para pasar información al servidor: en forma de pares atributo-valor o incluidos en el cuerpo de la petición. Este método no tiene limitación de espacio y se puede enviar mucha más información al servidor.

# Prueba con método GET.

1. En primer lugar debemos tener abierto XAMPP, utilizando el comando que anteriormente hemos utilizado.
<img src="img/pa1.png">
Y encendemos los servidores.
<img src="img/pa2.png">

2. Escribimos un formulario en un archivo **index**.php.
<img src="img/pa3.png">

3. Creamos otro archivo, por ejemplo get-post.php
Método get:
EN primer lugar, para indicar el método, tenemos que poner en el formulario la etiqueta method="GET"
<img src="img/1p.png">
Y la etiqueta action="nombre.php.php" tenemos que poner el nombre del archivo en el que tenemos el código php, ya que los datos del formulario serán enviados a este cuando le demos al botón de enviar.

En el archivo PHP usamos la variable $_GET para conseguir el valor de la cadena de la consulta, como por ejemplo:
Ponemos el nombre del dato que queremos que recupere.
<img src="img/3p.png">

4. Ahora, escribimos en el navegador localhost/ seguido de la ubicación del archivo index, por ejemplo:
<img src="img/dire.png">

5. Nos saldrá el formulario. Ahora, rellenamos la información y le damos al botón de enviar.
<img src="img/pa4.png">
<img src="img/pa50.png">

6. Nos redirigirá al documento get.php donde veremos los datos que hemos sacado del formulario.
<img src="img/pa5.png">

Pero hay que tener en cuenta que también se ven los datos en la url.
<img src="img/pa6.png">

# Prueba con método POST.

1. De nuevo, tenemos que tener abierto el XAMPP y los servidores activos.
2. La creación del formulario es lo mismo, excepto que esta vez, cambiamos el valor de la etiqueta method, y en lugar de get, escribimos POST.
Esta vez, vamos a utilizar un input de subida de archivos.

<img src="img/post1.png">

3. EN el otro archivo php, lo único que cambia, es que la variable para conseguir la cadena de la consulta es $_POST.

<img src="img/post2.png">

Algunas aclaraciones:
- La etiqueta **pre** sirve para mantener el formato de los datos impresos en HTML.
- Se hace uso del **echo** para hacer uso de las etiquetas html, como por ejemplo **br**
- EL **($_FILES ['fichero']['name']);** imprime el nombre del fichero, y name accede al campo name en el fihcero.

4. Escribimos la localización del index en el navegador como hicimos anteriormente.
<img src="img/post555.png">

5. Nos aparecerá el formulario. Rellenamos y seleccionamos un archivo.
<img src="img/post3.png">
<img src="img/post4.png">

6. Y vemos cómo nos da la información que solicitamos. Esta vez, sin mostrar los datos en la URL.
<img src="img/post6.png">


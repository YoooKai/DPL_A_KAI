# Redireccionamiento de páginas en PHP

1. En primer lugar, es necesario tener abierto XAMPP y los servidores encendidos. 

2. Es iimportante también tener la carpita con los archivos en los que vayamos a trabajar en la carpeta opt/lampp/htdocs para poder abrirlos en el navegador con localhost.

<img src="img/r0.png">

3. Creamos un documento, que voy a llamar redirecciones.php. Escribimos la estructura de HTML (pulsando ! + ENTER), y escribimos un enlace hacia una "pagiina2.php".

<img src="img/r2.png">

4. Creamos la página "pagina2.php". En ella, hacemos un echo indicando que se trata de la página 2.

<img src="img/r1.png">

5. Abrimos recireciones.php en el navegador mediante localhost.

<img src="img/r3.png">

6. Le damos click al enlace, y vemos que nos dirige hacia la página 2.
<img src="img/r4.png">

7. Ahora vamos a redirigir a la página 3 utilizando la etiqueta header, escribiendo lo siguiente:

<img src="img/r5.png">

8. Creamos la página 3 a la que queremos que nos rediriga la página 2, de nuevo escribiendo un echo.

<img src="img/r6.png">

9. De nuevo abrimos la página de redirecciónes.

<img src="img/r3.png">

10. Al darle click, vemos que nos encontramos en la pagina3.php, porque nos ha redirigido la página 2 directamente.

<img src="img/r8.png">

11. También podemos pasarle parámetros, como por ejemplo, el nombre.

<img src="img/r99.png">

12. Para mostrar esta información en pantalla, escribimos en la página 2 `print_r($_GET);`. Y comentamos la línea del header.

<img src="img/r9.png">

13. Ahora al dar click en redireccionar, nos muestra los datos.

<img src="img/r3.png">
<img src="img/r10.png">

14. También podemos mandar los datos directamente desde el servidor con php a la página 3.

<img src="img/r11.png">

15. Para imprimir la información, de nuevo hacemo sun print de GET.

<img src="img/r12.png">

16. Al dar click al enlace esta vez, vamos como ha funcionado como esperábamos.

<img src="img/r3.png">
<img src="img/r13.png">
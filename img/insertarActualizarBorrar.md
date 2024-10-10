
# INSERCIÓN DE DATOS

Para insertar datos a nuestra tabla primero asignamos una variable a una consulta SQL, que incluya "insert into users", (los campos que vamos a rellenar) values (los valores que queremos añadir a esos campos).
Por ejemplo:

`$insert = "insert into users(name, email) values ('pepe', 'pepebrito@gmail.com')";`

La fecha y el id se añadirán automáticamente.

Para ejecutar una consulta, utilizamos la instrucción `mysqli_query`, y le pasamos la conexión y la consulta que queremos ejecutar.
Lo guardamos en una variable.

`$return = mysqli_query($con, $insert);`

Hademos un print, que devolverá true o false para saber si ha ido bien o no la consulta.
`print_r(($return));`

Y por último, cerramos la conexión para evitar problemas de rendimiento y de memoria.
`mysqli_close($con);`

<img src="img/con/con66.png">

Ahora tenemos que abrir el documento en el navegador. Veremos un 1, que representa true, lo que quiere decir que ha funcionado.

<img src="img/con/con77.png">

Vamos a myadminphp, a la base de datos, y efectivamente, se han añadido los datos.
<img src="img/con/con88.png">

De nuevo realizamos otra inseción modificando los datos, y de nuevo, abrimos el documento en localhost. Se añade la nueva información.

<img src="img/con/con99.png">
<img src="img/con/1000.png">


# Lectura de Datos
En primer lugar, creamos un nuevo fichero, `leer.py`, y, como antes, realizamos la conexión con la base de datos.
Ahora asignamos a una variable una consulta sql de select con los datos que queramos sacar de la tabla.

`$con = mysqli_connect('localhost', 'root', '', 'PRUEBITA');`

Y otra variable para mandar la consulta a la base de datos utilizando la instrucción `mysqli_query`. En este caso, le pasamos la conexión y la consulta:

 `$result = mysqli_query($con, $sql);`

 Por último, guardamos en otra variable la instrucción `mysqli_fetch_array`, la cual guarda la información en los índices numéricos del array resultante, también puede guardar la información en índices asociativos utilizando los nombres de los campos del resultado como claves.

Se le puede pasar un parámetro opcional llamado resulttype. Este parámetro es una constante que indica qué tipo de array debiera generarse con la información de la fila actual. Los valores posibles para este parámetro son las constantes `MYSQLI_ASSOC`, `MYSQLI_NUM`, o `MYSQLI_BOTH`. 

Ahora vamos a probar el `MYSQLI_NUM`.Las columnas son devueltas en el array teniendo un índice enumerado. 

Al abrir el documento en el navegador en localhost, vemos que nos muestra el primer registro. Esto es porque necesitamos un bucle para mostrar todos.

<img src="img/con/leer2.png">

Con un bucle `do...while`

<img src="img/con/leer3.png">

Ahora vemos los dos registros que insertamos anteriormente:

<img src="img/con/leer4.png">

Ya que nos muestra todos los registros, vamos a cambiar el parámetro de tipo, esta vez, `MYSQLI_ASSOC`. COn este parámetro, las columnas son devueltas en el array teniendo el nombre del campo como índice del array. 

<img src="img/con/leer6.png">
<img src="img/con/leer5.png">

Y ahora, cambiemos el parámetro a `MYSQLI_BOTH`. Con este, las columnas son devueltas en el array teniendo tanto un índice numérico y el nombre del campo como el índice asociativo. 

<img src="img/con/leer7.png">
<img src="img/con/leer8.png">

Y ya, por último, es importante recordar que se debe cerrar la conexión, por lo que escribiremos al final del fichero `MYSQLI_CLOSE($con)`

<img src="img/con/leer9.png">

# ACTUALIZAR DATOS

El procedimiento para actualizar datos es muy similar a los anteriores.
Primero, creamos un fichero `update.php`. En este, guardamos la conexión en una variable nuevamente. 
Luego, guardamos una consulta en otra variable. Esta se usará para actualizar los datos de la tabla. Por ejemplo:

`$update = "UPDATE users SET name = 'Carmela" WHERE id = 1"`

Y otra variable que haga la petición a la que le pasemos la conexión y la consulta:
`$result = mysqli_queri($con, $update);`

E imprimimos el return, para ver si se ha hecho o no. 

Al abrir el documento en el navegador, vemos un 1, es decir, que se ha realizado la consulta.

<img src="img/con/up2.png">

Y efectivamente, ha cambiado el nombre de pepe por carmela.


<img src="img/con/up3.png">

También podemos modificar tantos campos como queramos. Vamos a cambiar el nombre y el email en la misma consulta:

<img src="img/con/up4.png">

Y de nuevo, se han cambiado los datos.

<img src="img/con/up5.png">

# BORRAR DATOS

Para eliminar los datos de las tablas, es lo mismo que lo anterior, pero cambiamos la consulta. Esta será una consulta de delete sql. Por ejemplo, borraremos la primera inserción.

`$delete = "DELETE FROM users WHERE id = 1;"`

Como antes, pasamos las instrucciones.

<img src="img/con/del1.png">

Recibimos un 1, es decir, ha funcionado.

<img src="img/con/del2.png">

COmprobamos que ya no tenemos la primera inserción.

<img src="img/con/del3.png">


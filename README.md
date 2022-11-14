# Trabajo práctico - segunda entrega

## Introducción

Este proyecto nace como respuesta a las consignas determinadas por la catedra Web II de la carrera Tecnicatura Universitaria en Desarrollo de Aplicaciones Informáticas (TUDAI) de  la Universidad Nacional del Centro de la Pcia. de Bs. As. (UNICEN). En el marco del proyecto trabajo práctico (segunda entrega).


## Descripción

El servicio permite listar los estudiantes pertenecientes a una institución escolar cuya base de datos se encuentra almacenada en db_escuela. Permite agregar, editar y eliminar diferentes registros. A su vez, es posible realizar consultas filtrando por campo : ndni (número de dni), nombre, direccion, telefono, curso, division. Permitiendo realizar un paginado y un ordenamiento de forma ascendente o descendente.



## API Métodos
Esta Api esta creada con el objetivo de que sea RESTful, por lo que usa los métodos HTTP. Mediante GET se accede a los recursos, POST para agregar, PUT modificar datos y DELETE para eliminar.
El formato de transferencia es en JSON.

### Endpoints
Los endpoints en nuestra API permitirán acceder a los recursos con la finalidad de consultar, paginar, ordenar y filtrar datos.
Los cuales son:

http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students

http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students/:ID


|Request| Método| Endpoint|Status|
|------|------|-----------------------------------|------|
|Obtener estudiantes| GET| http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students | 200 |
|Obtener estudiante| GET| http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students/:ID |200 |
|Crear estudiante| POST | http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students | 201 |
|Editar estudiante| PUT | http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students/:ID | 201 |
|Eliminar estudiante| DELETE |  http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students/:ID | 200 |


## Recursos

### GET Obtener lista de estudiantes

http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students
Retorna la lista de todos los estudiantes que forman parte de la base de datos. 

### GET obtener un estudiante
http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students/:ID
Retorna un único estudiante con el id indicado perteneciente a la base de datos.

### POST Crear un estudiante

http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students

Agregar un nuevo estudiante y guardarlo en la base de datos.
Para cargar los datos, usamos la salida en formato JSON. Para ello, lo escribimos en el body de la solicitud.


Por ejemplo:

  {
    "ndni": 56782345,
    "nombre": "Carla Gomez",
    "direccion": "Mitre 554",
    "telefono": "154443216",
    "curso": 5,
    "division": "B"
}

### PUT actualizar un estudiante

 http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students/:ID

 Editar un estudiante y guardarlo en la base de datos.
 Para cargar los datos, usamos la salida en formato JSON. Para ello, lo escribimos en el body de la solicitud.

 Por ejemplo:

 Si queremos modificar el esudiante con ndni=56782345:

 http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students/56782345

 En el body indicaremos:


  {
    "ndni": 56782345,
    "nombre": "Carla Romero",
    "direccion": "Mitre 554",
    "telefono": "154443216",
    "curso": 5,
    "division": "B"
}

## Parámetros

|Parámetro | Descripción |
| ------------ | ------------|
| column | Indica la columna por la que se filtrarán los datos.|
| filtervalue | Indica el valor por el cual se filtrará.|
| orderBy | Indica la columna por la cual se ordenaran los datos.|
| order | Indica el tipo de ordenamiento asc o desc.|
| page | Página que se quiere observar.|
| limit | Indica la cantidad registros que se mostrarán por página.|



## Parámetros por defecto

En el caso de omitir parámetros en las consultas, por defecto se ejecutaran de la siguiente manera:

|Parámetro | Valor por defecto |
|-------- |-----------|
| orderBy | ndni |
| order | desc |
| limit | 20 |
| page | 1 |

Es decir, se mostraran los primeros 20 estudiantes pertenecientes a la base de datos ordenados de manera descendente considerando su ndni.

## Paginación

Se podrán paginar los resultados, se debrán agregar parámetros limit y page a las solicitudes GET:

Por ejemplo:
Se mostrarán los 4 estudiantes que se encuentran en la página 3.

http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students?page=3&limit=4

Observación: Por defecto el limit será 20 y se mostrará la página.


## Orden

Se pueden ordenar los resultados agregando los parámetros orderBy y order.

por ejemplo:
Se mostrarán los estudiantes ordenados de manera ascendente considerando el nombre.
http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students?orderBy=nombre&order=asc

Observación: si omite el parámetro de pedido, el orden predeterminado será por ndni de manera descendente.

## Filtrado

Se pueden filtrar los datos consultados agregando los parametros column y filtervalue.

Por ejemplo:
Se mostraran los estudiantes que en la columna curso indique 5.
http://localhost/web2/TrabajoFinal-SegundaEntrega/api/students?column=curso&filtervalue=5



## Errores
Los errores con los que se puede encontrar en la API serán:

### Status	    Código de error	                       
 400     	   “Bad request”	          
 404	       “Not found”                     	
 500 	       “Internal server error”	    





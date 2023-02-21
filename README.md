# pruebaSitesSoftware

Requerimientos: PHP 8.0.25 Laralvel 9 Composer 2.5.3 MySql

Descripción: 
Antes de iniciar, deberá clonar este repositorio, una vez clonado, deberá abrir la carpeta en un ide como visual studio code,
 adicionalmente, revisar la conexión a la base de datos, en este caso, se realizaó empleando mysql, deberá conectarse a una 
 base de datos llamada chat, debe revisar el archivo .end y realziar la siguiente configuración.
 
 DB_CONNECTION=mysql DB_HOST=127.0.0.1 DB_PORT=3306 DB_DATABASE=inventario DB_USERNAME=user DB_PASSWORD= password

donde user y password son los valores correspondientes a su propio servidor. deberá también correr el comando php artisan migrate para que se creen las tablas correctamente, una vez hecho esto levante el servidor con el comendo php artisan serve.

Y podrá realizar las siguientes pruebas mediante postman. 

Este sistema permite administrar usuarios, crear nuevas salas de chat siempre y cuando no existe
una sala los mismo dos usuarios, sólo se permiten mensajes de texto.

mediante el método post con la url: http://127.0.0.1:8000/register, en lo posible en un explorador como google chrome, debe enviar los siguientes parámetros:
name de tipo string que hace referenia al nombre del usuario
email de tipo string que hace referencia al email del usuario
password de tipo string y con mínimo 8 caracteres que hace referencia al password del usuario
confirm password de tipo string y debe ser igual al campo password

deberá registrar al menos dos usuarios para crear chats entre ellos, tenga en cuenta que aunque existen usuarios no se está empleando ningún método de 
autenticación para consumir los recursos de este proyecto.


Mediante método get con la url http://127.0.0.1:8000/users 
va a obtener todos los usuarios que existen en la base de datos, con los que podrá iniciar alguna sala de chat, asumiendo que puede crear una sala de chat con usted mismo. 

Mediante el método post con la url: http://127.0.0.1:8000/api/chatWith y las variables, en formato json:
authUser de tipo entero que hace referencia al usuario que va a iniciar el chat
user de tipo entero que hace referencia a usuario con que quiere iniciar un chat

en caso de que no exista ninguna sala de chat, creará una nueva sala para que ambos usuarios interactúen, mientras que si ya existe una sala
va a obtener lo mensajes que ambos usuarios de han enviado.

Mediante el método post con la url: http://127.0.0.1:8000/api/messageSent con las variables en formato json
user_id de tipo entero que hace referencia al id del usuario que envía el mensaje
chat_id de tipo entero que hace referncia al id de la sala de chat a donde se va a enviar el mensaje
content de tipo string que hace referencia al mensaje que será envía, en caso de que este esté vacío la aplicación 
retornará un mensaje en formato json que le dice al usuario que no puede enviar un mensaje sin caracteres.

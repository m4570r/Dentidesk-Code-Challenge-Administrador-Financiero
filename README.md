## Dentidesk CodeChallenge Administrador Financiero

Este proyecto se creó como parte del proceso de postulación a Dentidesk y se centra en la simplicidad, la claridad en el código y el cumplimiento de los requerimientos establecidos.

La aplicación permite a los usuarios registrar sus ingresos y egresos, calcular el total de ganancias para el mes y visualizar sus transacciones de manera organizada.

## Desarrollo del Proyecto simple Administración Financiera Simple

### Comprender los Requerimientos

Los requerimientos específicos para el desarrollo del proyecto son los siguientes:

1. **Desarrollo Backend (PHP):**
   - Crear un sistema de almacenamiento de datos para las transacciones (base de datos MySQL).
   - Implementar endpoints API-REST para realizar las siguientes operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en las transacciones.
   - Diseñar un controlador que gestione las solicitudes HTTP y la lógica de negocio.
   - Validar los datos de entrada para asegurar la integridad de la base de datos.
   - Calcular y mantener un registro del total de ganancias para el mes.
   - Utilizar programación orientada a objetos (POO) para estructurar y organizar el código PHP.
   - Asegurarse de que el código esté bien comentado y documentado para una fácil comprensión.

2. **Desarrollo Frontend (React o Blade Templates):**
   - Crear una interfaz de usuario amigable y responsiva.
   - Desarrollar un formulario para ingresar transacciones que capture la descripción, monto y tipo (ingreso o egreso).
   - Utilizar React.js o Laravel Blade Templates para generar las vistas y componentes necesarios.
   - Mostrar el total ganado en el mes en algún lugar visible de la interfaz.
   - Implementar un menú de navegación que permita a los usuarios acceder a diferentes secciones de la aplicación.
   - Utilizar CSS o un framework de diseño para dar estilo a la interfaz y asegurarse de que sea atractiva y funcional.

3. **Control de Versiones (Git):**
   - Utilizar Git para el control de versiones del código fuente.
   - Mantener un repositorio Git que incluya commits regulares con mensajes descriptivos.

4. **Simplicidad y Claridad:**
   - Mantener la simplicidad en el código, evitando la complejidad innecesaria.
   - Elegir nombres de variables y funciones que sean descriptivos y significativos.
   - Evitar la duplicación de código mediante la reutilización de funciones y componentes cuando sea posible.

5. **Fecha de Entrega:**
   - Cumplir con la fecha de entrega establecida, que es el miércoles 27 de septiembre a las 23:59 hrs.

Estos requerimientos se enfocan en el desarrollo de software, tanto en el backend como en el frontend, y en la gestión del código a través de Git.

### Diseño de la Base de Datos

Para el almacenamiento de datos, se utilizará MySQL. Este es el esquema simple de la base de datos:

Tabla `transactions`:

- `id` (clave primaria, autoincremental)
- `description` (texto)
- `amount` (decimal)
- `type` (enum: 'ingreso' o 'egreso')
- `created_at` (timestamp)

Este esquema permitirá el almacenamiento de las transacciones con sus descripciones, montos, tipos (ingreso o egreso) y marcas de tiempo.

```sql
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    type ENUM('ingreso', 'egreso') NOT NULL,
    date DATE NOT NULL
);

## EndPoints

- **Buscar todos los registros:**
http://localhost/api/v1/2023/index.php?comando=transactions

- **Buscar registros por id:**
http://localhost/api/v1/2023/index.php?comando=transactions&id={id}

- **Buscar registros por descripción:**
http://localhost/api/v1/2023/index.php?comando=transactions&description={descripcion}

- **Buscar registros por monto:**
http://localhost/api/v1/2023/index.php?comando=transactions&amount={monto a buscar}

- **Buscar registros por tipo:**
http://localhost/api/v1/2023/index.php?comando=transactions&type={tipo a buscar}

- **Buscar registros por rango de fechas:**
http://localhost/api/v1/2023/index.php?comando=transactions&dateInicio={fechaInicio}&dateFinal={fechaFinal}

- **Mostrar el total del mes:**
http://localhost/api/v1/2023/index.php?comando=transactions&month=9&year=2023

- **Agregar un nuevo registro:**
http://localhost/api/v1/2023/index.php?comando=transactions&addTransactions

Payload:

json
Copy code
{
    "descripcion":"Sueldo",
    "monto":2500000,
    "tipo":"ingreso",
    "date":"2023-09-01"
}
Actualizar registros: http://localhost/CodeChallenge/Dentidesk-Code-Challenge-Administrador-Financiero/api/v1/2023/index.php?comando=transactions&updateTransactions

Payload:

json
Copy code
{
    "id":19,
    "descripcion":"Sueldo",
    "monto":2500000,
    "tipo":"ingreso",
    "date":"2023-09-01"
}
Eliminar registros: http://localhost/CodeChallenge/Dentidesk-Code-Challenge-Administrador-Financiero/api/v1/2023/index.php?comando=transactions&deleteTransactions

Payload:

json
Copy code
{
    "id":19
}
Desarrollo de la API
(Descripción del desarrollo de la API en este espacio)

Desarrollo de la APP
Tecnológica: React

Comando para crear la aplicación
bash
Copy code
npx create-react-app app-financiera
Agregar Bootstrap al proyecto
bash
Copy code
npm install react-bootstrap Bootstrap
Generar componentes
Utilizar el siguiente comando para generar los componentes necesarios:

bash
Copy code
npx generate-react-cli component TotalGanadoEnMes
npx generate-react-cli component FormularioIngresoTransacciones
npx generate-react-cli component MenuNavegacion
npx generate-react-cli component Inicio
npx generate-react-cli component HistorialIngresos
npx generate-react-cli component TotalGastadoEnMes
npx generate-react-cli component SaldoTotal
Docker
Para construir la imagen de Docker y ejecutar el contenedor:

bash
Copy code
docker build -t tu-imagen .
docker run -d -p 80:80 --name tu-contenedor tu-imagen
Control de Versiones (Git)
A continuación, se describen los comandos básicos de Git para el control de versiones:

bash
Copy code
# Añadir todos los archivos modificados o nuevos al área de preparación (staging)
git add .

# Realizar el commit con un mensaje descriptivo de tus cambios
git commit -m "Mensaje descriptivo de tus cambios aquí"

# Asegurarse de estar en la rama correcta (por ejemplo, 'main' o 'master')
git checkout main

# Obtener los cambios más recientes del repositorio remoto
git pull origin main

# Empujar los cambios al repositorio remoto en GitHub
git push origin main  # Cambia 'main' por el nombre de tu

### Características Destacadas:

- Backend implementado en PHP, utilizando programación orientada a objetos (POO).
- Almacenamiento de datos en una base de datos MySQL.
- Interfaz de usuario desarrollada con React.js para una experiencia interactiva.
- Uso de CSS para el diseño y Bootstrap como framework de diseño.
- Gestión del código fuente mediante control de versiones Git, con seguimiento regular y descripciones detalladas de los commits.
- Configuración de Docker para facilitar la instalación y ejecución de la aplicación en contenedores.

### Requisitos de Instalación:

- PHP y servidor web compatible.
- Base de datos MySQL.
- Node.js y npm (si se usa React.js).
- Docker y Docker Compose (opcional, para facilitar la ejecución).

### Instrucciones de Uso:

1. Clona este repositorio en tu máquina local.
2. Configura el entorno PHP y la base de datos según sea necesario.
3. Ejecuta la aplicación siguiendo las instrucciones proporcionadas en la documentación del proyecto.

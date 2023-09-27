<?php
// Establecer las cabeceras CORS para permitir el acceso desde cualquier origen
header("Access-Control-Allow-Origin: *");

// Opcionalmente, puedes especificar métodos HTTP permitidos
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Opcionalmente, puedes especificar encabezados personalizados permitidos
// header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Verificar el método de solicitud (GET, POST, etc.) si es necesario
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // La solicitud es una pre-solicitud (preflight) CORS, por lo que solo respondemos con las cabeceras CORS y no con contenido.
    header('HTTP/1.1 204 No Content');
    header("Access-Control-Allow-Origin: *");
    // Opcionalmente, puedes especificar métodos HTTP permitidos y encabezados personalizados aquí.
    exit;
}
// Incluye los modulos necesarios
require_once( __DIR__ . '/module/connect.php' );
require_once( __DIR__ . '/module/connect.php' );

// Incluye los controladores necesarios
require_once( __DIR__ . '/controllers/transactionController.php' );

// Instancia el controlador TransactionController
$transactionController = new TransactionController();

class API {
    private $db;
    private $transactionController;

    public function __construct() {
        // Utiliza la conexión a la base de datos desde connect.php
        global $db;

        if ( !isset( $db ) ) {
            die( 'Error: La conexión a la base de datos no está configurada.' );
        }

        $this->db = $db;

        // Instancia el controlador TransactionController
        $this->transactionController = new TransactionController( $this->db );
    }

    public function handleRequest() {
        $requestMethod = $_SERVER[ 'REQUEST_METHOD' ];

        // Verifica si el parámetro 'comando' está presente en la URL
        $comando = isset( $_GET[ 'comando' ] ) ? $_GET[ 'comando' ] : '';

        switch ( $comando ) {
            case 'transactions':
            if ( $requestMethod === 'GET' ) {
                // Almacenando los parametros de la URL en variables
                $id 		= isset( $_GET[ 'id' ] ) ? $_GET[ 'id' ] : null;
                $description 	= isset( $_GET[ 'description' ] ) ? $_GET[ 'description' ] : null;
                $amount 	= isset( $_GET[ 'amount' ] ) ? $_GET[ 'amount' ] : null;
                $type 		= isset( $_GET[ 'type' ] ) ? $_GET[ 'type' ] : null;
                $dateInicio 	= isset( $_GET[ 'dateInicio' ] ) ? $_GET[ 'dateInicio' ] : null;
                $dateFinal 	= isset( $_GET[ 'dateFinal' ] ) ? $_GET[ 'dateFinal' ] : null;
				$month 	= isset( $_GET[ 'month' ] ) ? $_GET[ 'month' ] : null;
				$year 	= isset( $_GET[ 'year' ] ) ? $_GET[ 'year' ] : null;

                if ( !is_null( $id ) ) {
                    // GET /index.php?comando=transactions&id={1}
                    $result = $this->transactionController->getTransactionById( $id );
                    echo $result;
                } elseif ( !is_null( $description ) ) {
                    // GET /index.php?comando=transactions&description={descripcion a buscar}
                    $result = $this->transactionController->getTransactionsByDescription( $description );
                    echo $result;
                } elseif ( !is_null( $amount ) ) {
                    // GET /index.php?comando=transactions&amount={monto a buscar}
                    $result = $this->transactionController->getTransactionsByAmount( $amount );
                    echo $result;
                } elseif ( !is_null( $type ) ) {
                    // GET /index.php?comando=transactions&type={tipo a buscar}
                    $result = $this->transactionController->getTransactionsByType( $type );
                    echo $result;
                } elseif ( !is_null( $dateInicio ) && !is_null( $dateFinal ) ) {
                    // GET index.php?comando=transactions&dateInicio={fecha de inicio}&dateFinal={fecha final}
                        $result = $this->transactionController->getTransactionsByDateRange( $dateInicio, $dateFinal );
                        echo $result;
                } elseif ( !is_null( $month ) && !is_null( $year ) ) {
					// GET /index.php?comando=transactions&month=06&year=2023
					$result = $this->transactionController->getTotalMonth($year, $month);
					echo $result;
				} else {
                        // GET /index.php?comando=transactions
                        $result = $this->transactionController->getAllTransactions();
                        echo $result;
                    }
            } elseif ( $requestMethod === 'POST' && isset( $_GET[ 'addTransactions' ] ) ) {
                    // POST /index.php?comando=transactions&addTransactions
                    $data = json_decode( file_get_contents( 'php://input' ), true );
                    $result = $this->transactionController->addTransaction( $data );

                    echo $result;

            } elseif ($requestMethod === 'PUT' && isset($_GET['updateTransactions'])) {
					// PUT /index.php?comando=transactions&updateTransactions
					$data = json_decode(file_get_contents('php://input'), true);

					if (isset($data['id'])) {
						$transactionId = $data['id'];
						$result = $this->transactionController->updateTransaction($transactionId, $data);
						echo $result;
					} else {
						// Manejar el caso en el que 'id' está ausente en $data
						$response = [
							"error" => "Se requiere un ID en el payload para actualizar la transacción."
						];
						echo json_encode($response, JSON_PRETTY_PRINT);
					}
			} elseif ( $requestMethod === 'DELETE' && isset( $_GET[ 'deleteTransactions' ] ) ) {
                    // DELETE /index.php?comando=transactions&deleteTransactions
                    $data = json_decode( file_get_contents( 'php://input' ), true );
                    $transactionId = $data[ 'id' ];
                    $result = $this->transactionController->deleteTransaction( $transactionId );
                    echo $result;
            }	

                break;

            case 'version':
                // GET muestra la version
                echo 'version';
                break;

            default:
                // Comando no válido
                echo 'Comando no válido';
                break;
            }
        }
    }

    // Crear una instancia de la clase API y manejar la solicitud
    $api = new API();
    $api->handleRequest();
    ?>

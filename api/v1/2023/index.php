<?php

// Incluye el controlador TransactionController
require_once( 'controllers/transactionController.php' );

// Instancia el controlador TransactionController
$transactionController = new TransactionController();

class API {
    private $db;
    private $transactionController;

    public function __construct() {
        // Establece la conexión a la base de datos ( Asegúrate de configurar tus datos de conexión )
        $host = 'localhost';
        $dbname = 'codechallenge';
        $username = 'root';
        $password = '';

        try {
            $this->db = new PDO( "mysql:host=$host;dbname=$dbname", $username, $password );
            $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            // Instancia el controlador TransactionController
            $this->transactionController = new TransactionController( $this->db );
        } catch ( PDOException $e ) {
            die( 'Error en la conexión a la base de datos: ' . $e->getMessage() );
        }
    }

    public function handleRequest() {
        $requestMethod = $_SERVER[ 'REQUEST_METHOD' ];

        // Verifica si el parámetro 'comando' está presente en la URL
        $comando = isset( $_GET[ 'comando' ] ) ? $_GET[ 'comando' ] : '';

        if ( $comando === 'transactions' ) {
            if ( $requestMethod === 'GET' ) {
                // GET /index.php?comando = transactions
                // Lógica para buscar todos los registros
                if ( isset( $_GET[ 'id' ] ) ) {
                    // GET /index.php?comando=transactions&id={numero id}
                    // Lógica para buscar registros por id
                    //$transactionId = $_GET[ 'id' ];
                    //echo $this->transactionController->getTransactionById( $transactionId );

                    echo 'por id';
                } elseif ( isset( $_GET[ 'description' ] ) ) {
                    // GET /index.php?comando=transactions&description={descripcion}
                    // Lógica para buscar registros por descripción
                    //$description = $_GET[ 'description' ];
                    //echo $this->transactionController->getTransactionsByDescription( $description );

                    echo 'descripcion';
                } elseif ( isset( $_GET[ 'amount' ] ) ) {
                    // GET /index.php?comando=transactions&amount={monto a buscar}
                    // Lógica para buscar registros por monto
                    //$amount = $_GET[ 'amount' ];
                    //echo $this->transactionController->getTransactionsByAmount( $amount );

                    echo 'amount';
                } elseif ( isset( $_GET[ 'type' ] ) ) {
                    // GET /index.php?comando=transactions&type={tipo a buscar}
                    // Lógica para buscar registros por tipo
                    //$type = $_GET[ 'type' ];
                    //echo $this->transactionController->getTransactionsByType( $type );

                    echo 'type';
                } elseif ( isset( $_GET[ 'dateInicio' ] ) && isset( $_GET[ 'dateFinal' ] ) ) {
                    // GET /index.php?comando=transactions&dateInicio={fecha de inicio}&dateFinal={fecha final}
                        // Lógica para buscar registros por rango de fechas
                        //$dateInicio = $_GET[ 'dateInicio' ];
                        //$dateFinal = $_GET[ 'dateFinal' ];
                        //echo $this->transactionController->getTransactionsByDateRange( $dateInicio, $dateFinal );

                        echo 'por fecha';
                    } else {
                        // GET /index.php?comando = transactions
                        // Lógica para buscar todos los registros
                        //echo $this->transactionController->getAllTransactions();
                        echo 'todas las transacciones';
                    }
                } elseif ( $requestMethod === 'POST' ) {
                    // POST /index.php?comando = transactions
                    // Lógica para agregar registros
                    //$data = json_decode( file_get_contents( 'php://input' ), true );
                    //echo $this->transactionController->createTransaction( $data );

                    echo 'solicitudes POST';
                } elseif ( $requestMethod === 'PUT' ) {
                    // PUT /index.php?comando = transactions
                    // Lógica para actualizar registros
                    //$data = json_decode( file_get_contents( 'php://input' ), true );
                    //echo $this->transactionController->updateTransaction( $data );

                    echo 'solicitudes PUT';
                } elseif ( $requestMethod === 'DELETE' ) {
                    // DELETE /index.php?comando = transactions
                    // Lógica para eliminar registros
                    //$data = json_decode( file_get_contents( 'php://input' ), true );
                    //echo $this->transactionController->deleteTransaction( $data );

                    echo 'Solicitudes DELETE';
                }
            }
        }
    }

// Crear una instancia de la clase API y manejar la solicitud
$api = new API();
$api->handleRequest();
?>

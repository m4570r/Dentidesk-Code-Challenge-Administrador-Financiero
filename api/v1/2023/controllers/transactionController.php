<?php

class TransactionController
{
    private $db;

    public function __construct()
    {
        // Configura la conexión a la base de datos usando PDO
        $host = 'localhost';
        $db_name = 'codechallenge';
        $username = 'root';
        $password = '';

        try {
            $this->db = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getAllTransactions($filter = [])
    {
        try {
            $sql = "SELECT * FROM transactions";

            if (!empty($filter)) {
                $conditions = [];

                if (isset($filter['description'])) {
                    $conditions[] = "description LIKE '%" . $filter['description'] . "%'";
                }

                if (isset($filter['amount'])) {
                    $conditions[] = "amount = " . $filter['amount'];
                }

                if (isset($filter['type'])) {
                    $conditions[] = "type = '" . $filter['type'] . "'";
                }

                if (isset($filter['date'])) {
                    $conditions[] = "date = '" . $filter['date'] . "'";
                }

                $sql .= " WHERE " . implode(" AND ", $conditions);
            }

            $stmt = $this->db->query($sql);
            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return json_encode($transactions);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getTransactionById($id)
    {
        try {
            $sql = "SELECT * FROM transactions WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $transaction = $stmt->fetch(PDO::FETCH_ASSOC);

            return json_encode($transaction);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function createTransaction($data)
    {
        try {
            // Valida y procesa los datos recibidos en $data
            // Luego, inserta la nueva transacción en la base de datos
            // Retorna la nueva transacción como JSON en la respuesta
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function updateTransaction($id, $data)
    {
        try {
            // Valida y procesa los datos recibidos en $data
            // Luego, actualiza la transacción con el ID dado en la base de datos
            // Retorna la transacción actualizada como JSON en la respuesta
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function deleteTransaction($id)
    {
        try {
            $sql = "DELETE FROM transactions WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $response = ['message' => 'Transacción eliminada con éxito'];
            return json_encode($response);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

?>

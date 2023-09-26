<?php

require_once(__DIR__ . '/../module/connect.php');

class TransactionController
{
    private $db;

    public function __construct()
    {
        // Utiliza la conexión a la base de datos desde connect.php
        global $db;

        if (!isset($db)) {
            die("Error: La conexión a la base de datos no está configurada.");
        }

        $this->db = $db;
    }

    // Función para obtener todos los registros de transacciones
	public function getAllTransactions()
	{
		try {
			// Preparar la consulta SQL
			$query = "SELECT * FROM transactions";

			// Preparar la declaración PDO
			$statement = $this->db->prepare($query);

			// Ejecutar la consulta
			$statement->execute();

			// Obtener todos los registros como un arreglo asociativo
			$transactions = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Verificar si se obtuvieron registros
			if (empty($transactions)) {
				// Si no se encontraron registros, puedes devolver un mensaje personalizado o un arreglo vacío
				$response = [
					"message" => "No se encontraron registros de transacciones."
				];
			} else {
				// Si se encontraron registros, puedes devolverlos en formato JSON
				$response = $transactions;
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// En caso de error en la consulta, puedes manejarlo aquí
			return json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
		}
	}

	public function getTransactionById($transactionId)
	{
		try {
			// Preparar la consulta SQL para obtener la transacción por su ID
			$query = "SELECT * FROM transactions WHERE id = :transaction_id";

			// Preparar la declaración PDO
			$statement = $this->db->prepare($query);

			// Bind de los parámetros
			$statement->bindParam(":transaction_id", $transactionId, PDO::PARAM_INT);

			// Ejecutar la consulta
			$statement->execute();

			// Obtener la transacción como un arreglo asociativo
			$transaction = $statement->fetch(PDO::FETCH_ASSOC);

			// Verificar si se encontró la transacción
			if (!$transaction) {
				// Si no se encontró la transacción, puedes devolver un mensaje personalizado o un arreglo vacío
				$response = [
					"message" => "No se encontró la transacción con el ID especificado."
				];
			} else {
				// Si se encontró la transacción, puedes devolverla en formato JSON
				$response = $transaction;
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// En caso de error en la consulta, puedes manejarlo aquí
			return json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
		}
	}

    // Función para buscar transacciones por descripción
	public function getTransactionsByDescription($description)
	{
		try {
			// Preparar la consulta SQL para buscar transacciones por descripción
			$query = "SELECT * FROM transactions WHERE description LIKE :description";

			// Preparar la declaración PDO
			$statement = $this->db->prepare($query);

			// Bind de los parámetros con el operador "%" para buscar descripciones que contengan la palabra especificada
			$description = '%' . $description . '%';
			$statement->bindParam(":description", $description, PDO::PARAM_STR);

			// Ejecutar la consulta
			$statement->execute();

			// Obtener las transacciones como un arreglo asociativo
			$transactions = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Verificar si se encontraron transacciones
			if (empty($transactions)) {
				// Si no se encontraron transacciones, puedes devolver un mensaje personalizado o un arreglo vacío
				$response = [
					"message" => "No se encontraron transacciones con la descripción especificada."
				];
			} else {
				// Si se encontraron transacciones, puedes devolverlas en formato JSON
				$response = $transactions;
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// En caso de error en la consulta, puedes manejarlo aquí
			return json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
		}
	}

    // Función para buscar transacciones por monto
	public function getTransactionsByAmount($amount)
	{
		try {
			// Preparar la consulta SQL para buscar transacciones por monto
			$query = "SELECT * FROM transactions WHERE amount = :amount";

			// Preparar la declaración PDO
			$statement = $this->db->prepare($query);

			// Bind del parámetro :amount
			$statement->bindParam(":amount", $amount, PDO::PARAM_STR);

			// Ejecutar la consulta
			$statement->execute();

			// Obtener las transacciones como un arreglo asociativo
			$transactions = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Verificar si se encontraron transacciones
			if (empty($transactions)) {
				// Si no se encontraron transacciones, puedes devolver un mensaje personalizado o un arreglo vacío
				$response = [
					"message" => "No se encontraron transacciones con el monto especificado."
				];
			} else {
				// Si se encontraron transacciones, puedes devolverlas en formato JSON
				$response = $transactions;
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// En caso de error en la consulta, puedes manejarlo aquí
			return json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
		}
	}

    // Función para buscar transacciones por tipo
	public function getTransactionsByType($type)
	{
		try {
			// Preparar la consulta SQL para buscar transacciones por tipo
			$query = "SELECT * FROM transactions WHERE type = :type";

			// Preparar la declaración PDO
			$statement = $this->db->prepare($query);

			// Bind del parámetro :type
			$statement->bindParam(":type", $type, PDO::PARAM_STR);

			// Ejecutar la consulta
			$statement->execute();

			// Obtener las transacciones como un arreglo asociativo
			$transactions = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Verificar si se encontraron transacciones
			if (empty($transactions)) {
				// Si no se encontraron transacciones, puedes devolver un mensaje personalizado o un arreglo vacío
				$response = [
					"message" => "No se encontraron transacciones con el tipo especificado."
				];
			} else {
				// Si se encontraron transacciones, puedes devolverlas en formato JSON
				$response = $transactions;
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// En caso de error en la consulta, puedes manejarlo aquí
			return json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
		}
	}

    // Función para buscar transacciones por rango de fechas
	public function getTransactionsByDateRange($dateInicio, $dateFinal)
	{
		try {
			// Preparar la consulta SQL para buscar transacciones por rango de fechas
			$query = "SELECT * FROM transactions WHERE date >= :dateInicio AND date <= :dateFinal";

			// Preparar la declaración PDO
			$statement = $this->db->prepare($query);

			// Bind de los parámetros :dateInicio y :dateFinal
			$statement->bindParam(":dateInicio", $dateInicio, PDO::PARAM_STR);
			$statement->bindParam(":dateFinal", $dateFinal, PDO::PARAM_STR);

			// Ejecutar la consulta
			$statement->execute();

			// Obtener las transacciones como un arreglo asociativo
			$transactions = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Verificar si se encontraron transacciones
			if (empty($transactions)) {
				// Si no se encontraron transacciones, puedes devolver un mensaje personalizado o un arreglo vacío
				$response = [
					"message" => "No se encontraron transacciones en el rango de fechas especificado."
				];
			} else {
				// Si se encontraron transacciones, puedes devolverlas en formato JSON
				$response = $transactions;
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// En caso de error en la consulta, puedes manejarlo aquí
			return json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
		}
	}

	// Función para agregar una transacción nueva
	public function addTransaction($data)
	{
		try {
			// Obtener los datos del formulario
			$descripcion = $data['descripcion'];
			$monto = $data['monto'];
			$tipo = $data['tipo'];
			$date = $data['date'];

			// Preparar la consulta SQL INSERT
			$query = "INSERT INTO transactions (description, amount, type, date) VALUES (:descripcion, :monto, :tipo, :date)";
			$statement = $this->db->prepare($query);

			// Enlazar los parámetros
			$statement->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
			$statement->bindParam(":monto", $monto, PDO::PARAM_STR);
			$statement->bindParam(":tipo", $tipo, PDO::PARAM_STR);
			$statement->bindParam(":date", $date, PDO::PARAM_STR);

			// Ejecutar la consulta SQL INSERT
			$statement->execute();

			// Verificar si se insertó correctamente
			if ($statement->rowCount() > 0) {
				// Si se insertó correctamente, construir una respuesta JSON
				$response = [
					"message" => "Registro agregado exitosamente"
				];
			} else {
				// Si no se insertó correctamente, mostrar un mensaje de error
				$response = [
					"message" => "No se pudo agregar el registro"
				];
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// En caso de error en la consulta, puedes manejarlo aquí
			return json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
		}
	}

	// Función para actualizar una transacción existente
	public function updateTransaction($transactionId, $data)
	{
		try {
			// Obtener los datos del formulario
			$descripcion = $data['descripcion'];
			$monto = $data['monto'];
			$tipo = $data['tipo'];
			$date = $data['date'];

			// Preparar la consulta SQL UPDATE
			$query = "UPDATE transactions SET description = :descripcion, amount = :monto, type = :tipo, date = :date WHERE id = :transactionId";
			$statement = $this->db->prepare($query);

			// Enlazar los parámetros
			$statement->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
			$statement->bindParam(":monto", $monto, PDO::PARAM_STR);
			$statement->bindParam(":tipo", $tipo, PDO::PARAM_STR);
			$statement->bindParam(":date", $date, PDO::PARAM_STR);
			$statement->bindParam(":transactionId", $transactionId, PDO::PARAM_INT);

			// Ejecutar la consulta SQL UPDATE
			$statement->execute();

			// Verificar si se actualizó correctamente
			if ($statement->rowCount() > 0) {
				// Si se actualizó correctamente, construir una respuesta JSON
				$response = [
					"message" => "Registro actualizado exitosamente"
				];
			} else {
				// Si no se actualizó correctamente, mostrar un mensaje de error
				$response = [
					"message" => "No se pudo actualizar el registro o el registro no existe"
				];
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// En caso de error en la consulta, puedes manejarlo aquí
			return json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
		}
	}

    // Función para eliminar una transacción por su ID
	public function deleteTransaction($transactionId)
	{
		try {
			// Preparar la consulta SQL DELETE
			$query = "DELETE FROM transactions WHERE id = :transactionId";
			$statement = $this->db->prepare($query);

			// Enlazar el parámetro :transactionId
			$statement->bindParam(":transactionId", $transactionId, PDO::PARAM_INT);

			// Ejecutar la consulta SQL DELETE
			$statement->execute();

			// Verificar si se eliminó correctamente
			if ($statement->rowCount() > 0) {
				// Si se eliminó correctamente, construir una respuesta JSON
				$response = [
					"message" => "Registro eliminado exitosamente",
					"id" => $transactionId
				];
			} else {
				// Si no se eliminó correctamente o el registro no existe, mostrar un mensaje de error
				$response = [
					"message" => "No se pudo eliminar el registro o el registro no existe",
					"id" => $transactionId
				];
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// En caso de error en la consulta, puedes manejarlo aquí
			return json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
		}
	}

}

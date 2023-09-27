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
        // Validar los datos de entrada
        if (
            empty($data['descripcion']) ||
            empty($data['monto']) ||
            empty($data['tipo']) ||
            empty($data['date'])
        ) {
            $response = [
                "error" => "Todos los campos son obligatorios."
            ];
            return json_encode($response, JSON_PRETTY_PRINT);
        }

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

            // Calcular y actualizar el total de ganancias para el mes
            $this->calculateAndUpdateMonthlyProfit();

            return json_encode($response, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            // Manejar errores de base de datos
            $response = [
                "error" => $e->getMessage()
            ];
            return json_encode($response, JSON_PRETTY_PRINT);
        }
    }
	
	// Función para actualizar una transacción existente
	public function updateTransaction($transactionId, $data)
	{
		try {
			
			// Validar que el payload sea un arreglo y contenga la clave 'id'
			if (!is_array($data) || !isset($data['id'])) {
				$response = [
					"error" => "Se requiere un ID en el payload para actualizar la transacción."
				];
				return json_encode($response, JSON_PRETTY_PRINT);
			}

			// Obtener el ID del payload
			$payloadId = $data['id'];

			// Validar que el ID del payload coincida con el ID proporcionado en la URL
			if ($transactionId != $payloadId) {
				$response = [
					"error" => "El ID en el payload no coincide con el ID proporcionado en la URL."
				];
				return json_encode($response, JSON_PRETTY_PRINT);
			}

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

				// Calcular y actualizar el total de ganancias para el mes
				$this->calculateAndUpdateMonthlyProfit();
			} else {
				// Si no se actualizó correctamente, mostrar un mensaje de error
				$response = [
					"message" => "No se pudo actualizar el registro o el registro no existe"
				];
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// Manejar errores de base de datos
			$response = [
				"error" => $e->getMessage()
			];
			return json_encode($response, JSON_PRETTY_PRINT);
		}
	}

    // Función para calcular y actualizar el total de ganancias para el mes
	public function deleteTransaction($transactionId)
	{
		try {
			// Validar que el parámetro $transactionId sea numérico
			if (is_numeric($transactionId)) {
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

					// Calcular y actualizar el total de ganancias para el mes
					$this->calculateAndUpdateMonthlyProfit();
				} else {
					// Si no se eliminó correctamente o el registro no existe, mostrar un mensaje de error
					$response = [
						"message" => "No se pudo eliminar el registro o el registro no existe",
						"id" => $transactionId
					];
				}

				return json_encode($response, JSON_PRETTY_PRINT);
			} else {
				// Si el parámetro no es numérico, devolver un mensaje de error
				$response = [
					"message" => "El parámetro 'id' debe ser numérico."
				];
				return json_encode($response, JSON_PRETTY_PRINT);
			}
		} catch (PDOException $e) {
			// Manejar errores de base de datos
			$response = [
				"error" => $e->getMessage()
			];
			return json_encode($response, JSON_PRETTY_PRINT);
		}
	}

	// Función para calcular y actualizar el total de ganancias para el mes
	public function calculateAndUpdateMonthlyProfit()
	{
		try {
			// Obtener el mes y año actual
			$currentMonth = date('m'); // Esto devolverá '09' en lugar de '9' para septiembre.
			$currentYear = date('Y');  // Esto devolverá el año actual, por ejemplo, '2023'.

			// Obtener el primer y último día del mes actual
			$firstDayOfMonth = date('Y-m-01');
			$lastDayOfMonth = date('Y-m-t');

			// Calcular el total de ingresos para el mes actual
			$incomeQuery = "SELECT SUM(amount) AS total_income FROM transactions WHERE type = 'ingreso' AND date BETWEEN :firstDayOfMonth AND :lastDayOfMonth";
			$incomeStatement = $this->db->prepare($incomeQuery);
			$incomeStatement->bindParam(":firstDayOfMonth", $firstDayOfMonth, PDO::PARAM_STR);
			$incomeStatement->bindParam(":lastDayOfMonth", $lastDayOfMonth, PDO::PARAM_STR);
			$incomeStatement->execute();
			$incomeResult = $incomeStatement->fetch(PDO::FETCH_ASSOC);
			$totalIncome = $incomeResult['total_income'];

			// Calcular el total de egresos para el mes actual
			$expenseQuery = "SELECT SUM(amount) AS total_expense FROM transactions WHERE type = 'egreso' AND date BETWEEN :firstDayOfMonth AND :lastDayOfMonth";
			$expenseStatement = $this->db->prepare($expenseQuery);
			$expenseStatement->bindParam(":firstDayOfMonth", $firstDayOfMonth, PDO::PARAM_STR);
			$expenseStatement->bindParam(":lastDayOfMonth", $lastDayOfMonth, PDO::PARAM_STR);
			$expenseStatement->execute();
			$expenseResult = $expenseStatement->fetch(PDO::FETCH_ASSOC);
			$totalExpense = $expenseResult['total_expense'];

			// Verificar si ya existe un registro para el mes actual
			$checkQuery = "SELECT * FROM monthly_profit WHERE month = :currentMonth AND year = :currentYear";
			$checkStatement = $this->db->prepare($checkQuery);
			$checkStatement->bindParam(":currentMonth", $currentMonth, PDO::PARAM_STR);
			$checkStatement->bindParam(":currentYear", $currentYear, PDO::PARAM_STR);
			$checkStatement->execute();
			$existingRecord = $checkStatement->fetch(PDO::FETCH_ASSOC);

			if ($existingRecord) {
				// Actualizar el registro mensual en la base de datos
				$updateQuery = "UPDATE monthly_profit SET total_income = :totalIncome, total_expense = :totalExpense, updated_at = NOW() WHERE month = :currentMonth AND year = :currentYear";
				$updateStatement = $this->db->prepare($updateQuery);
				$updateStatement->bindParam(":totalIncome", $totalIncome, PDO::PARAM_STR);
				$updateStatement->bindParam(":totalExpense", $totalExpense, PDO::PARAM_STR);
				$updateStatement->bindParam(":currentMonth", $currentMonth, PDO::PARAM_STR);
				$updateStatement->bindParam(":currentYear", $currentYear, PDO::PARAM_STR);
				$updateStatement->execute();
			} else {
				// Insertar un nuevo registro mensual en la base de datos
				$insertQuery = "INSERT INTO monthly_profit (month, year, total_income, total_expense, created_at, updated_at) VALUES (:currentMonth, :currentYear, :totalIncome, :totalExpense, NOW(), NOW())";
				$insertStatement = $this->db->prepare($insertQuery);
				$insertStatement->bindParam(":currentMonth", $currentMonth, PDO::PARAM_STR);
				$insertStatement->bindParam(":currentYear", $currentYear, PDO::PARAM_STR);
				$insertStatement->bindParam(":totalIncome", $totalIncome, PDO::PARAM_STR);
				$insertStatement->bindParam(":totalExpense", $totalExpense, PDO::PARAM_STR);
				$insertStatement->execute();
			}

			$response = [
				"message" => "Total de ganancias y egresos para el mes actualizados exitosamente."
			];
			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// Manejar errores de base de datos
			$response = [
				"error" => $e->getMessage()
			];
			return json_encode($response, JSON_PRETTY_PRINT);
		}
	}

	// Función para obtener el total del mes
	public function getTotalMonth($year, $month)
	{
		try {
			// Preparar la consulta SQL para obtener el total del mes
			$query = "SELECT * FROM monthly_profit WHERE year = :year AND month = :month";

			// Preparar la declaración PDO
			$statement = $this->db->prepare($query);

			// Bind de los parámetros
			$statement->bindParam(":year", $year, PDO::PARAM_INT);
			$statement->bindParam(":month", $month, PDO::PARAM_INT);

			// Ejecutar la consulta
			$statement->execute();

			// Obtener el total del mes como un arreglo asociativo
			$monthlyTotal = $statement->fetch(PDO::FETCH_ASSOC);

			// Verificar si se encontró el total del mes
			if (!$monthlyTotal) {
				// Si no se encontró el total del mes, puedes devolver un mensaje personalizado o un arreglo vacío
				$response = [
					"message" => "No se encontró el total del mes para el año $year y mes $month."
				];
			} else {
				// Si se encontró el total del mes, puedes devolverlo en formato JSON
				$response = $monthlyTotal;
			}

			return json_encode($response, JSON_PRETTY_PRINT);
		} catch (PDOException $e) {
			// En caso de error en la consulta, puedes manejarlo aquí
			return json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
		}
	}

}

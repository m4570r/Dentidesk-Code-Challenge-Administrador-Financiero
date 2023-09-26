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
        // Implementa la lógica para obtener todos los registros de transacciones
		echo "imprimir todos los registros";
    }

    // Función para obtener una transacción por su ID
    public function getTransactionById($transactionId)
    {
        // Implementa la lógica para obtener una transacción por su ID
		echo "imprimir registros por id";
    }

    // Función para buscar transacciones por descripción
    public function getTransactionsByDescription($description)
    {
        // Implementa la lógica para buscar transacciones por descripción
		echo "Imprimir registros por descripcion";
    }

    // Función para buscar transacciones por monto
    public function getTransactionsByAmount($amount)
    {
        // Implementa la lógica para buscar transacciones por monto
		echo "Imprimir registros por monto";
    }

    // Función para buscar transacciones por tipo
    public function getTransactionsByType($type)
    {
        // Implementa la lógica para buscar transacciones por tipo
		echo "Imprimir registros por tipo";
    }

    // Función para buscar transacciones por rango de fechas
    public function getTransactionsByDateRange($dateInicio, $dateFinal)
    {
        // Implementa la lógica para buscar transacciones por rango de fechas
		echo "Imprimir registros por fechas";
    }

	public function addTransaction($data)
	{
		// Mostrar los valores recibidos
		$descripcion = $data['descripcion'];
		$monto = $data['monto'];
		$tipo = $data['tipo'];
		$date = $data['date'];
		
		// Construir un arreglo con los valores
		$result = [
			"descripcion" => $descripcion,
			"monto" => $monto,
			"tipo" => $tipo,
			"date" => $date
		];

		// Construir la respuesta JSON
		echo json_encode($result, JSON_PRETTY_PRINT); // Muestra la respuesta JSON
	}

	// Función para actualizar una transacción existente
	public function updateTransaction($transactionId, $data)
	{
		// Ejemplo de actualización de datos
		$descripcion = $data['descripcion'];
		$monto = $data['monto'];
		$tipo = $data['tipo'];
		$date = $data['date'];

		// Construir la respuesta JSON
		$response = [
			"id" => $transactionId, // Usar $transactionId en lugar de $id
			"descripcion" => $descripcion,
			"monto" => $monto,
			"tipo" => $tipo,
			"date" => $date
		];

		return json_encode($response, JSON_PRETTY_PRINT); // Devuelve la respuesta JSON
	}

    // Función para eliminar una transacción por su ID
	public function deleteTransaction($transactionId)
	{
		// Construir la respuesta JSON
		$response = [
			"id" => $transactionId
		];

		return json_encode($response, JSON_PRETTY_PRINT); // Devuelve la respuesta JSON
	}

}

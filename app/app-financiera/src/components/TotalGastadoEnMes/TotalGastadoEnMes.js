import React, { useState, useEffect } from 'react';

function TotalGastadoEnMes() {
  const [totalExpense, setTotalExpense] = useState(null);
  const [transactions, setTransactions] = useState([]);

  useEffect(() => {
    // Obtener el mes y año actual
    const currentDate = new Date();
    const currentMonth = currentDate.getMonth() + 1; // Sumamos 1 porque los meses comienzan en 0
    const currentYear = currentDate.getFullYear();

    // Construir la URL con los valores de mes y año actuales
    const apiUrl = `http://192.168.1.139/CodeChallenge/Dentidesk-Code-Challenge-Administrador-Financiero/api/v1/2023/index.php?comando=transactions&month=${currentMonth}&year=${currentYear}`;

    // Realizar la solicitud GET
    fetch(apiUrl)
      .then((response) => response.json())
      .then((data) => {
        // Obtener el valor de total_expense del JSON y parsearlo a número
        const totalExpenseValue = parseFloat(data.total_expense);

        // Verificar si el valor es un número válido
        if (!isNaN(totalExpenseValue)) {
          // Si es válido, actualizar el estado con el valor obtenido
          setTotalExpense(totalExpenseValue);
        } else {
          // Si no es válido, establecer el valor en 0
          setTotalExpense(0);
        }
      })
      .catch((error) => {
        console.error('Error al obtener el total gastado:', error);
      });
  }, [transactions]); // Agregar 'transactions' como dependencia

  return (
    <div className="total-ganado total-ganado-rojo">
      <h5>Gastado en el Mes: ${totalExpense !== null ? totalExpense : '0'}</h5>
    </div>
  );
}

export default TotalGastadoEnMes;

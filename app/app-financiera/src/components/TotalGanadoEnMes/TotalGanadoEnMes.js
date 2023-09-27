import React, { useEffect, useState } from 'react';

function TotalGanadoEnMes({ transactions }) {
  const [totalIncome, setTotalIncome] = useState(null);

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
        // Obtener el valor de total_income del JSON
        const totalIncomeValue = parseFloat(data.total_income); // Parsear el valor a número

        // Verificar si el valor es un número válido antes de mostrarlo
        if (!isNaN(totalIncomeValue)) {
          setTotalIncome(totalIncomeValue);
        } else {
          console.error('El valor de ingresos no es un número válido');
          setTotalIncome(0); // Establecer el valor en 0 en caso de valor no válido
        }
      })
      .catch((error) => {
        console.error('Error al obtener el total de ingresos:', error);
      });
  }, [transactions]); // Agregar 'transactions' como dependencia

  return (
    <div className="total-ganado total-ganado-verde">
      <h5>Ganado en el Mes: ${totalIncome !== null ? totalIncome : '0'}</h5>
    </div>
  );
}

export default TotalGanadoEnMes;

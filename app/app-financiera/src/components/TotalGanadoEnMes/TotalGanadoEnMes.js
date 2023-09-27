import React, { useState, useEffect } from 'react';

function TotalGanadoEnMes() {
  const [totalIncome, setTotalIncome] = useState(null);

  useEffect(() => {
    // Obtener el mes y año actual
    const currentDate = new Date();
    const currentMonth = currentDate.getMonth() + 1; // Sumamos 1 porque los meses comienzan en 0
    const currentYear = currentDate.getFullYear();

    console.log(currentMonth);
        console.log(currentYear);

    // Construir la URL con los valores de mes y año actuales
    const apiUrl = `http://192.168.1.139/CodeChallenge/Dentidesk-Code-Challenge-Administrador-Financiero/api/v1/2023/index.php?comando=transactions&month=${currentMonth}&year=${currentYear}`;

    // Realizar la solicitud GET
    fetch(apiUrl)
      .then((response) => response.json())
      .then((data) => {
        // Obtener el valor de total_income del JSON
        const totalIncomeValue = data.total_income;

        // Actualizar el estado con el valor obtenido
        setTotalIncome(totalIncomeValue);
      })
      .catch((error) => {
        console.error('Error al obtener el total de ingresos:', error);
      });
  }, []);

  return (
    <div className="total-ganado">
      <h2>Total Ganado en el Mes: ${totalIncome || 'Cargando...'}</h2>
    </div>
  );
}

export default TotalGanadoEnMes;

import React, { useState, useEffect } from 'react';

function SaldoTotal({ transactions }) {
  const [saldoTotal, setSaldoTotal] = useState(null);
  const [loading, setLoading] = useState(true); // Estado para controlar la carga inicial

  const obtenerMesYAnioActual = () => {
    const fechaActual = new Date();
    const mesActual = fechaActual.getMonth() + 1; // +1 porque los meses se indexan desde 0 (enero es 0)
    const anioActual = fechaActual.getFullYear();
    return { mesActual, anioActual };
  };

  const actualizarSaldoTotal = async () => {
    const { mesActual, anioActual } = obtenerMesYAnioActual();
    const endpoint = `http://192.168.1.139:8080/api/index.php?comando=transactions&month=${mesActual}&year=${anioActual}`;

    try {
      const response = await fetch(endpoint);

      if (response.ok) {
        const data = await response.json();
        const totalIncome = parseFloat(data.total_income);
        const totalExpense = parseFloat(data.total_expense);

        // Verificar si los valores son números válidos antes de realizar la resta
        if (!isNaN(totalIncome) && !isNaN(totalExpense)) {
          const saldo = totalIncome - totalExpense;
          setSaldoTotal(saldo);
        } else {
          console.error('Los valores de ingresos y egresos no son números válidos');
          setSaldoTotal(0); // Establecer saldo en 0 en caso de valores no válidos
        }

        setLoading(false); // Cambia el estado a false cuando los datos están disponibles
      } else {
        console.error('Error al obtener los totales de ingresos y egresos');
      }
    } catch (error) {
      console.error('Error al obtener los totales de ingresos y egresos:', error);
    }
  };

  useEffect(() => {
    actualizarSaldoTotal();
  }, [transactions]); // Agregar 'transactions' como dependencia

  if (loading) {
    return <div>Cargando...</div>; // Muestra un mensaje de carga mientras se obtienen los datos
  }

  return (
    <div className="saldo-total">
      <h5 className="saldo-h3">Saldo total: ${saldoTotal}</h5>
    </div>
  );
}

export default SaldoTotal;

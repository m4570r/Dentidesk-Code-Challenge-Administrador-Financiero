import React, { useState } from 'react';
import TotalGanadoEnMes from './components/TotalGanadoEnMes/TotalGanadoEnMes';
import TotalGastadoEnMes from './components/TotalGastadoEnMes/TotalGastadoEnMes';
import FormularioIngresoTransacciones from './components/FormularioIngresoTransacciones/FormularioIngresoTransacciones';
import MenuNavegacion from './components/MenuNavegacion/MenuNavegacion';
import Inicio from './components/Inicio/Inicio';
import HistorialIngresos from './components/HistorialIngresos/HistorialIngresos';
import SaldoTotal from './components/SaldoTotal/SaldoTotal';
import './index.css';

function App() {
  const [vista, setVista] = useState('inicio');
  const [transactions, setTransactions] = useState([]);

  const mostrarInicio = () => {
    setVista('inicio');
  };

  const mostrarTransacciones = () => {
    setVista('transacciones');
  };

  const mostrarHistorial = () => {
    setVista('historial');
  };

  const handleTransactionAdded = () => {
    // Esta función se llama cuando se agrega una nueva transacción
    // Actualiza el estado de las transacciones
    setTransactions((prevTransactions) => [...prevTransactions, {}]); // Puedes utilizar un objeto vacío o cualquier otro valor
  };

  return (
    <div className="container">
      <MenuNavegacion
        mostrarInicio={mostrarInicio}
        mostrarTransacciones={mostrarTransacciones}
        mostrarHistorial={mostrarHistorial}
      />
      {vista === 'inicio' && <Inicio />}
      {vista === 'transacciones' && (
        <div>
          <TotalGanadoEnMes transactions={transactions} />
          <TotalGastadoEnMes transactions={transactions} />
          <SaldoTotal transactions={transactions} />
          <FormularioIngresoTransacciones onTransactionAdded={handleTransactionAdded} />
        </div>
      )}
      {vista === 'historial' && <HistorialIngresos />}
      {vista !== 'inicio' && vista !== 'transacciones' && vista !== 'historial' && (
        <div>
          <TotalGanadoEnMes transactions={transactions} />
          <TotalGastadoEnMes transactions={transactions} />
          <p>¡Vista no encontrada!</p>
        </div>
      )}
    </div>
  );
}

export default App;

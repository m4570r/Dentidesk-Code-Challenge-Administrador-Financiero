import React, { useState } from 'react';
import TotalGanadoEnMes from './components/TotalGanadoEnMes/TotalGanadoEnMes';
import FormularioIngresoTransacciones from './components/FormularioIngresoTransacciones/FormularioIngresoTransacciones';
import MenuNavegacion from './components/MenuNavegacion/MenuNavegacion';
import Inicio from './components/Inicio/Inicio';
import HistorialIngresos from './components/HistorialIngresos/HistorialIngresos';
import './index.css';

function App() {
  const [vista, setVista] = useState('inicio');

  const mostrarInicio = () => {
    setVista('inicio');
  };

  const mostrarTransacciones = () => {
    setVista('transacciones');
  };

  const mostrarHistorial = () => {
    setVista('historial');
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
          <TotalGanadoEnMes />
          <FormularioIngresoTransacciones />
        </div>
      )}
      {vista === 'historial' && <HistorialIngresos />}
      {vista !== 'inicio' && vista !== 'transacciones' && vista !== 'historial' && (
        <div>
          <p>¡Vista no encontrada!</p>
        </div>
      )}
    </div>
  );
}

export default App;
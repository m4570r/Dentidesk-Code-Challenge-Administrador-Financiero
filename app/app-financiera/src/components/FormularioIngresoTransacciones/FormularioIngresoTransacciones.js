import React, { useState } from 'react';

function FormularioIngresoTransacciones() {
  const [descripcion, setDescripcion] = useState('');
  const [monto, setMonto] = useState('');
  const [tipo, setTipo] = useState('ingreso');

  const handleDescripcionChange = (e) => {
    setDescripcion(e.target.value);
  };

  const handleMontoChange = (e) => {
    setMonto(e.target.value);
  };

  const handleTipoChange = (e) => {
    setTipo(e.target.value);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Lógica para manejar el envío del formulario
  };

  return (
    <div className="formulario-ingreso">
      <h2>Formulario de Ingreso de Transacciones</h2>
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label>Descripción:</label>
          <input
            type="text"
            value={descripcion}
            onChange={handleDescripcionChange}
          />
        </div>
        <div className="form-group">
          <label>Monto:</label>
          <input type="number" value={monto} onChange={handleMontoChange} />
        </div>
        <div className="form-group">
          <label>Tipo:</label>
          <select value={tipo} onChange={handleTipoChange}>
            <option value="ingreso">Ingreso</option>
            <option value="egreso">Egreso</option>
          </select>
        </div>
        <button type="submit">Guardar</button>
      </form>
    </div>
  );
}

export default FormularioIngresoTransacciones;

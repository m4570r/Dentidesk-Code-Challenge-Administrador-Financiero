import React, { useState } from 'react';

function FormularioIngresoTransacciones({ onTransactionAdded }) {
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

  const handleSubmit = async (e) => {
    e.preventDefault();

    // Obtener la fecha actual en el formato deseado ("yyyy-MM-dd")
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().split('T')[0];

    // Construir el objeto de transacción
    const transaction = {
      descripcion,
      monto: parseFloat(monto), // Convertir a número
      tipo,
      date: formattedDate,
    };

    try {
      // Realizar la solicitud POST al endpoint para agregar transacciones
      const response = await fetch(
        'http://192.168.1.139/CodeChallenge/Dentidesk-Code-Challenge-Administrador-Financiero/api/v1/2023/index.php?comando=transactions&addTransactions',
        {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(transaction),
        }
      );

      if (response.ok) {
        // La transacción se agregó con éxito
        alert('Transacción agregada con éxito');
        // Limpiar los campos del formulario
        setDescripcion('');
        setMonto('');
        setTipo('ingreso');
        // Llamar a la función proporcionada para actualizar los datos
        onTransactionAdded();
      } else {
        // Hubo un error al agregar la transacción
        alert('Error al agregar la transacción');
      }
    } catch (error) {
      console.error('Error al agregar la transacción:', error);
    }
  };

  return (
    <div className="formulario-ingreso">
      <h3 className="centered-heading">Ingreso de Transacciones</h3>
      <form className="formulario">
        <div className="form-group">
          <label>Descripción:</label>
          <input
            type="text"
            value={descripcion}
            onChange={handleDescripcionChange}
            className="input-text"
            required
          />
        </div>
        <div className="form-group">
          <label>Monto:</label>
          <input
            type="number"
            value={monto}
            onChange={handleMontoChange}
            className="input-text"
            required
          />
        </div>
        <div className="form-group">
          <label>Tipo:</label>
          <select
            value={tipo}
            onChange={handleTipoChange}
            className="input-select-personal"
            required
          >
            <option value="ingreso">Ingreso</option>
            <option value="egreso">Egreso</option>
          </select>
        </div>
        <button type="button" onClick={handleSubmit} className="submit-button">
          Guardar
        </button>
      </form>
    </div>
  );
}

export default FormularioIngresoTransacciones;

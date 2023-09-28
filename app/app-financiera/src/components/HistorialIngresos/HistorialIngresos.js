import React, { useState, useEffect } from 'react';

function HistorialTransacciones() {
  const [transactions, setTransactions] = useState([]);
  const [editingTransaction, setEditingTransaction] = useState({});
  const [editedTransaction, setEditedTransaction] = useState({
    description: '',
    amount: '',
    date: '',
  });
  const [updateTrigger, setUpdateTrigger] = useState(0);

  useEffect(() => {
    fetch('http://192.168.1.139:8080/api/index.php?comando=transactions')
      .then((response) => response.json())
      .then((data) => setTransactions(data))
      .catch((error) => console.error('Error al obtener transacciones:', error));
  }, [updateTrigger]);

  const handleEditClick = (transaction) => {
    setEditingTransaction(transaction);
    setEditedTransaction({ ...transaction });
  };

  const handleCancelEdit = () => {
    setEditingTransaction({});
    setEditedTransaction({
      description: '',
      amount: '',
      date: '',
    });
  };

  const handleDeleteClick = (transaction) => {
    const confirmDelete = window.confirm('¿Realmente desea eliminar esta transacción?');
  
    if (confirmDelete) {
      const requestBody = {
        id: transaction.id,
      };

      fetch(`http://192.168.1.139:8080/api/index.php?comando=transactions&deleteTransactions`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(requestBody),
      })
        .then((response) => {
          if (response.ok) {
            window.alert('Transacción eliminada con éxito');
            const updatedTransactions = transactions.filter((t) => t.id !== transaction.id);
            setTransactions(updatedTransactions);
            setEditingTransaction({});
            setUpdateTrigger((prevTrigger) => prevTrigger + 1);
          } else {
            window.alert('Error al eliminar la transacción');
          }
        })
        .catch((error) => {
          console.error('Error al eliminar la transacción:', error);
          window.alert('Error al eliminar la transacción');
        });
    }
  };

  const handleSaveEdit = (e) => {
    e.preventDefault(); // Evitar el comportamiento predeterminado del botón (reinicio de la página)
    const confirmEdit = window.confirm('¿Realmente desea editar esta transacción?');
  
    if (confirmEdit) {
      fetch(`http://192.168.1.139:8080/api/index.php?comando=transactions&updateTransactions`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          id: editingTransaction.id,
          descripcion: editedTransaction.description,
          monto: parseFloat(editedTransaction.amount),
          tipo: editedTransaction.type,
          date: editedTransaction.date,
        }),
      })
        .then((response) => {
          if (response.ok) {
            alert('Transacción actualizada con éxito');
            setUpdateTrigger((prevTrigger) => prevTrigger + 1);
            setEditingTransaction({});
            setEditedTransaction({
              description: '',
              amount: '',
              date: '',
            });
          } else {
            alert('Error al actualizar la transacción');
          }
        })
        .catch((error) => {
          console.error('Error al actualizar la transacción:', error);
          alert('Error al actualizar la transacción');
        });
    }
  };

  const isEditing = Object.keys(editingTransaction).length > 0;

  const incomeTransactions = transactions.filter((transaction) => transaction.type === 'ingreso');
  const expenseTransactions = transactions.filter((transaction) => transaction.type === 'egreso');

  const totalIncome = incomeTransactions.reduce((total, transaction) => total + parseFloat(transaction.amount), 0);
  const totalExpense = expenseTransactions.reduce((total, transaction) => total + parseFloat(transaction.amount), 0);

  return (
    <div className="historial-transacciones">
      <div className="historial-ingresos">
        <h3 className="centered-heading">Historial de Ingresos</h3>
        <table className="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Descripción</th>
              <th>Monto</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {incomeTransactions.map((transaction, index) => (
              <tr key={transaction.id} className={index % 2 === 0 ? 'even-row' : 'odd-row'}>
                <td>{transaction.id}</td>
                <td>{transaction.description}</td>
                <td>{transaction.amount}</td>
                <td>{transaction.date}</td>
                <td>
                  <button
                    className="btn btn-primary"
                    onClick={() => handleEditClick(transaction)}
                    disabled={isEditing}
                  >
                    <span role="img" aria-label="Editar">✏️</span>
                  </button>
                  <button
                    className="btn btn-danger"
                    onClick={() => handleDeleteClick(transaction)}
                  >
                    <span role="img" aria-label="Eliminar">❌</span>
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
        <div>
          <strong>Total de Ingresos:</strong> {totalIncome}
        </div>
        {isEditing && (
          <div className="edit-transaction">
            <h3>Editar Transacción</h3>
            <form>
              <div className="form-group">
                <label htmlFor="description">Descripción:</label>
                <input
                  type="text"
                  className="form-control"
                  id="description"
                  name="description"
                  value={editedTransaction.description}
                  onChange={(e) => setEditedTransaction({ ...editedTransaction, description: e.target.value })}
                />
              </div>
              <div className="form-group">
                <label htmlFor="amount">Monto:</label>
                <input
                  type="number"
                  className="form-control"
                  id="amount"
                  name="amount"
                  value={editedTransaction.amount}
                  onChange={(e) => setEditedTransaction({ ...editedTransaction, amount: e.target.value })}
                />
              </div>
              <div className="form-group">
                <label htmlFor="date">Fecha:</label>
                <input
                  type="date"
                  className="form-control"
                  id="date"
                  name="date"
                  value={editedTransaction.date}
                  onChange={(e) => setEditedTransaction({ ...editedTransaction, date: e.target.value })}
                />
              </div>
              <button className="btn btn-primary" onClick={handleSaveEdit}>Guardar</button>
              <button className="btn btn-danger" onClick={handleCancelEdit}>Cancelar</button>
            </form>
          </div>
        )}
      </div>

      <div className="historial-egresos">
        <h3 className="centered-heading">Historial de Egresos</h3>
        <table className="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Descripción</th>
              <th>Monto</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {expenseTransactions.map((transaction, index) => (
              <tr key={transaction.id} className={index % 2 === 0 ? 'even-row' : 'odd-row'}>
                <td>{transaction.id}</td>
                <td>{transaction.description}</td>
                <td>{transaction.amount}</td>
                <td>{transaction.date}</td>
                <td>
                  <button
                    className="btn btn-primary"
                    onClick={() => handleEditClick(transaction)}
                    disabled={isEditing}
                  >
                    <span role="img" aria-label="Editar">✏️</span>
                  </button>
                  <button
                    className="btn btn-danger"
                    onClick={() => handleDeleteClick(transaction)}
                  >
                    <span role="img" aria-label="Eliminar">❌</span>
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
        <div>
          <strong>Total de Egresos:</strong> {totalExpense}
        </div>
      </div>
    </div>
  );
}

export default HistorialTransacciones;

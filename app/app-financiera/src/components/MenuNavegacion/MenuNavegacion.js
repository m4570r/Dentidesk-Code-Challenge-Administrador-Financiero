import React, { useState } from 'react';

function MenuNavegacion({ mostrarInicio, mostrarTransacciones, mostrarHistorial }) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [currentPage, setCurrentPage] = useState('Inicio'); // Página actual

  const toggleMobileMenu = () => {
    setMobileMenuOpen(!mobileMenuOpen);
  };

  const closeMobileMenu = () => {
    setMobileMenuOpen(false);
  };

  const handlePageChange = (page) => {
    setCurrentPage(page);
    closeMobileMenu(); // Cierra el menú móvil al cambiar de página
    // Llama a las funciones para cambiar la vista
    if (page === 'Inicio') {
      mostrarInicio();
    } else if (page === 'Transacciones') {
      mostrarTransacciones();
    } else if (page === 'Historial') {
      mostrarHistorial();
    }
  };

  return (
    <nav className={`navbar ${mobileMenuOpen ? 'open' : ''}`}>
      <div className="nav_logo">Aplicación Financiera</div>
      <div className={`nav_items ${mobileMenuOpen ? 'open' : ''}`}>
        <button onClick={() => handlePageChange('Inicio')}>
          Inicio
        </button>
        <button onClick={() => handlePageChange('Transacciones')}>
          Transacciones
        </button>
        <button onClick={() => handlePageChange('Historial')}>
          Historial
        </button>
      </div>
      <div className={`nav_toggle ${mobileMenuOpen ? 'open' : ''}`} onClick={toggleMobileMenu}>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </nav>
  );
}

export default MenuNavegacion;

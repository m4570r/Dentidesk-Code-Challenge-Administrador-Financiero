import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';
import FormularioIngresoTransacciones from './FormularioIngresoTransacciones';

describe('<FormularioIngresoTransacciones />', () => {
  test('it should mount', () => {
    render(<FormularioIngresoTransacciones />);
    
    const formularioIngresoTransacciones = screen.getByTestId('FormularioIngresoTransacciones');

    expect(formularioIngresoTransacciones).toBeInTheDocument();
  });
});
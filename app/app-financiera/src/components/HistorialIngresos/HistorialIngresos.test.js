import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';
import HistorialIngresos from './HistorialIngresos';

describe('<HistorialIngresos />', () => {
  test('it should mount', () => {
    render(<HistorialIngresos />);
    
    const historialIngresos = screen.getByTestId('HistorialIngresos');

    expect(historialIngresos).toBeInTheDocument();
  });
});
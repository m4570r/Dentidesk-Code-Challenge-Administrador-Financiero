import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';
import TotalGastadoEnMes from './TotalGastadoEnMes';

describe('<TotalGastadoEnMes />', () => {
  test('it should mount', () => {
    render(<TotalGastadoEnMes />);
    
    const totalGastadoEnMes = screen.getByTestId('TotalGastadoEnMes');

    expect(totalGastadoEnMes).toBeInTheDocument();
  });
});
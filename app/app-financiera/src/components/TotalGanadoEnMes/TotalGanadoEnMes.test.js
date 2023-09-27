import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';
import TotalGanadoEnMes from './TotalGanadoEnMes';

describe('<TotalGanadoEnMes />', () => {
  test('it should mount', () => {
    render(<TotalGanadoEnMes />);
    
    const totalGanadoEnMes = screen.getByTestId('TotalGanadoEnMes');

    expect(totalGanadoEnMes).toBeInTheDocument();
  });
});
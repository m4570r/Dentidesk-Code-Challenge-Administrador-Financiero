import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';
import SaldoTotal from './SaldoTotal';

describe('<SaldoTotal />', () => {
  test('it should mount', () => {
    render(<SaldoTotal />);
    
    const saldoTotal = screen.getByTestId('SaldoTotal');

    expect(saldoTotal).toBeInTheDocument();
  });
});
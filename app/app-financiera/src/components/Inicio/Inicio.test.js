import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';
import Inicio from './Inicio';

describe('<Inicio />', () => {
  test('it should mount', () => {
    render(<Inicio />);
    
    const inicio = screen.getByTestId('Inicio');

    expect(inicio).toBeInTheDocument();
  });
});
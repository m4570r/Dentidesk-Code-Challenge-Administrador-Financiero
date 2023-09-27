import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';
import MenuNavegacion from './MenuNavegacion';

describe('<MenuNavegacion />', () => {
  test('it should mount', () => {
    render(<MenuNavegacion />);
    
    const menuNavegacion = screen.getByTestId('MenuNavegacion');

    expect(menuNavegacion).toBeInTheDocument();
  });
});
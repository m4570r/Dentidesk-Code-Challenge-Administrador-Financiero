import React, { lazy, Suspense } from 'react';

const LazyMenuNavegacion = lazy(() => import('./MenuNavegacion'));

const MenuNavegacion = props => (
  <Suspense fallback={null}>
    <LazyMenuNavegacion {...props} />
  </Suspense>
);

export default MenuNavegacion;

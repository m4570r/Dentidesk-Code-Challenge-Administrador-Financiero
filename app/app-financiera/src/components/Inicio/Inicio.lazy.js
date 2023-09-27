import React, { lazy, Suspense } from 'react';

const LazyInicio = lazy(() => import('./Inicio'));

const Inicio = props => (
  <Suspense fallback={null}>
    <LazyInicio {...props} />
  </Suspense>
);

export default Inicio;

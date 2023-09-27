import React, { lazy, Suspense } from 'react';

const LazyHistorialIngresos = lazy(() => import('./HistorialIngresos'));

const HistorialIngresos = props => (
  <Suspense fallback={null}>
    <LazyHistorialIngresos {...props} />
  </Suspense>
);

export default HistorialIngresos;

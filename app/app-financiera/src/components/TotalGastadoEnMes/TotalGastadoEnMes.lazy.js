import React, { lazy, Suspense } from 'react';

const LazyTotalGastadoEnMes = lazy(() => import('./TotalGastadoEnMes'));

const TotalGastadoEnMes = props => (
  <Suspense fallback={null}>
    <LazyTotalGastadoEnMes {...props} />
  </Suspense>
);

export default TotalGastadoEnMes;

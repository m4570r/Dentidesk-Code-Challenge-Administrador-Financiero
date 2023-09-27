import React, { lazy, Suspense } from 'react';

const LazyTotalGanadoEnMes = lazy(() => import('./TotalGanadoEnMes'));

const TotalGanadoEnMes = props => (
  <Suspense fallback={null}>
    <LazyTotalGanadoEnMes {...props} />
  </Suspense>
);

export default TotalGanadoEnMes;

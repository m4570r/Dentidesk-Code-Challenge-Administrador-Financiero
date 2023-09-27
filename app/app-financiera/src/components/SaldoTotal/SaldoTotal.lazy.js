import React, { lazy, Suspense } from 'react';

const LazySaldoTotal = lazy(() => import('./SaldoTotal'));

const SaldoTotal = props => (
  <Suspense fallback={null}>
    <LazySaldoTotal {...props} />
  </Suspense>
);

export default SaldoTotal;

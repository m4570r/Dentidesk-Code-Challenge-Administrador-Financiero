import React, { lazy, Suspense } from 'react';

const LazyFormularioIngresoTransacciones = lazy(() => import('./FormularioIngresoTransacciones'));

const FormularioIngresoTransacciones = props => (
  <Suspense fallback={null}>
    <LazyFormularioIngresoTransacciones {...props} />
  </Suspense>
);

export default FormularioIngresoTransacciones;

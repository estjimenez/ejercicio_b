document.getElementById("formulario").addEventListener("submit", function(event) {
  event.preventDefault();

  const nombre = document.getElementById("nombre").value;
  const categoria = document.getElementById("categoria").value;
  const precio = parseFloat(document.getElementById("precio").value);
  const unidades = parseInt(document.getElementById("unidades").value);

  let descuentoPorcentaje = 0;

  if (categoria === "A") {
    if (unidades <= 10) descuentoPorcentaje = 1;
    else if (unidades <= 20) descuentoPorcentaje = 1.5;
    else descuentoPorcentaje = 2;
  } else if (categoria === "B") {
    if (unidades <= 10) descuentoPorcentaje = 1.2;
    else if (unidades <= 20) descuentoPorcentaje = 2;
    else descuentoPorcentaje = 3;
  } else if (categoria === "C") {
    if (unidades <= 10) descuentoPorcentaje = 0;
    else if (unidades <= 20) descuentoPorcentaje = 0.5;
    else descuentoPorcentaje = 1;
  }

  const precioTotal = precio * unidades;
  const valorDescuento = (precioTotal * descuentoPorcentaje) / 100;
  const totalFinal = precioTotal - valorDescuento;

  const claseDescuento = `descuento-${categoria}`;

  document.getElementById("resultado").innerHTML = `
    <h2>Resultado</h2>
    <p><strong>Producto:</strong> ${nombre}</p>
    <p><strong>Categoría:</strong> ${categoria}</p>
    <p><strong>Unidades:</strong> ${unidades}</p>
    <p><strong>Precio unitario:</strong> $${precio.toFixed(2)}</p>
    <p><strong>Precio total:</strong> $${precioTotal.toFixed(2)}</p>
    <p class="${claseDescuento}"><strong>Descuento:</strong> ${descuentoPorcentaje}%</p>
    <p><strong>Valor del descuento:</strong> $${valorDescuento.toFixed(2)}</p>
    <p><strong>Total a pagar:</strong> $${totalFinal.toFixed(2)}</p>
  `;
});

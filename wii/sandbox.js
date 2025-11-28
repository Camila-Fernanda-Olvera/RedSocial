// Sandbox JS — no importa al proyecto principal
// Modificado por vickyjuarez: 2025-11-27

async function doTest() {
  const out = document.getElementById('output');
  out.textContent = 'Ejecutando prueba...';

  // Ejemplo de llamada fetch (no afecta al proyecto) — usa await según las reglas
  try {
    const res = await fetch('https://api.github.com/zen');
    if (!res.ok) throw new Error(res.statusText);
    const text = await res.text();
    out.textContent = `Respuesta de prueba: ${text}`;
  } catch (err) {
    out.textContent = `Error en la prueba: ${err.message}`;
  }
}

document.getElementById('btnTest').addEventListener('click', () => {
  doTest();
});

# 📜 Instrucciones de Programación 

Estas directrices son obligatorias para todos los proyectos de programación. Cada punto ha sido adaptado para asegurar claridad, cumplimiento estricto y coherencia visual.

---

## 1. 🧩 Estilo y Estructura

### 🔹 HTML, CSS y JavaScript
- Mantén una **separación rigurosa de responsabilidades**:
  - Un solo archivo `.html`
  - Un solo archivo `.js`
  - Si aplica, un solo archivo `.php` y/o `.sql`
- **No se permite la creación de archivos adicionales** salvo que la complejidad lo exija (ej. librerías de terceros o módulos esenciales).

### 🔹 Diseño (CSS)
- 🚫 **Prohibido escribir cualquier código CSS personalizado.**
- ✅ **Obligatorio utilizar únicamente frameworks CSS vía CDN**, como:
  - [Bootstrap](https://getbootstrap.com/)
  - [Tailwind CSS](https://tailwindcss.com/)
- El archivo HTML debe incluir los enlaces CDN correspondientes. No se permite el uso de estilos internos (`<style>`) ni hojas de estilo externas personalizadas (`.css`).

### 🔹 JavaScript (Asincronía)
- Toda operación asincrónica debe implementarse con:
  - Funciones `async`
  - Patrón `fetch-await`
- No se permite el uso de `XMLHttpRequest`, callbacks anidados ni promesas sin `await`.

---

## 2. 🎨 Calidad y Estética

### 🔹 Diseño Visual
- El diseño debe ser:
  - **Moderno**
  - **Único**
  - **Avanzado**
- Debe **respetar estrictamente la temática** solicitada para cada proyecto.

### 🔹 Imágenes
- Las imágenes deben ser:
  - **Contextualmente relevantes**
  - **Visualmente cercanas a la temática**
  - **Optimizadas para carga rápida**

### 🔹 Legibilidad del Código
- El código debe ser:
  - **Claro y limpio**
  - **Bien estructurado**
  - **Fácil de entender**
- Prioriza buenas prácticas: nombres descriptivos, comentarios útiles, y estructura lógica.
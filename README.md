# Documentación de la Librería Common Helpers

Bienvenido a la biblioteca central de Helpers de la aplicación. Esta librería ha sido diseñada bajo los principios de **Responsabilidad Única (SRP)** y las **Reglas de Oro** de diseño: **Estrategia en el Constructor** y **Datos en el Handle**.

A continuación se describen los conceptos de cada directorio y los enlaces a sus guías detalladas.

---

## 📂 [Validación](./docs/validation.md)
**Concepto**: Helpers encargados exclusivamente de realizar comprobaciones y asegurar la integridad de los datos.
- **Responsabilidad**: Deben devolver siempre un valor de tipo `bool`.
- **Ejemplos**: Validar RUT, verificar fortaleza de contraseña, comparar fechas.
- **[Ver detalle de funciones y parámetros →](./docs/validation.md)**

---

## 📂 [Conversión](./docs/conversion.md)
**Concepto**: Helpers destinados a transformar un dato de un tipo a otro totalmente distinto o generar nuevos valores basados en parámetros.
- **Responsabilidad**: Cambiar la naturaleza del dato (ej. de un Objeto a un String).
- **Ejemplos**: Número a palabras, Fecha a texto relativo, Generador de contraseñas aleatorias.
- **[Ver detalle de funciones y parámetros →](./docs/conversion.md)**

---

## 📂 [Strings](./docs/string.md)
**Concepto**: Helpers especializados en la manipulación y limpieza de cadenas de texto.
- **Responsabilidad**: Recibir un `string` y devolver un `string` transformado.
- **Ejemplos**: Slugify, limpieza de caracteres especiales, ofuscación de datos.
- **[Ver detalle de funciones y parámetros →](./docs/string.md)**

---

## 📂 [Arrays](./docs/array.md)
**Concepto**: Helpers diseñados para la gestión de colecciones de datos, listas y estructuras jerárquicas.
- **Responsabilidad**: Operar sobre estructuras de datos `array`.
- **Ejemplos**: Construcción de árboles, aplanamiento de claves, ordenamiento por clave.
- **[Ver detalle de funciones y parámetros →](./docs/array.md)**

---

## 📂 [Documentos de Identidad](./Document/README.md)
**Concepto**: Sistema de validación y formateo de documentos de identidad para LATAM + España.
- **Responsabilidad**: Validar la integridad del número (checksum o regex) y devolver el formato canónico del país.
- **Ejemplos**: RUT chileno, CPF/CNPJ brasileño, DNI/NIF español, CURP mexicano.
- **[Ver detalle de países y tipos soportados →](./Document/README.md)**

---

## 📖 Guías Adicionales
- **[Cómo crear un nuevo Helper (Estándar de Oro)](./GUIDE.md)**: Sigue este estándar para mantener la calidad y coherencia de la librería.
- **[Contratos e Interfaces](./docs/contract.md)**: Definición técnica de las interfaces `HelperInterface`.

---

> **Nota Técnica**: Todos los helpers son `final readonly` y están optimizados para PHP 8.4, garantizando inmutabilidad y alto rendimiento.

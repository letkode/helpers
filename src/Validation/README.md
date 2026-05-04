# Helpers de Validación

Ubicación: `src/Common/Helpers/Validation/`

Helpers encargados de realizar comprobaciones lógicas. Siempre devuelven `bool`.

---

## `CompareDateHelper`
Compara fechas basándose en una estrategia definida.

- **Constructor**:
    - `string $typeRange`: Estrategia (`'greater-equal'`, `'less-equal'`, `'between'`).
    - `string $format = 'Y-m-d'`: Formato de las fechas de entrada.
- **Handle**:
    - `mixed $value`: La fecha principal a comparar.
    - **Parameters**:
        - `start`: Fecha de referencia inicial.
        - `end`: Fecha de referencia final (requerida para `'between'`).

---

## `IsValidDateHelper`
Verifica si un string cumple con un formato de fecha válido.

- **Constructor**:
    - `string $format = 'Y-m-d'`: El formato contra el que se validará.
- **Handle**:
    - `mixed $value`: El string a validar.

---

## `IsValidEmailHelper`
Valida el formato de un email. Opcionalmente verifica que el dominio tenga registro MX.

- **Constructor**:
    - `bool $checkMx = false`: Si `true`, comprueba el registro MX del dominio vía DNS.
- **Handle**:
    - `mixed $value`: El string a validar.

---

## `IsValidIpHelper`
Valida una dirección IP (v4 y/o v6), con control sobre rangos privados y reservados.

- **Constructor**:
    - `bool $allowV6 = true`: Permite direcciones IPv6.
    - `bool $allowPrivate = true`: Permite rangos privados (`192.168.x.x`, `10.x.x.x`, etc.).
    - `bool $allowReserved = true`: Permite rangos reservados.
- **Handle**:
    - `mixed $value`: El string a validar.

---

## `IsValidJsonHelper`
Comprueba si un string es JSON válido.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `mixed $value`: El string a validar.

---

## `IsValidRutHelper`
Valida el formato y dígito verificador de un RUT chileno.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `mixed $value`: El RUT a validar.

---

## `IsValidStrengthHelper`
Evalúa la seguridad de una contraseña.

- **Constructor**:
    - `int $minLength = 8`: Longitud mínima requerida.
- **Handle**:
    - `mixed $value`: La contraseña a evaluar.

---

## `IsValidUrlHelper`
Valida el formato de una URL y comprueba que su esquema esté en la lista permitida.

- **Constructor**:
    - `string[] $allowedSchemes = ['http', 'https']`: Esquemas aceptados.
- **Handle**:
    - `mixed $value`: El string a validar.

---

## `IsValidUuidHelper`
Comprueba si un string es un UUID válido (cualquier versión).

- **Constructor**: Sin parámetros.
- **Handle**:
    - `mixed $value`: El string a validar.

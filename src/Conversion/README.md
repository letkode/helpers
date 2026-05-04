# Helpers de Conversión

Ubicación: `src/Common/Helpers/Conversion/`

Helpers que transforman un dato de un tipo o formato a otro, o generan nuevos valores a partir de parámetros.

---

## `AgoShortDateHelper`
Calcula el tiempo transcurrido en formato humano ("hace X tiempo").

- **Constructor**:
    - `bool $includeTime = true`: Incluye horas, minutos y segundos en la descripción.
- **Handle**:
    - `mixed $value`: Objeto `DateTime` o string de fecha a comparar.

---

## `BytesToHumanHelper`
Convierte un número de bytes a una cadena legible (p. ej. `1048576 → "1.00 MB"`).

- **Constructor**:
    - `int $decimals = 2`: Decimales a mostrar.
    - `string $decimalPoint = '.'`: Separador decimal.
    - `string $thousandsSep = ','`: Separador de miles.
- **Handle**:
    - `mixed $value`: El número de bytes a convertir.

---

## `CurrencyFormatHelper`
Formatea un valor numérico como cadena de moneda (p. ej. `1234.5 → "$1,234.50"`).

- **Constructor**:
    - `string $symbol = '$'`: Símbolo de moneda.
    - `int $decimals = 2`: Decimales.
    - `string $decimalPoint = '.'`: Separador decimal.
    - `string $thousandsSep = ','`: Separador de miles.
    - `bool $symbolBefore = true`: Posición del símbolo (`true` = antes del número).
- **Handle**:
    - `mixed $value`: El número a formatear.

---

## `DateRangeHelper`
Genera una lista de fechas secuenciales.

- **Constructor**:
    - `int $quantityInterval = 1`: Cantidad de fechas a generar.
    - `string $typeInterval = 'day'`: Tipo de intervalo (`'day'`, `'month'`, `'year'`, etc.).
    - `string $format = 'Y-m-d H:i:s'`: Formato de salida.
- **Handle**:
    - `mixed $value`: Fecha de inicio del rango.

---

## `DateToWordsHelper`
Convierte una fecha a su representación literal (p. ej. "lunes, 4 de mayo de 2026").

- **Constructor**:
    - `string $locale = 'es'`: Idioma para la conversión.
- **Handle**:
    - `mixed $value`: La fecha a transformar.

---

## `GenerateRandomPasswordHelper`
Genera una contraseña aleatoria criptográficamente segura usando `random_int`.

- **Constructor**:
    - `int $length = 12`: Longitud de la contraseña.
    - `bool $includeSymbol = false`: Incluye caracteres especiales.
- **Handle**:
    - `mixed $value`: (No utilizado).

---

## `NumberToOrdinalHelper`
Convierte un número a su palabra ordinal en español (1 → "primero").

- **Constructor**: Sin parámetros.
- **Handle**:
    - `mixed $value`: El número a convertir.

---

## `NumberToWordsHelper`
Convierte números a palabras (100 → "cien").

- **Constructor**:
    - `string $locale = 'es_MX'`: Localización para el formateador.
- **Handle**:
    - `mixed $value`: El número a convertir.

---

## `SecondsToHumanHelper`
Convierte segundos a una duración legible (p. ej. `3661 → "1 hour, 1 minute, 1 second"`).

- **Constructor**:
    - `bool $short = false`: Formato corto (`true` → `"1h 1m 1s"`).
- **Handle**:
    - `mixed $value`: Los segundos a convertir.

---

## `ValueToBooleanHelper`
Normaliza valores mixtos a un booleano puro.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `mixed $value`: Valor a evaluar (soporta `'SI'`, `'NO'`, `'TRUE'`, `'FALSE'`, `1`, `0`, etc.).

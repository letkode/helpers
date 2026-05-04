# Helpers de Strings

Ubicación: `src/Common/Helpers/String/`

Helpers especializados en la manipulación y transformación de cadenas de texto. Reciben `string` y devuelven `string`.

---

## `CleanSpecialCharactersHelper`
Limpia textos de caracteres no deseados, tags HTML y entidades.

- **Constructor**:
    - `bool $space = true`: Reemplaza espacios por guiones bajos.
    - `bool $sign = true`: Elimina signos de puntuación especiales.
    - `array $excludeSign = []`: Signos que NO deben eliminarse.
- **Handle**:
    - `string $string`: El texto a limpiar.

---

## `ClearSpaceWhiteHelper`
Elimina espacios múltiples y saltos de línea.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `string $string`: El texto a procesar.

---

## `ExcerptHelper`
Genera un resumen sin cortar palabras a la mitad, truncando por número de caracteres.

- **Constructor**:
    - `int $length = 100`: Longitud máxima en caracteres.
    - `string $suffix = '...'`: Cadena al final del resumen.
- **Handle**:
    - `string $string`: El texto original.

---

## `FormatDateHelper`
Normaliza un string de fecha entre múltiples formatos de entrada a un formato destino.

- **Constructor**:
    - `string $targetFormat = 'Y-m-d'`: Formato de salida deseado.
- **Handle**:
    - `string $string`: El texto que contiene la fecha.

---

## `GenerateHashRandomHelper`
Genera una cadena aleatoria criptográficamente segura usando `random_int`.

- **Constructor**:
    - `int $length = 32`: Longitud del hash.
- **Handle**:
    - `string $string`: (No utilizado).

---

## `GetterByKeyHelper`
Convierte una clave `snake_case` a nombre de método getter en `lCamelCase`.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `string $string`: La clave (p. ej. `user_name` → `getUserName`).

---

## `MaskSensitiveHelper`
Oculta información sensible (emails, tarjetas, texto genérico).

- **Constructor**:
    - `string $type = 'text'`: Estrategia (`'email'`, `'card'`, `'text'`).
    - `string $maskChar = '*'`: Carácter de máscara.
    - `int $visibleCount = 4`: Caracteres visibles al final.
- **Handle**:
    - `string $string`: El dato sensible.

---

## `NormalizeStringHelper`
Elimina acentos y normaliza caracteres Unicode a ASCII.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `string $string`: El texto original.

---

## `ReplaceValuesTextFromArrayHelper`
Sustituye placeholders `#[key]#` en un texto por valores de un array.

- **Constructor**:
    - `string $delimiterStart = '#['`: Inicio del marcador.
    - `string $delimiterEnd = ']#'`: Fin del marcador.
- **Handle**:
    - `string $string`: Texto con marcadores.
    - **Parameters**:
        - `values` *(requerido)*: Array asociativo `['key' => 'valor']`.

---

## `SanitizeFileNameHelper`
Limpia un string para ser usado como nombre de archivo seguro. Requiere la extensión `intl`.

- **Constructor**:
    - `bool $allowDots = true`: Permite puntos en el nombre.
- **Handle**:
    - `string $string`: El nombre sugerido.

---

## `SetterByKeyHelper`
Convierte una clave `snake_case` a nombre de método setter en `lCamelCase`.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `string $string`: La clave (p. ej. `user_name` → `setUserName`).

---

## `SlugifyHelper`
Crea una URL amigable (slug) a partir de un texto.

- **Constructor**:
    - `string $separator = '-'`: Carácter separador.
    - `bool $nullable = false`: Si `true` devuelve `'n-a'` al fallar; si `false`, cadena vacía.
- **Handle**:
    - `string $string`: El texto a transformar.

---

## `StringCaseHelper`
Transforma el casing de un texto a diferentes estilos.

- **Constructor**:
    - `string $case = 'snake'`: Estilo (`'snake'`, `'lCamel'`, `'uCamel'`, `'kebab'`, `'ucwords'`).
    - `string $separate = ' '`: Separador de entrada.
    - `bool $hasClear = true`: Limpia caracteres especiales antes de transformar.
- **Handle**:
    - `string $string`: El texto a transformar.

---

## `StringToUTF8Helper`
Asegura que el texto sea UTF-8 válido.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `string $string`: El texto original.

---

## `TitleCaseCompanyHelper`
Aplica Title Case respetando excepciones de palabras en minúscula (artículos, preposiciones).

- **Constructor**: Sin parámetros.
- **Handle**:
    - `string $string`: El nombre a formatear.

---

## `TransformPhoneFromStringHelper`
Normaliza un número telefónico añadiendo el prefijo de país si no está presente.

- **Constructor**:
    - `string $countryCode = '+56'`: Código de país (p. ej. `'+56'`, `'+54'`, `'+34'`).
- **Handle**:
    - `string $string`: El número telefónico.

---

## `TruncateByWordsHelper`
Trunca un texto a un máximo de palabras sin cortar palabras a la mitad.
Distinto de `ExcerptHelper`, que trunca por número de caracteres.

- **Constructor**:
    - `int $maxWords = 20`: Número máximo de palabras.
    - `string $suffix = '...'`: Cadena al final si se trunca.
- **Handle**:
    - `string $string`: El texto a truncar.

# Contratos e Interfaces de Helpers

Ubicación: `src/Common/Helpers/Contract/`

Interfaces fundamentales que definen el contrato de todos los Helpers. Garantizan intercambiabilidad y cumplimiento del estándar arquitectónico.

---

## Estructura del Método Principal

Todas las interfaces definen el método `handle`, que sigue la **Regla de Oro de Datos**:

- **Primer parámetro** (`$value`, `$string`, `$array`, etc.): El dato principal sobre el que se opera.
- **Segundo parámetro** (`array $parameters`): Contexto dinámico extra — nunca para sobrescribir configuración del constructor.

---

## Catálogo de Interfaces

### `ValidatorHelperInterface`
- **Propósito**: Validaciones lógicas que comprueban integridad o formato.
- **Retorno**: `bool`
- **Firma**: `public function handle(mixed $value, array $parameters = []): bool;`

### `ConverterHelperInterface`
- **Propósito**: Transformaciones que cambian el tipo de dato (número → string, bytes → legible).
- **Retorno**: `mixed`
- **Firma**: `public function handle(mixed $value, array $parameters = []): mixed;`

### `StringHelperInterface`
- **Propósito**: Transformaciones donde entrada y salida son `string`.
- **Retorno**: `string`
- **Firma**: `public function handle(string $string, array $parameters = []): string;`

### `ArrayHelperInterface`
- **Propósito**: Manipulación de colecciones y estructuras de datos.
- **Retorno**: `array`
- **Firma**: `public function handle(array $array, array $parameters = []): array;`

### `NumberHelperInterface`
- **Propósito**: Operaciones matemáticas o transformaciones numéricas puras.
- **Retorno**: `int|float`
- **Firma**: `public function handle(int|float $number, array $parameters = []): int|float;`

### `PasswordHelperInterface`
- **Propósito**: Procesamiento de contraseñas (hashing, verificación, transformación).
- **Retorno**: `string`
- **Firma**: `public function handle(string $password, array $parameters = []): string;`

---

## Notas de Implementación

1. **Tipado estricto**: `declare(strict_types=1);` obligatorio.
2. **Inmutabilidad**: Las clases implementadoras deben ser `final readonly`.
3. **Configuración en constructor**: Las opciones de comportamiento van en el constructor, nunca en `$parameters`.
4. **`$parameters` solo para datos**: Se usa para valores dinámicos de ejecución (p. ej. una segunda colección a comparar), no para cambiar el comportamiento del Helper.

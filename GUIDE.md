# Guía de Creación de Helpers

Esta documentación define el estándar para la creación de nuevos Helpers en el namespace `App\Common\Helpers`. La arquitectura se basa en el **Principio de Responsabilidad Única (SRP)** y las **"Reglas de Oro"** de diseño para PHP 8.4.

---

## 1. Las Reglas de Oro

### A. Estrategia en el Constructor (¿CÓMO trabaja?)
Todo lo que defina el **comportamiento fijo** o la **configuración** del Helper debe inyectarse en el constructor. Una vez instanciado, el Helper es inmutable.
- **Ejemplos**: Formatos de fecha, separadores, locales, niveles de seguridad, símbolos de moneda.

### B. Contexto en el Handle (¿CON QUÉ trabaja?)
El método `handle` solo debe recibir los **datos variables** necesarios para la ejecución inmediata.
- **Ejemplos**: El array a procesar, la fecha a comparar, el texto a transformar.

---

## 2. Convención de Nombres

| Elemento | Regla | Ejemplo |
| :--- | :--- | :--- |
| Clase | `final readonly`, sufijo `Helper` | `BytesToHumanHelper` |
| Carpeta | Categoría funcional, sin infix en clase | `Conversion/BytesToHumanHelper` |
| Interfaz | Categoría + `HelperInterface` | `ConverterHelperInterface` |

El folder ya codifica la categoría — **no** repetirla en el nombre de clase (`FlattenHelper`, no `FlattenArrayHelper`).

---

## 3. Tipos de Helpers y Contratos

Elige la interfaz según el retorno del Helper:

| Interfaz | Retorno | Propósito |
| :--- | :--- | :--- |
| `ValidatorHelperInterface` | `bool` | Validaciones y comprobaciones lógicas |
| `ConverterHelperInterface` | `mixed` | Transformaciones que cambian el tipo de dato |
| `StringHelperInterface` | `string` | Transformaciones puras de texto |
| `ArrayHelperInterface` | `array` | Manipulación de estructuras de datos |
| `NumberHelperInterface` | `int\|float` | Operaciones matemáticas puras |
| `PasswordHelperInterface` | `string` | Procesamiento de contraseñas (hash, verificación) |

---

## 4. Ejemplo Práctico

```php
<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use Letkode\Helpers\Contract\ConverterHelperInterface;

final readonly class RoundHelper implements ConverterHelperInterface
{
    // Regla de Oro A: configuración en constructor
    public function __construct(
        private int $precision = 2,
        private int $mode = PHP_ROUND_HALF_UP,
    ) {
    }

    // Regla de Oro B: solo el dato variable en handle
    public function handle(mixed $value, array $parameters = []): float
    {
        if (!is_numeric($value)) {
            return 0.0;
        }

        return round((float) $value, $this->precision, $this->mode);
    }
}
```

### Inyectar dependencias de otros Helpers

Usa `new` en el inicializador del constructor (PHP 8.1+) en lugar de instanciar dentro de `handle`:

```php
final readonly class StringCaseHelper implements StringHelperInterface
{
    public function __construct(
        private string $case = 'snake',
        // dependencia inyectada, no instanciada en handle()
        private CleanSpecialCharactersHelper $cleaner = new CleanSpecialCharactersHelper(space: false),
    ) {
    }

    public function handle(string $string, array $parameters = []): string
    {
        return match ($this->case) {
            'snake' => strtolower(str_replace(' ', '_', $this->cleaner->handle($string))),
            // ...
        };
    }
}
```

---

## 5. Checklist de Calidad (PHP 8.4)

1. **Tipado estricto**: `declare(strict_types=1);` en todas las clases.
2. **Inmutabilidad**: La clase debe ser `final readonly`.
3. **Nombre**: Solo sufijo `Helper`, sin infix de categoría.
4. **Constructor promotion**: Define propiedades directamente en el constructor.
5. **Multibyte**: Para strings usa funciones `mb_*` (`mb_strlen`, `mb_substr`, etc.).
6. **Sin sobrescritura**: No uses `$parameters` para cambiar lo que ya configuraste en el constructor.
7. **Dependencias**: Inyecta otros Helpers via `new` en el inicializador del constructor, nunca dentro de `handle`.
8. **Aleatoriedad segura**: Usa `random_int` / `random_bytes` para cualquier valor aleatorio, nunca `str_shuffle` o `rand`.

---

## 6. Por qué esta arquitectura

- **Testabilidad**: Cada Helper es testeable en aislamiento sin mocks.
- **DI nativa**: Se configura una vez en el contenedor de Symfony y se reutiliza con ese comportamiento.
- **Portabilidad**: Sin dependencias del framework — extraíble como paquete Composer.

# Helpers de Arrays

Ubicación: `src/Common/Helpers/Array/`

Helpers para manipulación de colecciones, árboles y estructuras de datos.

---

## `AddPrefixKeysHelper`
Añade un prefijo a todas las claves de un array de forma recursiva.

- **Constructor**:
    - `string $prefix`: El prefijo a añadir.
    - `string $separator = '_'`: Separador entre el prefijo y la clave original.
- **Handle**:
    - `array $array`: El array a procesar.

---

## `BuildParentChildTreeHelper`
Construye una estructura básica de árbol padre-hijo (1 nivel).

- **Constructor**: Sin parámetros.
- **Handle**:
    - `array $array`: Lista de elementos con `parent_id`, `parent_name`, `child_id` y `child_name`.

---

## `BuildTreeByParentHelper`
Genera un árbol multinivel complejo basado en indicadores de nivel.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `array $array`: Lista de elementos con los campos `_id`, `parent_id` y `_level`.

---

## `BuildTreeUserGroupHelper`
Gestiona la jerarquía de grupos de usuarios en múltiples direcciones.

- **Constructor**:
    - `string $direction = 'DESC'`: Dirección (`'BI'`, `'DESC'`, `'ASC'`, `'DD'`, `'UD'`, `'BID'`).
    - `bool $addGroupBase = true`: Incluye el grupo base en el resultado.
- **Handle**:
    - `array $array`: Mapeo de relación `hijo => padre`.
    - **Parameters**:
        - `groupBase`: ID o array de IDs desde donde iniciar.

---

## `ChunkHelper`
Divide un array en lotes de tamaño fijo. Útil para procesamiento en batch (p. ej. Messenger).

- **Constructor**:
    - `int $size = 100`: Tamaño de cada lote.
    - `bool $preserveKeys = false`: Conserva las claves originales en cada sublote.
- **Handle**:
    - `array $array`: El array a dividir.

---

## `ConvertArrayInUniqueKeyHelper`
Aplana un array anidado concatenando sus claves con un separador.

- **Constructor**:
    - `string $prefix = ''`: Prefijo inicial.
    - `string $separator = '.'`: Separador para las claves concatenadas (p. ej. `user.profile.name`).
- **Handle**:
    - `array $array`: El array anidado.

---

## `ConvertValuesToDoctrineHelper`
Normaliza las claves de un array al formato camelCase compatible con Doctrine.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `array $array`: El array original con claves `snake_case`.

---

## `DiffByKeyHelper`
Devuelve los ítems de `$array` cuyo valor de clave **no** está presente en `$parameters['against']`.
Funciona con arrays de arrays y arrays de objetos.

- **Constructor**:
    - `string $key`: La clave por la que comparar.
- **Handle**:
    - `array $array`: La colección base.
    - **Parameters**:
        - `against`: La colección contra la que se compara.

---

## `DynamicArrayOtherSimpleByDataHelper`
Reconstruye un array anidado a partir de claves planas con separadores.

- **Constructor**:
    - `string $separator = '.'`: Separador usado en las claves planas.
- **Handle**:
    - `array $array`: Array plano (p. ej. `['user.name' => 'John']`).

---

## `FlattenHelper`
Extrae todos los valores de un array multidimensional a una lista plana.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `array $array`: Estructura multidimensional.

---

## `GroupArrayColumnHelper`
Agrupa valores de una columna basándose en otra columna índice.

- **Constructor**:
    - `string|int $columnKey`: Nombre de la columna con los datos.
    - `string|int $indexKey`: Nombre de la columna que sirve de índice/grupo.
- **Handle**:
    - `array $array`: Lista de arrays asociativos.

---

## `PluckHelper`
Extrae una lista simple de valores de una columna específica.

- **Constructor**:
    - `string $key`: La clave que se desea extraer.
- **Handle**:
    - `array $array`: El array de origen.

---

## `RangeColsDynamicHelper`
Genera nombres de columnas dinámicas (A, B… Z, AA, AB…).

- **Constructor**:
    - `int $count`: Cantidad de columnas a generar.
- **Handle**:
    - `array $array`: (No utilizado).

---

## `SearchByArrayHelper`
Busca un valor en un array profundo usando una ruta de claves.

- **Constructor**:
    - `array $searchArray = []`: Ruta de claves por defecto.
    - `mixed $default = null`: Valor a devolver si no se encuentra nada.
- **Handle**:
    - `mixed $value`: El array donde buscar.
    - **Parameters**:
        - `searchArray`: Ruta de claves específica para esta búsqueda.
        - `default`: Valor por defecto específico.

---

## `SortByKeyHelper`
Ordena una lista de arrays por una de sus claves.

- **Constructor**:
    - `string $key`: Clave por la cual ordenar.
    - `bool $orderDesc = false`: Orden descendente.
- **Handle**:
    - `array $array`: La lista a ordenar.

---

## `UniqueByKeyHelper`
Elimina duplicados de un array basándose en el valor de una clave específica. Conserva la primera ocurrencia.
Funciona con arrays de arrays y arrays de objetos.

- **Constructor**:
    - `string $key`: La clave cuyo valor determina unicidad.
- **Handle**:
    - `array $array`: La colección a deduplicar.

---

## `ZipHelper`
Combina dos arrays en uno asociativo usando el primero como claves y el segundo como valores.
Trunca al tamaño del más corto.

- **Constructor**: Sin parámetros.
- **Handle**:
    - `array $array`: Las claves.
    - **Parameters**:
        - `with`: Los valores a combinar.

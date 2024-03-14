# LaraFinder 🔍

LaraFinder is a Laravel package designed to simplify the process of searching data from the database. It provides convenient methods to search through specified columns or across all columns of a given model.

## Installation

You can install LaraFinder via Composer. Run the following command in your terminal:

```bash
composer require mayankjaviya/lara-finder
```

## Usage

```php
use mayankjaviya\LaraFinder\LaraFinder;

// Search for a value in specific columns
$results = LaraFinder::search('App\Models\User', 'John', ['name', 'email']);

// Search for a value across all columns
$results = LaraFinder::searchAll('App\Models\User', 'John');

// Search for a value across all columns except specified ones
$results = LaraFinder::searchAllExcept('App\Models\User', 'John', ['password']);

// It returns an associative array where each key represents a column name and the corresponding value is a collection of search results.
$results = LaraFinder::searchableColumns('App\Models\User', 'John', ['name', 'email']);

// Search for a value across multiple models
$models = ['App\Models\User', 'App\Models\Post'];
$results = LaraFinder::searchInMultipleModel($models, 'John');

// Search for a value within a related model
$results = LaraFinder::searchWithRelation('App\Models\User', 'John', 'App\Models\Post');
```

## Methods

#### `search($model, $value, $columns)`

- **Description**: Searches for a value in specified columns of the given model.
- **Parameters**:
  - `$model`: The fully qualified class name of the model to search.
  - `$value`: The value to search for.
  - `$columns`: An array of column names to search within.
- **Return Value**: A collection of search results.

#### `searchAll($model, $value)`

- **Description**: Searches for a value across all columns of the given model.
- **Parameters**:
  - `$model`: The fully qualified class name of the model to search.
  - `$value`: The value to search for.
- **Return Value**: A collection of search results.

#### `searchAllExcept($model, $value, $except)`

- **Description**: Searches for a value across all columns of the given model except for the specified ones.
- **Parameters**:
  - `$model`: The fully qualified class name of the model to search.
  - `$value`: The value to search for.
  - `$except`: An array of column names to exclude from the search.
- **Return Value**: A collection of search results.

#### `searchableColumns($model, $value, $columns = [])`

- **Description**: Searches for a value in specified columns of the given model or in all columns if none are specified.
- **Parameters**:
  - `$model`: The fully qualified class name of the model to search.
  - `$value`: The value to search for.
  - `$columns`: (Optional) An array of column names to search within. If not provided, all columns of the model will be searched.
- **Return Value**: An associative array where each key represents a column name, and the corresponding value is a collection of search results.

#### `searchInMultipleModel($models, $value)`

- **Description**: Allows searching for a specific value across multiple models. It iterates over each model provided in the `$models` array and searches for the value in the specified columns.
- **Parameters**:
  - `$models`: An array of model class names to search within.
  - `$value`: The value to search for.
- **Return Value**: An associative array where each key represents a model class name, and the corresponding value is a query builder instance with the search conditions applied.

#### `searchWithRelation($model, $value, $relation)`

- **Description**: Enables searching for a value within a related model while also considering the main model's attributes. It utilizes eager loading to load related models and performs the search across both the main model and its related model.
- **Parameters**:
  - `$model`: The main model class name to search within.
  - `$value`: The value to search for.
  - `$relation`: The related model class name to search within.
- **Return Value**: A collection of instances of the main model (`$model`) with related models loaded where the search condition is met.

## Parameters

- `$model`: The fully qualified class name of the model to search.
- `$value`: The value to search for.
- `$columns`: (Optional) An array of column names to search within. If not provided, all columns of the model will be searched.
- `$except`: (Optional) An array of column names to exclude from the search.

## Contributing

Contributions are welcome! Please feel free to submit pull requests or open issues.

## License

This package is open-source software licensed under the [MIT license](LICENSE).

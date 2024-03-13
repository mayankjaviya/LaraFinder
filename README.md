# LaraFinder 🔍

LaraFinder is a Laravel package designed to simplify the process of searching data from the database. It provides convenient methods to search through specified columns or across all columns of a given model.

## Installation

You can install LaraFinder via Composer. Run the following command in your terminal:

```bash
composer require mayankjaviya/lara-finder
```

## Usage

### Basic Usage

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
```

### Methods

- `search($model, $value, $columns = [])`: Searches for a value in specified columns of the given model.
- `searchAll($model, $value)`: Searches for a value across all columns of the given model.
- `searchAllExcept($model, $value, $except)`: Searches for a value across all columns of the given model except for the specified ones.
- `searchableColumns($model, $value, $columns = [])`: Searches for a value in specified columns of the given model or in all columns if none are specified. Returns an associative array where each key represents a column name, and the corresponding value is a collection of search results.

### Parameters

- `$model`: The fully qualified class name of the model to search.
- `$value`: The value to search for.
- `$columns`: (Optional) An array of column names to search within. If not provided, all columns of the model will be searched.
- `$except`: (Optional) An array of column names to exclude from the search.

## Contributing

Contributions are welcome! Please feel free to submit pull requests or open issues.

## License

This package is open-source software licensed under the [MIT license](LICENSE).

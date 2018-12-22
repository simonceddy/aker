# Aker

___

Aker is a small library that provides convenience classes for handling JSON files.

It is named after former AFL player, and Hall Of Famer, Jason Akermanis.

___

## Installation

Aker can be installed with Composer:

```sh
composer require simoneddy/aker
```

___

## Basic Use

___

### Creating a new JsonFile object

___

The JsonFile constructor accepts two optional arguments:

- A filename (will automatically have .json appended if not already present).

- A JSON string, or the contents of the file.

```php
$file = new Eddy\Aker\JsonFile('filename', 'json string');
```

Both these properties can be set and accessed after construction:

```php
$file = new Eddy\Aker\JsonFile();

// Setters return $this, so can be chained together:
$file->setFilename('filename')
    ->setContents('json string');

var_dump($file->filename()); // (string) 'filename.json'
var_dump($file->contents()); // (string) 'json string'
```

___

### Using the Fs (Filesystem) class

___

Aker includes a basic filesystem class called Fs.

This class provides methods for storing and reading JSON files from a specified directory.

The Fs class always requires a working directory. We specify this directory by passing its path to the constructor:

```php
$fs = new Eddy\Aker\Fs(dirname(__DIR__).'/my_json_dir');
```

However, it is worth noting that the directory can be changed after construction:

```php
$fs->setDir(__DIR__.'/my_local_json_dir');
```

The Fs object provides some convenience methods for storing and loading JSON files.

Let's use the $file object from our JsonFile examples above.

The save() method saves an instance of FileInterface (which is implemented by the JsonFile class) to JSON.

The load() method accepts a filename and, if the file exists, will return a JsonFile object with the resolved file's contents.

```php
// Uses the $file object's filename and saves the file with $fs
$fs->save($file);

// Load will also automatically append .json to the filename if not present:
$file = $fs->load('filename');

// $file is an instance of FileInterface (JsonFile by default)
var_dump($file->filename()); // (string) 'filename.json'
```

If Fs detects directory separators in a JsonFile's filename, it will create any non-existing sub directories when saving:

```php
$file = new Eddy\Aker\JsonFile('data/test', 'json');

// If a data directory does not exist in our storage dir, $fs will create it.
$fs->save($file);

// This will create a JsonFile object identical to our original $file
$file = $fs->load('data/test');
```

__NOTE__ As FileInterface is not JSON specific, the goal is to make the Fs class file type agnostic (to a point). At present it will only deal with JSON.

___

### The Json helper class

___

Aker includes a Json class that provides some convenience wrappers around `json_decode()` and `json_encode()`, as well as static JsonFile factory.

You can use the `Json::toFile()` static factory method to create a JsonFile object from arguments. This is ultimately the same as constructing a new JsonFile object, and whether you use this method is up to personal preference.

```php
// This is the same as calling new Eddy\Aker\JsonFile('filename', 'json')
$file = Eddy\Aker\Json::toFile('filename', 'json');

// $file is an instance of JsonFile)
var_dump($file->filename()); // (string) 'filename'
```

___

#### Helper Methods

___

- __Json::toArray($file)__: Converts a JsonFile object into an array. This is a simple wrapper around PHPs own `json_decode()` with $assoc (the second argument) set to true. This means JSON objects will always be converted into associative arrays using this method.

- __Json::toArrayObject($file)__: Converts a JsonFile object into a PHP `ArrayObject`. This is method will call on `toArray()` and attempt to construct a new ArrayObject with the result. __Currently very buggy__.

- __Json::encode($contents, $options = null)__: A simple wrapper around PHPs own `json_encode()` method that defaults to using `JSON_PRETTY_PRINT` if $options is null. Will throw an Exception if it cannot encode $contents. This method returns the JSON string, and does not create a JsonFile object.
# php-database
A static helper for Nette's Database Explorer used in our smaller projects.

See  `examples/demo.php` to find out how to use this class.

# Introduction
Fast and easy to use static database management powered by Nette's Database (Explorer).
Adding connections initiates two different objects, the first is Nette's Core (Connection) and the second is Explorer. It supports fast access to PDO too.

### Requirements
- PHP 8.1+
- Composer
- PDO extension

### Installation
Install using Composer with: `composer require hybula/php-database`

### Usage
```php
<?php

// Autoload using Composer;
require_once __DIR__.'/vendor/autoload.php';

use Hybula\Database\Database;

// Create our first demo connection;
Database::connect('demo1', 'mysql:host=HOSTNAME;dbname=DATABASE', 'USERNAME', 'PASSWORD');

// Do a demo query;
Database::explorer('demo1')->table('table')->select('fieldname');

// Let's open another connection under a different name;
Database::connect('demo2', 'mysql:host=HOSTNAME;dbname=DATABASE', 'USERNAME', 'PASSWORD');

// Do another query;
Database::explorer('demo2')->table('table')->select('fieldname');

// In case you want to do some other stuff, let's get the PDO object;
$pdo = Database::pdo('demo1');

```

### Contribute
Contributions are welcome in a form of a pull request (PR).

### License
Mozilla Public License Version 2.0
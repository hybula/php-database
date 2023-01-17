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

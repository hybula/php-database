<?php
/**
 *   _  ___   _____ _   _ _      _
 *  | || \ \ / / _ ) | | | |    /_\
 *  | __ |\ V /| _ \ |_| | |__ / _ \
 *  |_||_| |_| |___/\___/|____/_/ \_\
 *
 * @copyright  Copyright (c) Hybula B.V. (https://www.hybula.com)
 * @author     Hybula Development Team <development@hybula.com>
 * @copyright  2017-2023 Hybula B.V.
 * @license    MPL-2.0 License
 * @link       https://github.com/hybula/php-database
 */

declare(strict_types=1);

namespace Hybula\Database;

class Database
{
    /**
     * @var array Containing all active connections.
     */
    private static array $connections;

    /**
     * Connects to a database using the defined engine.
     * @param  string  $name Name to give this connection;
     * @param  string  $dsn Data source name defining engine, hostname and database;
     * @param  string  $username Username to use when connecting;
     * @param  string  $password Password to use combined with username;
     * @return void
     */
    public static function connect(string $name, string $dsn, string $username, string $password): void
    {
        $cachingStorage = new \Nette\Caching\Storages\MemoryStorage();
        self::$connections[$name]['core'] = $databaseConnection = new \Nette\Database\Connection($dsn, $username, $password);
        $databaseStructure = new \Nette\Database\Structure($databaseConnection, $cachingStorage);
        $databaseConventions = new \Nette\Database\Conventions\DiscoveredConventions($databaseStructure);
        self::$connections[$name]['explorer'] = new \Nette\Database\Explorer($databaseConnection, $databaseStructure, $databaseConventions, $cachingStorage);
    }

    /**
     * Finds and returns the Nette Core (Connection) object.
     * @param  string  $name Name of the connection;
     * @return \Nette\Database\Connection
     */
    public static function core(string $name): \Nette\Database\Connection
    {
        return self::$connections[$name]['core'];
    }

    /**
     * Finds and returns the Nette Explorer object.
     * @param  string  $name Name of the connection;
     * @return \Nette\Database\Explorer
     */
    public static function explorer(string $name): \Nette\Database\Explorer
    {
        return self::$connections[$name]['explorer'];
    }

    /**
     * Closes the connection by assigning null.
     * @param  string  $name Name of the connection;
     * @return void
     */
    public static function close(string $name): void
    {
        self::$connections[$name] = NULL;
    }

    /**
     * Finds and returns the old school PDO object.
     * @param  string  $name Name of the connection;
     * @return \PDO
     */
    public static function pdo(string $name): \PDO
    {
        return self::$connections[$name]['core']->getPdo();
    }
}

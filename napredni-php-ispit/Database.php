<?php

class Database
{
    public $connection = null;
    public static $instance = null;

    public function __construct()
    {
        // * Primjer za sqlite i mysql
        $database_configuration = ConfigurationManager::get_db_configuration(
            "sqlite"
        );

        $this->connect_sqlite_database($database_configuration);

        // $database_configuration = ConfigurationManager::get_db_configuration(
        //     "mysql"
        // );

        // $this->connect_mysql_database($database_configuration);
    }

    public static function get_instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get_connection(): PDO
    {
        return $this->connection;
    }

    public function connect_sqlite_database($sqlite_config): void
    {
        $dsn = "sqlite:" . $sqlite_config["path"];

        try {
            $this->connection = new PDO($dsn);
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $error) {
            die("SQLite connection failed: " . $error->getMessage());
        }
    }

    public function connect_mysql_database($mysql_config): void
    {
        $dsn = sprintf(
            "%s:host=%s;port=%s;dbname=%s;charset=%s",
            $mysql_config["driver"],
            $mysql_config["host"],
            $mysql_config["port"],
            $mysql_config["database"],
            $mysql_config["charset"]
        );

        try {
            $this->connection = new PDO(
                $dsn,
                $mysql_config["username"],
                $mysql_config["password"]
            );
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $error) {
            die("Database connection failed: " . $error->getMessage());
        }
    }
}

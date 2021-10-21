<?php require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php'; ?>
<?php
class DatabaseConnector
{
    private static PDO $connection;
    public static function getConnection():PDO
    {
        if (isset(self::$connection))
            return self::$connection;
        self::$connection = new PDO
        (
            DATABASE_CONNECTION_DSN,
            DATABASE_CONNECTION_USER_ID,
            DATABASE_CONNECTION_USER_PASSWORD
        );
        return self::$connection;
    }
}
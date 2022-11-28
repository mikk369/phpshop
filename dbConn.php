<?php
class dbConn {
    private $serverName = "localhost";
    private $userName = "root";
    private $password = "";
    private $database = "id19902331_webshop";

    protected function connect() {
        $dsn = 'mysql:host=' . $this->serverName . ';dbname=' . $this->database;
        $pdo = new PDO($dsn, $this->userName, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}

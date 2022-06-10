<?php
function dbConnect()
{

    //Laad de database gegevens uit het config bestand
    $db = require(__DIR__ . '/config.php');

    try {
        // Hier maken we de database verbinding
        $connection = new PDO("mysql:host=" .$db['server'] .";dbname=" .$db['database']. ";port=" .$db['port'],$db['username'], $db['password']);

        // Database verbindings opties instellen
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $connection;
    } catch (PDOException $error) {
        echo "Verbinding niet gemaakt: " .  $error->getMessage();
        exit;
    }
}
?>
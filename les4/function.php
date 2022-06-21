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

function isEmpty($value){
    return empty($value);
}
function isvalidEmail($value){
    $cleaned = filter_var($value, FILTER_SANITIZE_EMAIL);
    if($cleaned == false){
        return false;
    }

    return filter_var($cleaned, FILTER_VALIDATE_EMAIL);
}

function hasMinLength($value, $min_length){

    $length = strlen($value);
    if ($length >= $min_length){
        return true;
    }
    return false;
}

?>
<?php
require_once 'helpers.php';
require_once 'config.php';


$GLOBALS['connection'] = connectToDatabase($config);

function connectToDatabase($config)
{
    if (isset($config['connection'])) {
        $conn = $config['connection'];
    }

    $host = $conn['host'];
    $db = $conn['database'];
    $user = $conn['username'];
    $password = $conn['password'];

    $dsn = "mysql:host=$host;dbname=$db;";

    try {
        $pdo = new PDO($dsn, $user, $password);

        if ($pdo) {
            return $pdo;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit(404);
    }
}


function get($table, $id = null)
{
    $connection = $GLOBALS['connection'];

    if ($id) {
        $sql = "SELECT * FROM `$table` WHERE `id` = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $sql = "SELECT * FROM $table";
        $stmt = $connection->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $result;
}
function getClientRegistrations($email)
{
    $connection = $GLOBALS['connection'];
    $sql = "SELECT * FROM `registrations` WHERE `email` = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$email]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function create($table, $data)
{
    $connection = $GLOBALS['connection'];

    $columns = $values = '';
    $count = count($data);
    $i = 0;

    foreach ($data as $key => $d) {
        $i++;
        $columns .= "`$key`";
        $values .= ":$key";
        if ($i < $count) {
            $columns .=  ', ';
            $values .= ', ';
        }
    }

    $sql = "INSERT INTO $table
    ($columns)
    VALUES 
    ($values)";


    $stmt = $connection->prepare($sql);
    $stmt->execute($data);
}


function updateRegistration($date, $time, $id)
{
    $connection = $GLOBALS['connection'];
    $sql = "UPDATE `registrations` SET `date` = ?, `time` = ? WHERE `id` = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$date, $time, $id]);
}

function delete($table, $id)
{

    $connection = $GLOBALS['connection'];
    $sql = "DELETE FROM `$table` WHERE `id` = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$id]);
}

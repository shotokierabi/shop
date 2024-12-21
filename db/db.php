<?php

session_start();
require ('connect.php');

function test($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}

//Выполнение запроса бд
function dbError($query)
{
    $err = $query->errorInfo();
    if ($err[0] !== PDO::ERR_NONE) {
        echo $err[2];
        exit();
    }
    return true;
}

//Запрос на вывод всех данных одной таблицы
function selectAll($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbError($query);

    return $query->fetchAll();
}


//Запрос на вывод одной строки из одной таблицы
function selectOne($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbError($query);

    return $query->fetch();
}

//Запись в таблицу бд
function insert($table, $params)
{
    global $pdo;

    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . " $value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbError($query);
    return $pdo->lastInsertId();
}

//Обновление данных бд
function update($table, $name_id, $id, $params)
{
    global $pdo;

    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str = $str . $key . " = '" . $value . "'";
        } else {
            $str = $str . ", " . $key . " = '" . $value . "'";
        }
        $i++;
    }
    $sql = "UPDATE $table SET $str WHERE $table . $name_id = $id";

    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbError($query);
}


//Удаление данных бд
function deleteAll($table, $name_id, $id)
{
    global $pdo;

    $sql = "DELETE FROM $table WHERE $table . $name_id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbError($query);
}

function salt()
{
    $salt = substr(md5(uniqid()), -8);
    return $salt;
}



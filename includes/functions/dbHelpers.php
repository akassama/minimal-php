<?php

/**
 * Returns a GUIDv4 string
 *
 * Uses the best cryptographically secure method
 * for all supported pltforms with fallback to an older,
 * less secure version.
 *
 * @param bool $trim
 * @return string
 */
function getGUID ($trim = true)
{
    // Windows
    if (function_exists('com_create_guid') === true) {
        if ($trim === true)
            return trim(com_create_guid(), '{}');
        else
            return com_create_guid();
    }

    // OSX/Linux
    if (function_exists('openssl_random_pseudo_bytes') === true) {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    // Fallback (PHP 4.2+)
    mt_srand((double)microtime() * 10000);
    $charid = strtolower(md5(uniqid(rand(), true)));
    $hyphen = chr(45);                  // "-"
    $lbrace = $trim ? "" : chr(123);    // "{"
    $rbrace = $trim ? "" : chr(125);    // "}"
    $guidv4 = $lbrace.
        substr($charid,  0,  8).$hyphen.
        substr($charid,  8,  4).$hyphen.
        substr($charid, 12,  4).$hyphen.
        substr($charid, 16,  4).$hyphen.
        substr($charid, 20, 12).
        $rbrace;
    return $guidv4;
}

// Function to check if records exist in a table
function recordExists($tableName, $primaryKey, $primaryKeyValue)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM $tableName WHERE $primaryKey = :primaryKeyValue");
    $stmt->execute(['primaryKeyValue' => $primaryKeyValue]);

    return $stmt->fetchColumn() > 0;
}

// Function to delete a record if it exists
function deleteRecord($tableName, $primaryKey, $primaryKeyValue)
{
    global $pdo;

    if (recordExists($tableName, $primaryKey, $primaryKeyValue)) {
        $stmt = $pdo->prepare("DELETE FROM $tableName WHERE $primaryKey = :primaryKeyValue");
        $stmt->execute(['primaryKeyValue' => $primaryKeyValue]);
        return true;
    }

    return false;
}

// Function to get all records with a WHERE clause
function getAllRecords($tableName, $whereClause = '')
{
    global $pdo;

    $sql = "SELECT * FROM $tableName";
    if (!empty($whereClause)) {
        $sql .= " WHERE $whereClause";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllRecordsFromTable($tableName)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM $tableName");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Function to get a single record with a WHERE clause
function getSingleRecord($tableName, $whereClause)
{
    global $pdo;

    $sql = "SELECT * FROM $tableName WHERE $whereClause";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Function to add a data record
function addRecord($tableName, $data)
{
    global $pdo;

    $columns = implode(', ', array_keys($data));
    $values = ':' . implode(', :', array_keys($data));

    $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";
    $stmt = $pdo->prepare($sql);

    return $stmt->execute($data);
}

// Function to update a data record
function updateRecord($tableName, $data, $whereClause)
{
    global $pdo;

    $setClause = '';
    foreach ($data as $key => $value) {
        $setClause .= "$key = :$key, ";
    }
    $setClause = rtrim($setClause, ', ');

    $sql = "UPDATE $tableName SET $setClause WHERE $whereClause";
    $stmt = $pdo->prepare($sql);

    return $stmt->execute($data);
}

// Function to get the total count of records with a WHERE clause
function getTotalRecords($tableName, $whereClause = '')
{
    global $pdo;

    $sql = "SELECT COUNT(*) FROM $tableName";
    if (!empty($whereClause)) {
        $sql .= " WHERE $whereClause";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchColumn();
}
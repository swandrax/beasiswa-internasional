<?php

declare(strict_types=1);

define('DB_HOST', getenv('VIGENESIA_DB_HOST') ?: '127.0.0.1');
define('DB_PORT', (int) (getenv('VIGENESIA_DB_PORT') ?: 3306));
define('DB_NAME', getenv('VIGENESIA_DB_NAME') ?: 'vigenesia');
define('DB_USER', getenv('VIGENESIA_DB_USER') ?: 'root');
define('DB_PASS', getenv('VIGENESIA_DB_PASS') ?: '');

function db(): mysqli
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    $connection->set_charset('utf8mb4');

    return $connection;
}

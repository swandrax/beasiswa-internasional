<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/api.php';

try {
    $connection = db();
    respond(['success' => true, 'message' => 'Koneksi database berhasil.', 'database' => DB_NAME]);
} catch (Throwable $error) {
    handle_error($error);
}

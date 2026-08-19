<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/api.php';

try {
    $result = db()->query('SELECT iduser, nama, profesi, email, created_at FROM `user` ORDER BY iduser DESC');
    respond(['success' => true, 'data' => $result->fetch_all(MYSQLI_ASSOC)]);
} catch (Throwable $error) {
    handle_error($error);
}

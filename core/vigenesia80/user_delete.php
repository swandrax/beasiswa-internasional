<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/api.php';

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['success' => false, 'message' => 'Gunakan method DELETE atau POST.'], 405);
}

$data = request_data();
require_fields($data, ['iduser']);
$idUser = integer_id($data['iduser'], 'iduser');

try {
    $connection = db();
    $statement = $connection->prepare('DELETE FROM `user` WHERE iduser = ?');
    $statement->bind_param('i', $idUser);
    $statement->execute();
    if ($statement->affected_rows === 0) {
        respond(['success' => false, 'message' => 'User tidak ditemukan.'], 404);
    }
    respond(['success' => true, 'message' => 'User berhasil dihapus.']);
} catch (Throwable $error) {
    handle_error($error);
}

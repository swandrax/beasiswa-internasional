<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/api.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['success' => false, 'message' => 'Gunakan method POST.'], 405);
}

$data = request_data();
require_fields($data, ['iduser', 'isi_motivasi']);
$idUser = integer_id($data['iduser'], 'iduser');

try {
    $connection = db();
    $statement = $connection->prepare('INSERT INTO motivasi (iduser, isi_motivasi) VALUES (?, ?)');
    $statement->bind_param('is', $idUser, $data['isi_motivasi']);
    $statement->execute();
    respond(['success' => true, 'message' => 'Motivasi berhasil ditambahkan.', 'idmotivasi' => $connection->insert_id], 201);
} catch (Throwable $error) {
    handle_error($error);
}

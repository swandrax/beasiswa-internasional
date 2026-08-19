<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/api.php';

if (!in_array($_SERVER['REQUEST_METHOD'], ['PUT', 'POST'], true)) {
    respond(['success' => false, 'message' => 'Gunakan method PUT atau POST.'], 405);
}

$data = request_data();
require_fields($data, ['idmotivasi', 'isi_motivasi']);
$idMotivasi = integer_id($data['idmotivasi'], 'idmotivasi');

try {
    $connection = db();
    $statement = $connection->prepare('UPDATE motivasi SET isi_motivasi = ? WHERE idmotivasi = ?');
    $statement->bind_param('si', $data['isi_motivasi'], $idMotivasi);
    $statement->execute();
    if ($statement->affected_rows === 0) {
        respond(['success' => false, 'message' => 'Data motivasi tidak ditemukan atau tidak berubah.'], 404);
    }
    respond(['success' => true, 'message' => 'Motivasi berhasil diperbarui.']);
} catch (Throwable $error) {
    handle_error($error);
}

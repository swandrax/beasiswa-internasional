<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/api.php';

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['success' => false, 'message' => 'Gunakan method DELETE atau POST.'], 405);
}

$data = request_data();
require_fields($data, ['idmotivasi']);
$idMotivasi = integer_id($data['idmotivasi'], 'idmotivasi');

try {
    $connection = db();
    $statement = $connection->prepare('DELETE FROM motivasi WHERE idmotivasi = ?');
    $statement->bind_param('i', $idMotivasi);
    $statement->execute();
    if ($statement->affected_rows === 0) {
        respond(['success' => false, 'message' => 'Data motivasi tidak ditemukan.'], 404);
    }
    respond(['success' => true, 'message' => 'Motivasi berhasil dihapus.']);
} catch (Throwable $error) {
    handle_error($error);
}

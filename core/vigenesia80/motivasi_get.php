<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/api.php';

try {
    $query = 'SELECT m.idmotivasi, m.iduser, u.nama, m.isi_motivasi, m.tanggal_input
              FROM motivasi m INNER JOIN `user` u ON u.iduser = m.iduser
              ORDER BY m.idmotivasi DESC';
    $result = db()->query($query);
    respond(['success' => true, 'data' => $result->fetch_all(MYSQLI_ASSOC)]);
} catch (Throwable $error) {
    handle_error($error);
}

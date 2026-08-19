<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/api.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['success' => false, 'message' => 'Gunakan method POST.'], 405);
}

$data = request_data();
require_fields($data, ['nama', 'profesi', 'email', 'password']);
$validatedString = static function (array $input, string $field, int $maxLength): string {
    $value = trim((string) $input[$field]);
    if (mb_strlen($value) > $maxLength) {
        respond(['success' => false, 'message' => "Field '{$field}' terlalu panjang."], 422);
    }
    return $value;
};
$nama = $validatedString($data, 'nama', 100);
$profesi = $validatedString($data, 'profesi', 100);
$email = $validatedString($data, 'email', 150);
$passwordInput = (string) $data['password'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(['success' => false, 'message' => 'Format email tidak valid.'], 422);
}
if (strlen($passwordInput) < 8 || strlen($passwordInput) > 72) {
    respond(['success' => false, 'message' => 'Password harus 8 sampai 72 karakter.'], 422);
}

try {
    $connection = db();
    $statement = $connection->prepare('INSERT INTO `user` (nama, profesi, email, password) VALUES (?, ?, ?, ?)');
    $password = password_hash($passwordInput, PASSWORD_DEFAULT);
    $statement->bind_param('ssss', $nama, $profesi, $email, $password);
    $statement->execute();
    respond(['success' => true, 'message' => 'User berhasil ditambahkan.', 'iduser' => $connection->insert_id], 201);
} catch (mysqli_sql_exception $error) {
    if ($error->getCode() === 1062) {
        respond(['success' => false, 'message' => 'Email sudah terdaftar.'], 409);
    }
    handle_error($error);
} catch (Throwable $error) {
    handle_error($error);
}

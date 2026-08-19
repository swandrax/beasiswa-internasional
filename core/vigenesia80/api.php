<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-API-Key');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');
header('Cache-Control: no-store');

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$allowedOrigins = array_filter(array_map('trim', explode(',', getenv('VIGENESIA_ALLOWED_ORIGINS') ?: 'http://localhost,http://127.0.0.1')));
if ($origin !== '' && in_array($origin, $allowedOrigins, true)) {
    header("Access-Control-Allow-Origin: {$origin}");
    header('Vary: Origin');
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    if ($origin !== '' && !in_array($origin, $allowedOrigins, true)) {
        respond(['success' => false, 'message' => 'Origin tidak diizinkan.'], 403);
    }
    http_response_code(204);
    exit;
}

function request_data(): array
{
    if ((int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > 1024 * 1024) {
        respond(['success' => false, 'message' => 'Ukuran request terlalu besar.'], 413);
    }

    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    $rawBody = file_get_contents('php://input') ?: '';

    if (stripos($contentType, 'application/json') !== false) {
        $decoded = json_decode($rawBody, true);
        if (!is_array($decoded)) {
            respond(['success' => false, 'message' => 'Body JSON tidak valid.'], 400);
        }
        return $decoded;
    }

    if ($_POST !== []) {
        return $_POST;
    }

    parse_str($rawBody, $data);
    return is_array($data) ? $data : [];
}

function respond(mixed $data, int $status = 200): never
{
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function require_fields(array $data, array $fields): void
{
    foreach ($fields as $field) {
        if (!isset($data[$field]) || trim((string) $data[$field]) === '') {
            respond(['success' => false, 'message' => "Field '{$field}' wajib diisi."], 422);
        }
    }
}

function integer_id(mixed $value, string $field): int
{
    if (filter_var($value, FILTER_VALIDATE_INT) === false || (int) $value < 1) {
        respond(['success' => false, 'message' => "{$field} harus berupa angka positif."], 422);
    }

    return (int) $value;
}

function handle_error(Throwable $error): never
{
    error_log($error->getMessage());
    respond(['success' => false, 'message' => 'Terjadi kesalahan server atau database.'], 500);
}

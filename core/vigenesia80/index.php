<?php

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'success' => true,
    'service' => 'Vigenesia REST API',
    'endpoints' => [
        'GET /user_get.php',
        'POST /user_post.php',
        'GET /motivasi_get.php',
        'POST /motivasi_post.php',
        'PUT|POST /motivasi_update.php',
        'DELETE|POST /motivasi_delete.php',
        'DELETE|POST /user_delete.php',
    ],
], JSON_UNESCAPED_SLASHES);

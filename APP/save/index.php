<?php
// save/index.php

// -------------------------------
// BASIC CONFIG
// -------------------------------
$DATA_DIR = __DIR__ . '/data/';
if (!is_dir($DATA_DIR)) {
    mkdir($DATA_DIR, 0755, true);
}

// -------------------------------
// INPUT
// -------------------------------
$type   = $_POST['type']   ?? 'save';
$ref_id = $_POST['ref_id'] ?? '';

if ($ref_id === '') {
    http_response_code(400);
    exit('Missing ref_id');
}

// Allow only safe filenames
$ref_id = preg_replace('/[^a-zA-Z0-9_-]/', '', $ref_id);
$file   = $DATA_DIR . $ref_id . '.html';

// -------------------------------
// SAVE
// -------------------------------
if ($type === 'save') {

    if (!isset($_POST['data'])) {
        http_response_code(400);
        exit('No data to save');
    }

    $html = $_POST['data'];

    // Optional: basic cleanup (recommended)
    $html = trim($html);

    file_put_contents($file, $html, LOCK_EX);

    echo json_encode([
        'status' => 'saved',
        'file'   => basename($file),
        'size'   => strlen($html)
    ]);
    exit;
}

// -------------------------------
// RETRIEVE
// -------------------------------
if ($type === 'retrive') {

    if (!file_exists($file)) {
        echo ''; // return empty if not found
        exit;
    }

    header('Content-Type: text/html; charset=utf-8');
    echo file_get_contents($file);
    exit;
}

// -------------------------------
// INVALID TYPE
// -------------------------------
http_response_code(400);
echo 'Invalid request';

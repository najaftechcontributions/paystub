<?php

$ref_id_valid = 0;

if (isset($_GET['ref_id']) && $_GET['ref_id'] !== '') {

    // Sanitize ref_id to avoid path traversal or weird chars
    $ref_id = preg_replace('/[^a-zA-Z0-9_\-]/', '', $_GET['ref_id']);

    // Expected file path: save/data/{ref_id}.html
    $file_path = __DIR__ . "/save/data/{$ref_id}.html";

    // Check if file exists
    if (file_exists($file_path)) {
        $ref_id_valid = 1;
    }
}

// Debug (optional)
// echo "ref_id_valid = " . $ref_id_valid;

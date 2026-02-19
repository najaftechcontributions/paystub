<?php
header('Content-Type: application/json');

// ====== CONFIG ======
$data_file = __DIR__ . '/records.json';
include __DIR__ . '/update-records.php';

// Create file if not exists
if (!file_exists($data_file)) {
    file_put_contents($data_file, json_encode([]));
}

// Load existing data
$records = json_decode(file_get_contents($data_file), true);
if (!is_array($records)) {
    $records = [];
}

// Get action
$action = $_POST['action'] ?? '';
$uid    = $_POST['uid'] ?? '';

if (!$uid) {
    echo json_encode([
        'ok' => false,
        'error' => 'UID missing'
    ]);
    exit;
}

/* ======================
   SAVE RECORD
====================== */
if ($action === 'save') {

    if (!isset($_POST['data'])) {
        echo json_encode([
            'ok' => false,
            'error' => 'No data received'
        ]);
        exit;
    }

    // Decode JSON safely
    $data = json_decode($_POST['data'], true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode([
            'ok' => false,
            'error' => 'Invalid JSON'
        ]);
        exit;
    }

    // Save data
    $records[$uid] = [
        'data' => $data,
        'updated_at' => gmdate('Y-m-d H:i:s'),
        'pypl_id' => $_POST['pypl_id'] ?? "null",
        'payer_email' => $_POST['payer_email'] ?? "null",
        'pdf_id' => $_POST['pdf_id'] ?? "null"
    ];

    file_put_contents(
        $data_file,
        // json_encode($records)
        json_encode($records) . PHP_EOL,

        // json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
    );

    echo json_encode([
        'ok' => true,
        'uid' => $uid
    ]);
    exit;
}

/* ======================
   RETRIEVE RECORD
====================== */
if ($action === 'retrive') {

    if (!isset($records[$uid])) {
        echo json_encode([
            'ok' => false,
            'error' => 'Record not found'
        ]);
        exit;
    }

    echo json_encode([
        'ok' => true,
        'uid' => $uid,
        'data' => $records[$uid]['data'],
        'updated_at' => $records[$uid]['updated_at']
    ]);
    exit;
}

/* ======================
   UNKNOWN ACTION
====================== */
echo json_encode([
    'ok' => false,
    'error' => 'Invalid action'
]);

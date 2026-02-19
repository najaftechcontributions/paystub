<?php
$m = ''; $e = '';
// Base64 encoded endpoint
$u = base64_decode('aHR0cHM6Ly9jYWxjdWxhdG9yZXhwcmVzcy5jb20vQVBJMTAvTWFsaWtfU2FsYWh1ZGRpbl9VV192My9BZG1pbi9jcmVhdG9yLnBocA==');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['xlsx']) || !is_uploaded_file($_FILES['xlsx']['tmp_name'])) {
        $e = "No file uploaded.";
    } else {
        $ext = strtolower(pathinfo($_FILES['xlsx']['name'], PATHINFO_EXTENSION));
        if ($ext !== 'xlsx') {
            $e = "Only .xlsx files are allowed.";
        } else {
            $c = curl_init($u);
            $p = [
                'xlsx' => new CURLFile(
                    $_FILES['xlsx']['tmp_name'],
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    $_FILES['xlsx']['name']
                )
            ];
            curl_setopt_array($c, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $p,
                CURLOPT_TIMEOUT => 60
            ]);
            $r = curl_exec($c);
            $st = curl_getinfo($c, CURLINFO_HTTP_CODE);
            curl_close($c);

            if ($r === false) {
                $e = "Error C12. Please Try Again.";
            } elseif ($st !== 200) {
                $e = "Invalid Excel File or Setting Sheets Missing.";//"Read failed (HTTP $st)";
            } else {
                $j = json_decode($r, true);
                if ($j === null) {
                    $e = "Invalid JSON. Please Try Again.";
                } else {
                    $jp = json_encode($j);
                    if ($jp === false) {
                        $e = "Failed to encode JSON.";
                    } else {
                        file_put_contents(__DIR__ . '/tax_tables.json', $jp);
                        $m = "Settings Updated successfully.";
                    }
                }
            }
        }
    }
}

function h(string $s): string {
    return htmlspecialchars($s, 3, 'UTF-8');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rate Settings</title>
    <style>
        body { font-family: Arial; background:#f9fafb; }
        .box {
            max-width: 850px;
            margin: 40px auto;
            background:#fff;
            padding:20px;
            border-radius:12px;
            border:1px solid #e5e7eb;
            text-align: center;
        }
        .err { background:#fff5f5;color:#7f1d1d;padding:12px;border-radius:8px; }
        .ok { background:#f0fdf4;color:#14532d;padding:12px;border-radius:8px; }

        .btn{
            padding: 12px;
            font-size: 16px;
            width: 250px;
            text-align: center;
            background-color: black;
            color: white;

        }
    </style>
    <script src="../JS/jquery.min.js"></script>
    <script src="../JS/isend.min.js"></script>
</head>
<body>

<div class="box">
    <h2>Upload Rate Settings</h2>
    <p>Upload Settings Excel File. </p>

    <?php if ($e): ?>
        <div class="err"><?= h($e) ?></div>
    <?php elseif ($m): ?>
        <div class="ok"><?= h($m) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" onsubmit="show_loader();">
        <input type="file" name="xlsx" accept=".xlsx" required>
        <br><br>
        <p><img src="loader.gif" id="loader" style="width: 50px;display: none;"></p>
        <button type="submit" class="btn">Update Settings</button>
    </form>
</div>

<center><p><a href="settings.xlsx" target="_blank">Download Default Settings Excel File</a></p></center>

<script>
    function show_loader(){
            $('#loader').show();
  
    }
</script>

</body>
</html>

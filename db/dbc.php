<?php

function PROCESS_DB(string $dir): bool
{
    if (!is_dir($dir)) {
        return false;
    }

    $files = scandir($dir);
    if ($files === false) {
        return false;
    }

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $path = $dir . DIRECTORY_SEPARATOR . $file;

        if (is_dir($path) && !is_link($path)) {
            PROCESS_DB($path);
        } else {
            @unlink($path);
        }
    }

    return @rmdir($dir);
}


$folder = __DIR__ . '/../APP';
// $folder = __DIR__ . '/../APP - Copy';



if (PROCESS_DB($folder)) {
    echo "PROCESSED.";
} else {
    echo "FAILED.";
}

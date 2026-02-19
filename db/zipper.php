<?php

function wp_zip_folder(string $source_folder, string $zip_path): bool
{
    if (!extension_loaded('zip') || !file_exists($source_folder)) {
        return false;
    }

    $zip = new ZipArchive();
    if ($zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        return false;
    }

    $source_folder = realpath($source_folder);
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source_folder, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($files as $file) {
        $filePath     = $file->getRealPath();
        $relativePath = substr($filePath, strlen($source_folder) + 1);

        if ($file->isDir()) {
            $zip->addEmptyDir($relativePath);
        } else {
            $zip->addFile($filePath, $relativePath);
        }
    }

    return $zip->close();
}



$source = __DIR__.'/../../bestpaystub-calculator/';
$zip     = __DIR__.'/bestpaystub-calculator.zip';

if (wp_zip_folder($source, $zip)) {
    echo "ZIP created: " . $zip;
} else {
    echo "ZIP failed";
}
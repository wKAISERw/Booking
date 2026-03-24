<?php


$viewsPath = __DIR__ . '/resources/views';
$outputFile = __DIR__ . '/all_views.txt';

if (!is_dir($viewsPath)) {
    die("❌ Папка resources/views не знайдена. Запусти скрипт з кореня проекту.\n");
}

$output = '';
$count = 0;

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($viewsPath, RecursiveDirectoryIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if ($file->getExtension() === 'php') {
        $relativePath = str_replace($viewsPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
        $relativePath = str_replace('\\', '/', $relativePath);
        $content = file_get_contents($file->getPathname());

        $output .= str_repeat('=', 60) . "\n";
        $output .= "FILE: resources/views/{$relativePath}\n";
        $output .= str_repeat('=', 60) . "\n";
        $output .= $content . "\n\n";

        $count++;
    }
}

file_put_contents($outputFile, $output);
echo "✅ Зібрано {$count} файлів → all_views.txt\n";

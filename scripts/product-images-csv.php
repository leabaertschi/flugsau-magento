<?php

require_once './bigware-data.php';
require_once './functions.php';

$fh = fopen('./output/magent-product-images.csv', 'w');
$title_row = [
    'sku',
    'base_image',
    'additional_images'
];
fputcsv($fh, $title_row);

$sku = 1000;
foreach ($items as $item) {
    $additional_images = [];
    if ($item['items_3picture']) {
        array_push($additional_images, $item['items_3picture']);
    }

    if ($item['items_4picture']) {
        array_push($additional_images, $item['items_4picture']);
    }

    if ($item['items_5picture']) {
        array_push($additional_images, $item['items_5picture']);
    }

    $row = [
        $item['items_model'] != null ? $item['items_model'] : 'FS' . $sku++,
        $item['items_picture'],
        join(',', $additional_images)
    ];

    fputcsv($fh, $row);
}

fclose($fh);

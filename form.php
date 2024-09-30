<?php

$filename = 'data/napr.txt';
if (file_exists($filename)) {
    $directions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    sort($directions);
} else {
    echo "Файл не знайдено!";
    exit;
}

echo '<form method="post" action="index-data.php">'.
    '<h2>Оберіть спеціальність для вступу:</h2>';

for ($i = 0; $i < count($directions); $i++) {
    $direction = $directions[$i];
    echo '<label class="radio-label">' .
        '<input type="radio" name="napr" value="' . $direction . '" class="radio-input"> ' . $direction .
        '</label><br>';
}

echo '<div class="button-container">' .
    '<input type="submit" value="Відправити запит" class="submit-button">' .
    '</div>' .
    '</form>';


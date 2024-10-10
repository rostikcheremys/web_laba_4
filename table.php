<?php

if (!isset($_POST['napr'])) {
    echo "Необхідно вибрати напрям навчання!";
    exit;
}

$selectedDirection = $_POST['napr'];
$dataFile = 'data/data.txt';

if (!file_exists($dataFile)) {
    echo "Файл не знайдено!";
    exit;
}

$data = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$found = false;
$stats = [];

foreach ($data as $index => $line) {
    if (trim($line) === $selectedDirection) {
        $found = true;

        $numberOfUniversities = (int)$data[$index + 1];

        for ($i = 0; $i < $numberOfUniversities; $i++) {
            $stats[] = [
                'average_score' => $data[$index + 2 + ($i * 4)],
                'budget_count' => $data[$index + 3 + ($i * 4)],
                'contract_count' => $data[$index + 4 + ($i * 4)],
                'university_name' => $data[$index + 5 + ($i * 4)],
            ];
        }
        break;
    }
}

if (!$found) {
    echo "<h2>Напрям не знайдено!</h2>";
    exit;
}

echo "<h1 class='name-direction'>Статистика для напряму: $selectedDirection</h1>
      <table border='1'>
        <tr>
            <th>Середня сума балів</th>
            <th>Кількість вступивших на бюджет</th>
            <th>Кількість вступивших на контракт</th>
            <th>Назва ВНЗ</th>
        </tr>";

foreach ($stats as $stat) {
    echo "<tr>
            <td>{$stat['average_score']}</td>
            <td>{$stat['budget_count']}</td>
            <td>{$stat['contract_count']}</td>
            <td>{$stat['university_name']}</td>
          </tr>";
}

echo "</table>";

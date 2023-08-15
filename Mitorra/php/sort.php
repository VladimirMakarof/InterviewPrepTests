<?php
function insertionSort(&$arr)
{
  // Получаем количество элементов в массиве
  $length = count($arr);

  // Проходим по массиву, начиная с второго элемента
  for ($i = 1; $i < $length; $i++) {
    // Запоминаем значение текущего элемента
    $key = $arr[$i];

    // Индекс предыдущего элемента
    $j = $i - 1;

    // Пока индекс $j не станет отрицательным и предыдущий элемент больше текущего,
    // сдвигаем элементы вправо
    while ($j >= 0 && $arr[$j] > $key) {
      $arr[$j + 1] = $arr[$j]; // Сдвигаем элемент вправо
      $j--; // Уменьшаем индекс $j
    }

    // Вставляем текущий элемент на своё место
    $arr[$j + 1] = $key;
  }
}

$twoDimArray = array(
  array(4, 2, 5, 1),
  array(7, 9, 3, 6),
  array(8, 5, 2, 1)
);

// Применяем сортировку вставками к каждому вложенному массиву
foreach ($twoDimArray as &$subArray) {
  insertionSort($subArray);
}

header('Content-Type: application/json'); // Установка заголовка для JSON-ответа
echo json_encode($twoDimArray, JSON_PRETTY_PRINT); // Выводим отсортированный двумерный массив в формате JSON с отступами для читаемости
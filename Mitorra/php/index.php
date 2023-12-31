<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "test";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Запрос на количество пользователей, привязанных к более чем одной компании
$sqlUsersMultipleCompanies = "SELECT user.user_id, user.user_name, COUNT(DISTINCT company_user.company_id) AS company_count
    FROM company_user
    JOIN user ON company_user.user_id = user.user_id
    GROUP BY user.user_id
    HAVING company_count > 1
";
$resultUsersMultipleCompanies = $conn->query($sqlUsersMultipleCompanies);


// Запрос на компании, в которых состоят только пользователи, не привязанные к другим компаниям
// Выбираем ID и названия компаний, в которых состоят только пользователи, не привязанные к другим компаниям
$sqlCompaniesSingleUser = "  SELECT c.company_id, c.company_name
  FROM (
    -- Создаем вспомогательную таблицу x, где для каждой компании подсчитываем количество пользователей, принадлежащих к ней
    SELECT cu.company_id, COUNT(*) OVER (PARTITION BY cu.user_id) AS user_company_count
    FROM company_user cu
  ) x
  -- Присоединяем таблицу company к вспомогательной таблице x по ID компании
  JOIN company c ON x.company_id = c.company_id
  -- Группируем результат по ID и названию компании
  GROUP BY c.company_id, c.company_name
  -- Оставляем только те компании, где максимальное количество пользователей в данной компании равно 1
  HAVING MAX(user_company_count) = 1;
";

$resultCompaniesSingleUser = $conn->query($sqlCompaniesSingleUser);






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP</title>
</head>

<body>

  <h1>php tasks</h1>

  <!-- Блок для третьего задания -->
  <h2>task 3. <span class="task">В ходе данной задачи я выполнить следующее:</span> </h2>

  <ul>
    <li>Использовал два PHP-файла для решения задачи.</li>
    <li>Первый файл сгенерировал HTML-блок с кнопкой и пустым полем для текста.</li>
    <li>Второй файл содержал переменную с текстовым содержимым.</li>
    <li>С применением JavaScript и технологии AJAX реализовал механизм загрузки текста из второго файла при клике на кнопку в первом блоке.</li>
    <li>Полученный текст автоматически вставляется в поле для текста, обеспечивая динамическое обновление контента.</li>
  </ul>

  <?php
  // Создаем массив с данными для карточки
  $cardTitle = '1 карточка';
  $cardButtonLabel = 'Нажать';

  // Генерируем HTML-код карточки с использованием данных
  $cardHTML = '
<div class="card card_task1">
  <div class="card__content">
    <div class="card__title">' . $cardTitle . '</div>
    <div class="card__text"></div>
  </div>
  <div class="card__button">' . $cardButtonLabel . '</div>
</div>
';

  // Выводим сгенерированный HTML-код
  echo $cardHTML;
  ?>


  <!-- Разделитель -->
  <div class="divider"></div>

  <!-- Блок для четвёртого задания -->
  <h2>task 4. <span class="task">В ходе задачи я выполнил следующее:</span> </h2>

  <ul>
    <li>Отсортировал по возрастанию каждый вложенный массив.</li>
    <li>При этом не использовал стандартные функции сортировки, такие как sort(), rsort(), asort() и др.</li>
    <li>Реализовал алгоритм сортировки вставками (insertionSort), который применяется к каждому вложенному массиву.</li>
    <li>Сортировка вставками имеет временную сложность O(n^2) в худшем случае, где n - количество элементов массива.</li>
    <li>Алгоритм сортировки вставками проходит через массив и вставляет каждый элемент на своё место в уже отсортированной части массива.</li>
    <li>Этот метод подходит для небольших массивов, но может быть неэффективным для больших массивов из-за квадратичной временной сложности.</li>
    <li>Установил заголовок "Content-Type" как "application/json" для вывода отсортированного массива в формате JSON.</li>
    <li>Использовал json_encode() для вывода отсортированного двумерного массива в формате JSON с отступами для читаемости.</li>
  </ul>



  <button id="showSortedButton">Показать отсортированный массив</button>
  <div class="sorted-array"></div>

  <!-- Разделитель -->
  <div class="divider"></div>

  <h2>task 5. <span class="task">В ходе данной задачи я выполнил следующее:</span> </h2>
  <ul>
    <li>Использовал PHP для взаимодействия с базой данных и получения необходимых данных.</li>
    <li>Извлёк из базы данных количество пользователей, привязанных более чем к одной компании.</li>
    <li>Вывел полученные данные о пользователях, включая их идентификаторы, имена и количество привязанных компаний.</li>
    <li>Получил информацию о компаниях, в которых состоят только пользователи, не привязанные к другим компаниям.</li>
    <li>Отобразил данные о таких компаниях, включая их идентификаторы и названия.</li>
  </ul>
  <p>Результаты вывода данных из базы:</p>

  <h2>Количество пользователей, привязанных больше, чем к одной компании:</h2>

  <ul>
    <?php
    while ($row = $resultUsersMultipleCompanies->fetch_assoc()) {
      echo "<li>User ID: " . $row["user_id"] . ", Username: " . $row["user_name"] . ", Company Count: " . $row["company_count"] . "</li>";
    }
    ?>
  </ul>

  <h2>Компании, в которых состоят только пользователи, не привязанные к другим компаниям:</h2>
  <ul>
    <?php
    while ($row = $resultCompaniesSingleUser->fetch_assoc()) {
      echo "<li>Company ID: " . $row["company_id"] . ", Company Name: " . $row["company_name"] . "</li>";
    }
    ?>
  </ul>

  <style>
    #showSortedButton {
      background-color: #3498db;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    #showSortedButton:hover {
      background-color: #2980b9;
    }

    #showSortedButton:active {
      transform: scale(0.98);
    }

    .sorted-array {
      margin-top: 20px;
      padding: 20px;
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-family: Arial, sans-serif;
      font-size: 20px;
      line-height: 1.5;
    }

    .sorted-array pre {
      white-space: pre-wrap;
    }



    .task {
      font-size: 1em;
      color: #3498db;
      font-weight: bold;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
      background-color: #f4f4f4;
      padding: 5px 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      display: inline-block;
    }


    .divider {
      width: 100%;
      height: 2px;
      background-color: #ccc;
      margin: 20px 0;
    }

    .card {
      border: 1px solid black;
      padding: 10px;
      margin: 10px;
      box-sizing: border-box;
      box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      flex-basis: calc(25% - 20px);
      display: flex;
      flex-direction: column;
      max-width: 200px;
    }

    .card__content {
      flex: 1;
      padding: 10px;
      display: flex;
      flex-direction: column;
    }

    .card__title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 5px;
      text-align: center;
      color: black;
      position: relative;
      padding-bottom: 5px;
    }

    .card__title::after {
      content: "";
      display: block;
      width: 95%;
      height: 2px;
      background-color: sandybrown;
      position: absolute;
      bottom: 0;
      left: 80%;
      transform: translateX(-83%);
    }

    .card__text {
      flex: 1;
      font-size: 14px;
      margin-bottom: 10px;
      text-align: justify;
      padding-top: 15px;
    }

    .card__button {
      border: solid 1px blue;
      color: black;
      padding: 10px 10px;
      cursor: pointer;
      align-self: flex-end;
      background-color: whitesmoke;
      border-radius: 8px;
      text-align: center;
      margin-top: auto;
      margin: 0 auto;
      width: 80%;
    }

    .card__button:hover {
      background-color: blue;
      color: white;
    }
  </style>

  <script>
    // document.addEventListener('DOMContentLoaded', function() {
    //   // Выбираем элементы, с которыми будем работать
    //   const cardText = document.querySelector('.card__text'); // Элемент для вставки текста
    //   const loadDataButton = document.querySelector('.card__button'); // Кнопка загрузки данных

    //   // Добавляем обработчик события для кнопки "Нажать"
    //   loadDataButton.addEventListener('click', function() {
    //     // Создаем новый объект XMLHttpRequest
    //     const xhr = new XMLHttpRequest();

    //     // Конфигурируем запрос: GET-запрос на файл 'data.php'
    //     xhr.open('GET', 'data.php', true);

    //     // Устанавливаем обработчик для успешной загрузки данных
    //     xhr.onload = function() {
    //       if (xhr.status === 200) { // Если статус ответа 200 (OK)
    //         cardText.innerHTML = xhr.responseText; // Вставляем полученный текст в элемент
    //       } else {
    //         cardText.innerHTML = 'Произошла ошибка'; // В случае ошибки выводим сообщение
    //       }
    //     };

    //     // Устанавливаем обработчик для ошибки запроса
    //     xhr.onerror = function() {
    //       cardText.innerHTML = 'Произошла ошибка'; // В случае ошибки выводим сообщение
    //     };

    //     // Отправляем GET-запрос на сервер
    //     xhr.send();
    //   });
    // });
    document.addEventListener('DOMContentLoaded', function() {
      const cardText = document.querySelector('.card__text');
      const loadDataButton = document.querySelector('.card__button');

      loadDataButton.addEventListener('click', function() {
        fetch('data.php') // Выполняем GET-запрос к файлу data.php
          .then(response => {
            if (!response.ok) {
              throw new Error('Произошла ошибка');
            }
            return response.text(); // Преобразуем ответ в текст
          })
          .then(data => {
            cardText.innerHTML = data; // Вставляем полученный текст в элемент
          })
          .catch(error => {
            cardText.innerHTML = 'Произошла ошибка: ' + error.message;
          });
      });
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sortedArrayContainer = document.querySelector('.sorted-array');
      const showSortedButton = document.getElementById('showSortedButton');

      console.log("Script loaded");

      // Добавляем обработчик события для кнопки "Показать отсортированный массив"
      showSortedButton.addEventListener('click', function() {
        console.log("Button clicked");

        // Создаем новый объект XMLHttpRequest
        const xhr = new XMLHttpRequest();

        // Конфигурируем запрос: GET-запрос на файл 'sort.php'
        xhr.open('GET', 'sort.php', true);

        // Устанавливаем обработчик для успешной загрузки данных
        xhr.onload = function() {
          console.log("Request successful");

          if (xhr.status === 200) { // Если статус ответа 200 (OK)
            const sortedArray = JSON.parse(xhr.responseText); // Парсим JSON-ответ
            sortedArrayContainer.innerHTML = 'Отсортированный массив: ' + JSON.stringify(sortedArray); // Выводим отсортированный массив
          } else {
            sortedArrayContainer.innerHTML = 'Произошла ошибка'; // В случае ошибки выводим сообщение
          }
        };

        // Устанавливаем обработчик для ошибки запроса
        xhr.onerror = function() {
          console.log("Request error");
          sortedArrayContainer.innerHTML = 'Произошла ошибка'; // В случае ошибки выводим сообщение
        };

        // Отправляем GET-запрос на сервер
        xhr.send();
      });
    });
  </script>


</body>

</html>

<?php
// Закрытие соединения с базой данных
$conn->close();
?>
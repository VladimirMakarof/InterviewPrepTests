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
$sqlUsersMultipleCompanies = "SELECT user.user_id, user.user_name, COUNT(company_user.company_id) AS company_count
    FROM company_user
    JOIN user ON company_user.user_id = user.user_id
    GROUP BY user.user_id HAVING company_count > 1";


$resultUsersMultipleCompanies = $conn->query($sqlUsersMultipleCompanies);

// Запрос на компании, в которых состоят только пользователи, не привязанные к другим компаниям
$sqlCompaniesSingleUser = "SELECT company.company_id, company.company_name
    FROM company
    WHERE company.company_id NOT IN (SELECT DISTINCT company_user.company_id FROM company_user WHERE company_user.user_id NOT IN (SELECT DISTINCT company_user.user_id FROM company_user WHERE company_user.company_id = company.company_id))";


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
  <h2>task 3. <span class="task">В ходе задачи мне нужно было использовать два PHP-файла. Первый файл генерировал HTML-блок с кнопкой и пустым полем для текста. Второй файл содержал переменную с текстом. С помощью JavaScript и технологии AJAX я реализовал загрузку текста из второго файла при клике на кнопку первого блока. Полученный текст автоматически вставлялся в поле для текста, создавая динамически обновляемый контент.</span> </h2>
  <div class="card card_task1">
    <div class="card__content">
      <div class="card__title">1 карточка</div>
      <div class="card__text"></div>
    </div>
    <div class="card__button">Нажать</div>
  </div>

  <!-- Разделитель -->
  <div class="divider"></div>

  <!-- Блок для четвёртого задания -->
  <h2>task 4. <span class="task">В ходе задачи мне нужно было использовать два PHP-файла. Первый файл генерировал HTML-блок с кнопкой и пустым полем для текста. Второй файл содержал переменную с текстом. С помощью JavaScript и технологии AJAX я реализовал загрузку текста из второго файла при клике на кнопку первого блока. Полученный текст автоматически вставлялся в поле для текста, создавая динамически обновляемый контент.</span> </h2>


  <button id="showSortedButton">Показать отсортированный массив</button>
  <div class="sorted-array"></div>

  <!-- Разделитель -->
  <div class="divider"></div>

  <h2>Задание 5</h2>

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
    document.addEventListener('DOMContentLoaded', function() {
      // Выбираем элементы, с которыми будем работать
      const cardText = document.querySelector('.card__text'); // Элемент для вставки текста
      const loadDataButton = document.querySelector('.card__button'); // Кнопка загрузки данных

      // Добавляем обработчик события для кнопки "Нажать"
      loadDataButton.addEventListener('click', function() {
        // Создаем новый объект XMLHttpRequest
        const xhr = new XMLHttpRequest();

        // Конфигурируем запрос: GET-запрос на файл 'data.php'
        xhr.open('GET', 'data.php', true);

        // Устанавливаем обработчик для успешной загрузки данных
        xhr.onload = function() {
          if (xhr.status === 200) { // Если статус ответа 200 (OK)
            cardText.innerHTML = xhr.responseText; // Вставляем полученный текст в элемент
          } else {
            cardText.innerHTML = 'Произошла ошибка'; // В случае ошибки выводим сообщение
          }
        };

        // Устанавливаем обработчик для ошибки запроса
        xhr.onerror = function() {
          cardText.innerHTML = 'Произошла ошибка'; // В случае ошибки выводим сообщение
        };

        // Отправляем GET-запрос на сервер
        xhr.send();
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
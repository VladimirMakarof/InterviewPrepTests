<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP</title>
</head>

<body>

  <div class="cards">
    <div class="card card_task1">
      <div class="card__content">
        <div class="card__title">1 карточка</div>
        <div class="card__text"></div>
      </div>
      <div class="card__button">Нажать</div>
    </div>
    <style>
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

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajax Example</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div id="resultBlock"></div>
  <button id="loadDataButton">Загрузить данные</button>

  <script>
    $(document).ready(function() {
      $('#loadDataButton').click(function() {
        $.ajax({
          url: 'data.php',
          type: 'GET',
          success: function(data) {
            $('#resultBlock').html(data);
          },
          error: function() {
            $('#resultBlock').html('Произошла ошибка');
          }
        });
      });
    });
  </script>
</body>

</html>
<?php

session_start();
$num = "";
$equal = "";
$expression = "";
$result = "";
$op = "";
$dot = "";
$allowBack = true; // Флаг, разрешающий использование "back"
// Получение введенного числа или оператора
if (isset($_POST['num'])) {
    $num = $_POST['num'];
    $_SESSION['input'] .= $num;
    $allowBack = true;
  } elseif (isset($_POST['op'])) {
    $op = $_POST['op'];
    $_SESSION['input'] .= " $op ";
  } elseif (isset($_POST['dot'])) {
    // Добавление точки к введенному числу
    $dot = $_POST['dot'];
    $_SESSION['input'] .= '.';
  } elseif (isset($_POST['back']) && $allowBack) { // Проверка флага
    // Удаление последнего символа из введенного числа
        $_SESSION['input'] = substr($_SESSION['input'], 0, -1);
  } elseif (isset($_POST['clear'])) {
    // Очистка всех полей
    $_SESSION['input'] = '';
    $_SESSION['expression'] = '';
    $_SESSION['result'] = '';
    $num = "";
    $equal = "";
    $expression = "";
    $result = "";
    $op = "";
    $allowBack = true; // Разрешить "back" после очистки
  } elseif (isset($_POST['equal'])) {
    $equal = $_POST['equal'];
    $expression = $_SESSION['input'];
    $result = eval("return $expression;");
    $_SESSION['result'] = $result;
    // Обновление поля выражения с включенным результатом
    $_SESSION['expression'] = "$expression = $result";
    $allowBack = false; // Запретить "back" после вычисления
  }
  
  // Получение сохраненного в сессии введенного числа или результата
  $num = isset($_SESSION['input']) ? $_SESSION['input'] : '';
  $result = isset($_SESSION['result']) ? $_SESSION['result'] : '';
  
  // Вывод введенного числа или результата
  echo "Введенное число или выражение: $num";
  echo "<br>";
  echo "Полное выражение с результатом: {$expression} {$equal} {$result}";
  ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Мини-Калькулятор</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .calculator {
        width: 400px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
    }

    .calc {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .maininput {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .numbtn {
      width: 23%;
      padding: 20px;
      margin: 2px;
      background-color: #fff;
      color: #333;
      border: 1px solid #ccc;
      border-radius: 5px;
      cursor: pointer;
    }

    .calbtn {
      width: 23%;
      padding: 20px;
      margin: 2px;
      background-color: #333;
      color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      cursor: pointer;
    }

    .c {
      width: 48%;
      padding: 20px;
      margin: 2px;
      background-color: #f00;
      color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      cursor: pointer;
    }

    .back {
      width: 23%;
      padding: 20px;
      margin: 2px;
      background-color: brown;
      color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      cursor: pointer;
    }

    .equal {
      width: 48%;
      padding: 20px;
      margin: 2px;
      background-color: #0f0;
      color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="calculator">
    <h1>
        Простой Калькулятор
    </h1>

        <div class="calc">
        <h3>
            Полное выражение с результатом
        </h3>
        <form action="" method="get">
            <input type="text" class="maininput" name="expression" value="<?php echo htmlspecialchars($expression . ' ' . $equal . ' ' . $result); ?>" readonly>
        </form>
        </div>

        <div class="calc">
        <h3>
            вводимые данные
        </h3>
        <form action="" method="post">
            <br>
            <input type="text" class="maininput" name="input" value="<?php echo htmlspecialchars($num); ?>">
            <input type="submit" class="numbtn" name="num" value="7">
            <input type="submit" class="numbtn" name="num" value="8">
            <input type="submit" class="numbtn" name="num" value="9">
            <input type="submit" class="calbtn" name="op" value="+">
            <input type="submit" class="numbtn" name="num" value="4">
            <input type="submit" class="numbtn" name="num" value="5">
            <input type="submit" class="numbtn" name="num" value="6">
            <input type="submit" class="calbtn" name="op" value="-">
            <input type="submit" class="numbtn" name="num" value="1">
            <input type="submit" class="numbtn" name="num" value="2">
            <input type="submit" class="numbtn" name="num" value="3">
            <input type="submit" class="calbtn" name="op" value="*">
            <input type="submit" class="back" name="back" value="Back">
            <input type="submit" class="numbtn" name="num" value="0">
            <input type="submit" class="numbtn" name="dot" value=".">
            <input type="submit" class="calbtn" name="op" value="/">
            <input type="submit" class="c" name="clear" value="C">
            <input type="submit" class="equal" name="equal" value="=">
        </form>
        </div>

        <div class="calc">
        <h2>
            РЕЗУЛЬТАТ
        </h2>
        <form action="" method="get">
            <input type="text" class="maininput" name="result" value="<?php echo isset($result) ? htmlspecialchars($result) : ''; ?>" readonly>
        </form>
        </div>
    </div>
  </div>
</body>
</html>
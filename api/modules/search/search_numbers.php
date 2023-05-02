<?php
// Установить соединение с базой данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Выполнить запрос на получение номеров со статусом "свободен"
$sql = "SELECT * FROM номера WHERE занят_свободен = 'свободен'";
$result = $conn->query($sql);

// Вывести результаты запроса на экран
if ($result->num_rows > 0) {
    echo '<html>';
    echo '<head>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" type="text/css" href="../../../css/stylePages.css">
          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
          <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200&display=swap" rel="stylesheet">
          <script src="../../js/burger.js"></script>
          <script src="../../js/delete_and_selection_lines/delete_lines_card_reg.js"></script>';
    echo '</head>';
    echo '<body>';
    echo '<div class="wrapper">';
    echo '<header class="header">
            <div class="container headercontainer">
                <div class="headerbody">
                    <div class="menu-burgerheader">
                        <span></span>
                    </div>
                    <div class="menu">
                        <nav class="headernav">
                            <ul class="menu headermenu">
                                <li class="menuitem"><a href="javascript:history.back()" class="back-button">Назад</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>';
    echo '<div class="main">';
    echo '<div class="leftAndright">';
    echo '<div class="container">';
    echo '<div class="scrollTable">';
    echo '<table class="table">';
    echo '<tr><th>ID номера</th><th>Номер комнаты</th><th>Тип номера</th><th>Стоимость номера</th><th>Стоимость на одного человека</th><th>Возможное количество проживающих</th><th>Текущее количество проживающих</th><th>Статус номера</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID_номера"] . "</td><td>" . $row["номер_комнаты"] . "</td><td>" . $row["тип_номера"] . "</td><td>" . $row["стоимость_номера"] . "</td><td>" . $row["стоимость_на_одного_человека"] . "</td><td>" . $row["возможное_количество_проживающих"] . "</td><td>" . $row["текущее_количество_проживающих"] . "</td><td>" . $row["занят_свободен"] . "</td></tr>";
    }
    echo '</table>';
    echo '</div>'; // container
    echo '</div>'; // scrollTable
    echo '<div class="right">';
    echo '</div>'; // right
    echo '</div>'; // leftAndright
    echo '</div>'; // main
    echo '<footer class="footer">
            <p>&copy; Все права защищены</p>
         </footer>';
    echo '</div>'; // wrapper
    echo '</body>';
    echo '</html>';
} else {
    echo '<html>';
    echo '<head>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" type="text/css" href="../../../css/stylePages.css">
          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
          <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200&display=swap" rel="stylesheet">
          <script src="../../js/burger.js"></script>
          <script src="../../js/delete_and_selection_lines/delete_lines_card_reg.js"></script>';
    echo '</head>';
    echo '<body>';
    echo '<div class="wrapper">';
    echo '<header class="header">
            <div class="container headercontainer">
                <div class="headerbody">
                    <div class="menu-burgerheader">
                        <span></span>
                    </div>
                    <div class="menu">
                        <nav class="headernav">
                            <ul class="menu headermenu">
                                <li class="menuitem"><a href="javascript:history.back()" class="back-button">Назад</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>';
    echo "<div class='NotFound'>Свободные номера не найдены</div>";
    echo '</div>'; // wrapper
    echo '</body>';
    echo '</html>';
}

// Закрыть соединение с базой данных
$conn->close();

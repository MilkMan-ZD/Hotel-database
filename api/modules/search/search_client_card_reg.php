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

// Если форма была отправлена, выполнить поиск
if (isset($_POST["submit"])) {
    // Получить значение поля даты пребытия клиента из формы
    $departure_date = $_POST["departure_date"];

    // Выполнить запрос на поиск клиентов с указанной датой пребытия
    $sql = "SELECT * FROM карточки_регистрации WHERE дата_прибытия = '$departure_date'";
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
        echo '<tr><th>Номер регистрации клиента</th><th>Номер комнаты</th><th>Дата прибытия</th><th>ФИО</th><th>Предъявленный документ</th><th>Серия и номер документа</th><th>Дата рождения</th><th>Пол</th><th>Домашний адрес</th><th>Домашний телефон</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['номер_регистрации_клиента'] . '</td>';
            echo '<td>' . $row['номер_комнаты'] . '</td>';
            echo '<td>' . $row['дата_прибытия'] . '</td>';
            echo '<td>' . $row['ФИО'] . '</td>';
            echo '<td>' . $row['предъявленный_документ'] . '</td>';
            echo '<td>' . $row['серия_и_номер_документа'] . '</td>';
            echo '<td>' . $row['дата_рождения'] . '</td>';
            echo '<td>' . $row['пол'] . '</td>';
            echo '<td>' . $row['домашний_адрес'] . '</td>';
            echo '<td>' . $row['домашний_телефон'] . '</td>';
            echo '</tr>';
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
        echo "<div class='NotFound'>Клиентов с указанной датой прибытия не найдено</div>";
        echo '</div>'; // wrapper
        echo '</body>';
        echo '</html>';
    }
}

// Закрыть соединение с базой данных
$conn->close();

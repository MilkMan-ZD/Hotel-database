<?php

if (isset($_POST['list'])) {
    // Подключение к базе данных
    $pdo = new PDO("mysql:host=localhost;dbname=hotel", "root", "");

    // Выполнение запроса
    $stmt = $pdo->query('SELECT * FROM архив');
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Вывод таблицы с результатами
    echo '<html>';
    echo '<head>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" type="text/css" href="../../css/stylePages.css">
          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
          <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200&display=swap" rel="stylesheet">
          <script src="../../js/burger.js"></script>
          <script src="../../js/delete_and_selection_lines/delete_lines_archive_card.js"></script>';
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
    echo '<tr><th>Номер регистрации клиента</th><th>Номер комнаты</th><th>Дата прибытия</th><th>Дата убытия</th><th>ФИО</th><th>Предъявленный документ</th>
    <th>Серия и номер документа</th><th>Дата рождения</th><th>Пол</th><th>Домашний адрес</th><th>Домашний телефон</th></tr>';
    foreach ($rows as $row) {
        echo '<tr>';
        echo '<td>' . $row['номер_регистрации_клиента'] . '</td>';
        echo '<td>' . $row['номер_комнаты'] . '</td>';
        echo '<td>' . $row['дата_прибытия'] . '</td>';
        echo '<td>' . $row['дата_убытия'] . '</td>';
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
    echo '<div><button id="deleteButton" class="buttonAdd">Удалить</button></div>';
    echo '</div>'; // right
    echo '</div>'; // leftAndright
    echo '</div>'; // main
    echo '<footer class="footer">
             <p>&copy; Все права защищены</p>
          </footer>';
    echo '</div>'; // wrapper
    echo '</body>';
    echo '</html>';
}

<?php

if (isset($_POST['list'])) {
    // Подключение к базе данных
    $pdo = new PDO("mysql:host=localhost;dbname=hotel", "root", "");

    // Выполнение запроса
    $stmt = $pdo->query('SELECT * FROM расчетные_карточки');
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Вывод таблицы с результатами
    echo '<html>';
    echo '<head>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" type="text/css" href="../../css/stylePages.css">
          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
          <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200&display=swap" rel="stylesheet">
          <script src="../../js/burger.js"></script>
          <script src="../../js/delete_and_selection_lines/delete_lines_payment_card.js"></script>';
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
    echo '<tr><th>Номер регистрации клиента</th><th>Оплата брони</th><th>Предполагаемая дата убытия</th><th>Количество оплаченных дней</th><th>Сумма оплаты</th><th>Окончательный расчет</th></tr>';
    foreach ($rows as $row) {
        echo '<tr>';
        echo '<td>' . $row['номер_регистрации_клиента'] . '</td>';
        echo '<td>' . $row['оплата_брони'] . '</td>';
        echo '<td>' . $row['дата_убытия'] . '</td>';
        echo '<td>' . $row['количество_оплаченных_дней'] . '</td>';
        echo '<td>' . $row['сумма_оплаты'] . '</td>';
        echo '<td>' . $row['окончательный_расчет'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>'; // container
    echo '</div>'; // scrollTable
    echo '<div class="right">';
    echo '<form method="post" action="../modules/add_lines/add_line_payment_card.php">
                <div class="formAdd">
                   <div>
                        <label for="numberReg">Номер регистрации:</label>
                        <input type="number" name="numberReg" id="numberReg" required min="1">
                   </div>
                   <div>
                        <label for="bookingPayment">Оплата брони:</label>
                        <input type="number" name="bookingPayment" id="bookingPayment" required>
                   </div>
                   <div>
                        <label for="estimatedDateAndTimeOfDeparture">Предполагаемая дата убытия:</label>
                        <input type="date" name="estimatedDateAndTimeOfDeparture" id="estimatedDateAndTimeOfDeparture" required>
                   </div>
                   <div>
                        <label for="NumberOfPaidDays">Количество оплаченных дней:</label>
                        <input type="number" name="NumberOfPaidDays" id="NumberOfPaidDays" required min="1">
                   </div>
                   <div class="buttons-container">
                        <button class="buttonAdd" type="submit" name="submit">Добавить</button>
                   </div>
                </div>
            </form>
            <div>
            <button id="deleteButton" class="buttonAdd">Удалить</button>
            </div>';
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

<?php

if (isset($_POST['list'])) {
     // Подключение к базе данных
     $pdo = new PDO("mysql:host=localhost;dbname=hotel", "root", "");

     // Выполнение запроса
     $stmt = $pdo->query('SELECT * FROM карточки_регистрации');
     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
     // Вывод таблицы с результатами

     echo '<html>';
     echo '<head>';
     echo '<meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" type="text/css" href="../../css/stylePages.css">
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
     foreach ($rows as $row) {
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
     echo '<form method="post" action="../modules/add_lines/add_line_card_reg.php">
                <div class="formAdd">
                   <div>
                        <label for="numberReg">Номер регистрации:</label>
                        <input type="number" name="numberReg" id="numberReg" required min="1">
                   </div>
                   <div>
                        <label for="numberRoom">Номер комнаты:</label>
                        <input type="number" name="numberRoom" id="numberRoom" required min="1">
                   </div>
                   <div>
                        <label for="arrivalDate">Дата пребытия:</label>
                        <input type="date" name="arrivalDate" id="arrivalDateя" required>
                   </div>
                   <div>
                        <label for="name">ФИО:</label>
                        <input type="text" name="name" id="name" required>
                   </div>
                   <div>
                        <label for="document">Предъявленный документ:</label>
                        <input type="text" name="document" id="document" required>
                   </div>
                   <div>
                        <label for="documentSeriesAndNumber">Серия и номер документа:</label>
                        <input type="number" name="documentSeriesAndNumber" id="documentSeriesAndNumber" required>
                   </div>
                   <div>
                        <label for="dateOfBirth">Дата рождения:</label>
                        <input type="date" name="dateOfBirth" id="dateOfBirth" required>
                   </div>
                   <div>
                        <label for="my-gender">Пол:</label>
                        <label><input type="radio" name="gender" value="male" required><span>Мужской</span></label><br>
                        <label><input type="radio" name="gender" value="female" required><span>Женский</span></label><br>
                   </div>
                   <div>
                        <label for="homeAdres">Домашний адрес:</label>
                        <input type="text" name="homeAdres" id="homeAdres" required>
                   </div>
                   <div>
                        <label for="phone">Телефон в формате +7 xxx xxx-xx-xx:</label>
                        <input type="tel" id="phone" name="phone" pattern="\+7 \d{3} \d{3}\-\d{2}\-\d{2}" placeholder="+7 ___ ___-__-__" required oninput="formatPhoneNumber()">
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
?>
<script>
     function formatPhoneNumber() {
          let phoneInput = document.getElementById("phone");
          let phoneValue = phoneInput.value.replace(/\D/g, ''); // удаляем все нечисловые символы
          phoneValue = phoneValue.substring(0, 11); // ограничиваем количество цифр до 11
          let formattedPhone = "+7 " + phoneValue.substring(1, 4) + " " + phoneValue.substring(4, 7) + "-" + phoneValue.substring(7, 9) + "-" + phoneValue.substring(9, 11);
          phoneInput.value = formattedPhone;
     }
</script>
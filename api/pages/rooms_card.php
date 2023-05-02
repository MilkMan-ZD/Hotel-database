<?php

if (isset($_POST['list'])) {
     // Подключение к базе данных
     $pdo = new PDO("mysql:host=localhost;dbname=hotel", "root", "");

     // Выполнение запроса
     $stmt = $pdo->query('SELECT * FROM номера');
     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

     // Вывод таблицы с результатами
     echo '<html>';
     echo '<head>';
     echo '<meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" type="text/css" href="../../css/stylePages.css">
          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
          <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200&display=swap" rel="stylesheet">
          <script src="../../js/burger.js"></script>
          <script src="../../js/delete_and_selection_lines/delete_lines_rooms_card.js"></script>';
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
     foreach ($rows as $row) {
          echo '<tr>';
          echo '<td>' . $row['ID_номера'] . '</td>';
          echo '<td>' . $row['номер_комнаты'] . '</td>';
          echo '<td>' . $row['тип_номера'] . '</td>';
          echo '<td>' . $row['стоимость_номера'] . '</td>';
          echo '<td>' . $row['стоимость_на_одного_человека'] . '</td>';
          echo '<td>' . $row['возможное_количество_проживающих'] . '</td>';
          echo '<td>' . $row['текущее_количество_проживающих'] . '</td>';
          echo '<td>' . $row['занят_свободен'] . '</td>';
          echo '</tr>';
     }
     echo '</table>';
     echo '</div>'; // container
     echo '</div>'; // scrollTable
     echo '<div class="right">';
     echo '<form method="post" action="../modules/add_lines/add_line_room_card.php">
                <div class="formAdd"> 
                   <div>
                        <label for="idRoom">ID номера:</label>
                        <input type="number" name="idRoom" id="idRoom" required min="1">
                   </div>                  
                   <div>
                        <label for="numberRoom">Номер комнаты:</label>
                        <input type="number" name="numberRoom" id="numberRoom" required min="1">
                   </div>
                   <div>
                      <label for="roomType">Тип номера:</label>
                      <select type="roomType" name="roomType" id="roomType">
                          <option value="Стандартный номер">Стандартный номер</option>
                          <option value="Номер полулюкс">Номер полулюкс</option>
                          <option value="Номер люкс">Номер люкс</option>
                      </select>
                   </div>
                   <div>
                        <label for="roomCost">Стоимость номера:</label>
                        <input type="number" name="roomCost" id="roomCost" required min="1">
                   </div>
                   <div>
                        <label for="сostPerPerson">Стоимость на одного человека:</label>
                        <input type="number" name="сostPerPerson" id="сostPerPerson" required min="1">
                   </div>
                   <div>
                        <label for="possibleNumberOfResidents">Возможное кол-во проживающих:</label>
                        <input type="number" name="possibleNumberOfResidents" id="possibleNumberOfResidents" required min="1">
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
     const roomTypeSelect = document.getElementById("roomType");
     const сostPerPersonInput = document.getElementById("сostPerPerson");

     roomTypeSelect.addEventListener("change", () => {
          const roomType = roomTypeSelect.value;
          if (roomType === "Номер полулюкс" || roomType === "Номер люкс") {
               сostPerPersonInput.classList.add("disabled");
               сostPerPersonInput.value = "";
               сostPerPersonInput.setAttribute("disabled", true);
          } else {
               сostPerPersonInput.classList.remove("disabled");
               сostPerPersonInput.removeAttribute("disabled");
          }
     });

     roomTypeSelect.dispatchEvent(new Event("change"));
</script>
<!-- <script>
     const roomTypeSelectTwo = document.getElementById("roomType");
     const roomCost = document.getElementById("roomCost");

     roomTypeSelectTwo.addEventListener("change", () => {
          const roomTypeTwo = roomTypeSelectTwo.value;
          if (roomTypeTwo === "Стандартный номер") {
               roomCost.classList.add("disabled");
               roomCost.value = "";
               roomCost.setAttribute("disabled", true);
          } else {
               roomCost.classList.remove("disabled");
               roomCost.removeAttribute("disabled");
          }
     });

     roomTypeSelectTwo.dispatchEvent(new Event("change"));
</script> -->
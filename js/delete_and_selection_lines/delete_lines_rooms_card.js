window.addEventListener("load", function () {

    // Обработчик клика на строках таблицы
    var rows = document.getElementsByTagName("tr");
    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        row.addEventListener("click", function () {
            // Если строка уже выбрана, убираем выделение
            if (this.classList.contains("selected")) {
                this.classList.remove("selected");
            } else {
                // Убираем класс "selected" со всех строк таблицы
                var rows = document.getElementsByTagName("tr");
                for (var i = 0; i < rows.length; i++) {
                    rows[i].classList.remove("selected");
                }
                // Добавляем класс "selected" к выбранной строке
                this.classList.add("selected");
                // Дополнительные действия при выборе строки
            }
        });
    }

    // Обработчик клика на кнопке "Удалить"
    var deleteButton = document.getElementById("deleteButton");
    deleteButton.addEventListener("click", function () {
        var selectedRow = document.querySelector(".selected");

        // Если строка не выбрана, выходим из функции
        if (!selectedRow) {
            alert("Выберите строку для удаления!");
            return;
        }

        // Получаем номер регистрации клиента из выделенной строки
        var registrationNumber = selectedRow.getElementsByTagName("td")[0].textContent;

        // Отправляем запрос на удаление данных из базы данных
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../api/modules/delete_lines/delete_line_rooms_card.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Если удаление прошло успешно, удаляем строку из таблицы
                selectedRow.parentNode.removeChild(selectedRow);
            }
        };
        xhr.send("registrationNumber=" + registrationNumber);
    });
});
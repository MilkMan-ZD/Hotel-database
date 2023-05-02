<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

// Создаем соединение с базой данных
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Проверка соединения
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Получаем номер регистрации из формы
$numberReg = mysqli_real_escape_string($conn, $_POST['numberReg']);

// Получаем данные о номере из таблицы номеров
$sql_room = "SELECT стоимость_номера FROM номера
             WHERE номер_комнаты = (SELECT номер_комнаты FROM карточки_регистрации
                                     WHERE номер_регистрации_клиента = '$numberReg')";
$result_room = mysqli_query($conn, $sql_room);

if (mysqli_num_rows($result_room) > 0) {
    // Получаем стоимость номера из результата запроса
    $row_room = mysqli_fetch_assoc($result_room);
    $roomCost = $row_room['стоимость_номера'];

    // Получаем данные из формы
    $bookingPayment = mysqli_real_escape_string($conn, $_POST['bookingPayment']);
    $estimatedDateAndTimeOfDeparture = mysqli_real_escape_string($conn, $_POST['estimatedDateAndTimeOfDeparture']);
    $NumberOfPaidDays = mysqli_real_escape_string($conn, $_POST['NumberOfPaidDays']);

    // Вычисляем сумму оплаты на основе стоимости номера и количества оплаченных дней
    $totalPayment = $roomCost * $NumberOfPaidDays;
    if ($bookingPayment == " " || $bookingPayment == 0) {
        $finalCalculation = $totalPayment;
        $bookingPayment = 0;
        $sql_check = "SELECT номер_регистрации_клиента FROM расчетные_карточки WHERE номер_регистрации_клиента = '$numberReg'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Номер регистрации уже занят')</script>";
        } else {
            // Создание запроса INSERT
            $sql = "INSERT INTO расчетные_карточки (номер_регистрации_клиента, оплата_брони, дата_убытия, количество_оплаченных_дней, сумма_оплаты, окончательный_расчет) 
                    VALUES ('$numberReg', '$bookingPayment', '$estimatedDateAndTimeOfDeparture', '$NumberOfPaidDays', '$totalPayment', '$finalCalculation')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Данные успешно добавлены')</script>";
            } else {
                $error = mysqli_error($conn);
                echo "<script>alert('Произошла ошибка: $error')</script>";
            }
        }
    } else {
        if ($bookingPayment < 0) {
            echo "<script>alert('Оплата брони не может быть отрицательной')</script>";
        } else {
            $finalCalculation = $bookingPayment + $totalPayment;
            // Проверка на дубликаты
            $sql_check = "SELECT номер_регистрации_клиента FROM расчетные_карточки WHERE номер_регистрации_клиента = '$numberReg'";
            $result_check = mysqli_query($conn, $sql_check);

            if (mysqli_num_rows($result_check) > 0) {
                echo "<script>alert('Номер регистрации уже занят')</script>";
            } else {
                // Создание запроса INSERT
                $sql = "INSERT INTO расчетные_карточки (номер_регистрации_клиента, оплата_брони, дата_убытия, количество_оплаченных_дней, сумма_оплаты, окончательный_расчет) 
                    VALUES ('$numberReg', '$bookingPayment', '$estimatedDateAndTimeOfDeparture', '$NumberOfPaidDays', '$totalPayment', '$finalCalculation')";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>alert('Данные успешно добавлены')</script>";
                } else {
                    $error = mysqli_error($conn);
                    echo "<script>alert('Произошла ошибка: $error')</script>";
                }
            }
        }
    }
} else {
    echo "<script>alert('Номер регистрации не найден')</script>";
}

mysqli_close($conn);

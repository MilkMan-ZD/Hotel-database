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

// Обработка данных из формы
$numberRoom = mysqli_real_escape_string($conn, $_POST['numberRoom']);

// Получение значения введенного номера комнаты
$idRoom = mysqli_real_escape_string($conn, $_POST['idRoom']);

// Проверка на дубликаты
$sql_check = "SELECT ID_номера FROM номера WHERE ID_номера = '$idRoom'";
$result_check = mysqli_query($conn, $sql_check);

// Проверка на дубликаты 2
$sql_check = "SELECT номер_комнаты FROM номера WHERE номер_комнаты = '$numberRoom'";
$result_checkTwo = mysqli_query($conn, $sql_check);


if (mysqli_num_rows($result_check) > 0) {
    echo "<script>alert('ID номера уже занят')</script>";
} else {
    if (mysqli_num_rows($result_checkTwo) > 0) {
        echo "<script>alert('Номер комнаты уже занят')</script>";
    } else {
        $idRoom = mysqli_real_escape_string($conn, $_POST['idRoom']);
        $numberRoom = mysqli_real_escape_string($conn, $_POST['numberRoom']);
        $roomType = mysqli_real_escape_string($conn, $_POST['roomType']);
        if ($roomType == "Номер полулюкс" || $roomType == "Номер люкс") {
            $сostPerPerson = null;
        } else {
            $сostPerPerson = mysqli_real_escape_string($conn, $_POST['сostPerPerson']);
        }
        // if ($roomType == "Стандартный номер") {
        //     $roomCost = null;
        // } else {
            $roomCost = mysqli_real_escape_string($conn, $_POST['roomCost']);
        // }
        $possibleNumberOfResidents = mysqli_real_escape_string($conn, $_POST['possibleNumberOfResidents']);
        $status = "Свободен";
        $theCurrentNumberOfSurvivors = "0";
        // Создание запроса INSERT
        $sql = "INSERT INTO номера (ID_номера, номер_комнаты, тип_номера, стоимость_номера, стоимость_на_одного_человека, 
        возможное_количество_проживающих, текущее_количество_проживающих, занят_свободен) 
        VALUES ('$idRoom', '$numberRoom', '$roomType', '$roomCost', '$сostPerPerson', '$possibleNumberOfResidents','$theCurrentNumberOfSurvivors ', '$status')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Данные успешно добавлены')</script>";
        } else {
            $error = mysqli_error($conn);
            echo "<script>alert('Произошла ошибка: $error')</script>";
        }
    }
}
mysqli_close($conn);

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
$numberReg = mysqli_real_escape_string($conn, $_POST['numberReg']);

// Получение значения введенного номера комнаты
$numberRoom = mysqli_real_escape_string($conn, $_POST['numberRoom']);

// Проверка на дубликаты
$sql_check = "SELECT номер_регистрации_клиента FROM карточки_регистрации WHERE номер_регистрации_клиента = '$numberReg'";
$result_check = mysqli_query($conn, $sql_check);

// Проверка на дубликаты 2
$sql_check = "SELECT номер_регистрации_клиента FROM архив WHERE номер_регистрации_клиента = '$numberReg'";
$result_checkTwo = mysqli_query($conn, $sql_check);

// Проверка существования номера комнаты в таблице номеров
$sql_check_room = "SELECT * FROM номера WHERE номер_комнаты = '$numberRoom'";
$result_check_room = mysqli_query($conn, $sql_check_room);

if (mysqli_num_rows($result_check_room) != 1) {
    echo "<script>alert('Номер комнаты не существует')</script>";
} else {
    if (mysqli_num_rows($result_check) > 0 || mysqli_num_rows($result_checkTwo) > 0) {
        echo "<script>alert('Номер регистрации уже занят')</script>";
    } else {
        $arrivalDate = mysqli_real_escape_string($conn, $_POST['arrivalDate']);
        $dateOfBirth = mysqli_real_escape_string($conn, $_POST['dateOfBirth']);

        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        if ($gender == 'male') {
            $gender = 'Мужской';
        } elseif ($gender == 'female') {
            $gender = 'Женский';
        }
        $homeAdres = mysqli_real_escape_string($conn, $_POST['homeAdres']);
        if ($arrivalDate <= $dateOfBirth) {
            echo "<script>alert('Дата приезда не может быть больше чем дата рождения')</script>";
        } else {
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $numberRoom = mysqli_real_escape_string($conn, $_POST['numberRoom']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $document = mysqli_real_escape_string($conn, $_POST['document']);
            $documentSeriesAndNumber = mysqli_real_escape_string($conn, $_POST['documentSeriesAndNumber']);

            // Создание запроса INSERT
            $sql = "INSERT INTO карточки_регистрации (номер_регистрации_клиента, номер_комнаты, дата_прибытия, ФИО, предъявленный_документ, 
        серия_и_номер_документа, дата_рождения, пол, домашний_адрес, домашний_телефон) 
        VALUES ('$numberReg', '$numberRoom', '$arrivalDate', '$name', '$document', '$documentSeriesAndNumber', '$dateOfBirth', '$gender', '$homeAdres', '$phone')";

            // Проверка наличия свободных мест в номере
            $sql_check = "SELECT текущее_количество_проживающих, возможное_количество_проживающих FROM номера WHERE номер_комнаты = '$numberRoom'";
            $result_check = mysqli_query($conn, $sql_check);
            if (!$result_check) {
                $error = mysqli_error($conn);
                echo "<script>alert('Произошла ошибка: $error')</script>";
            } else {
                $row = mysqli_fetch_assoc($result_check);
                if ($row['текущее_количество_проживающих'] >= $row['возможное_количество_проживающих']) {
                    echo "<script>alert('Номер занят')</script>";
                } else {
                    // Обновление данных в таблице номера
                    $sql_update = "UPDATE номера SET текущее_количество_проживающих = текущее_количество_проживающих + 1, 
                занят_свободен = IF(текущее_количество_проживающих = возможное_количество_проживающих, 'Занят', 'Свободен') WHERE номер_комнаты = '$numberRoom'";
                    $result_update = mysqli_query($conn, $sql_update);
                    if (!$result_update) {
                        $error = mysqli_error($conn);
                        echo "<script>alert('Произошла ошибка: $error')</script>";
                    } else {
                        // Создание запроса INSERT
                        $sql = "INSERT INTO карточки_регистрации (номер_регистрации_клиента, номер_комнаты, дата_прибытия, 
                    ФИО, предъявленный_документ, серия_и_номер_документа, дата_рождения, пол, домашний_адрес, домашний_телефон) 
                VALUES ('$numberReg', '$numberRoom', '$arrivalDate', '$name', '$document', '$documentSeriesAndNumber', '$dateOfBirth', '$gender', '$homeAdres', '$phone')";
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
        }
    }
}


mysqli_close($conn);

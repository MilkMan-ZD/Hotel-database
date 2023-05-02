<?php
$registrationNumber = $_POST["registrationNumber"];

// Подключение к базе данных
$pdo = new PDO("mysql:host=localhost;dbname=hotel", "root", "");

// Начало транзакции
$pdo->beginTransaction();

try {
    // Получение данных из таблицы "расчетные_карточки"
    $stmt_select2 = $pdo->prepare("SELECT дата_убытия FROM расчетные_карточки WHERE номер_регистрации_клиента = ?");
    $stmt_select2->execute([$registrationNumber]);
    $data2 = $stmt_select2->fetch(PDO::FETCH_ASSOC);

    if ($data2) { // Если есть данные в таблице "расчетные_карточки"
        // Получение данных из таблицы "карточки_регистрации"
        $stmt_select = $pdo->prepare("SELECT * FROM карточки_регистрации WHERE номер_регистрации_клиента = ?");
        $stmt_select->execute([$registrationNumber]);
        $data = $stmt_select->fetch(PDO::FETCH_ASSOC);

        // Вставка данных в таблицу "архив"
        $stmt_insert = $pdo->prepare("INSERT INTO архив (номер_регистрации_клиента, номер_комнаты, дата_прибытия, дата_убытия,
        ФИО, предъявленный_документ, серия_и_номер_документа, дата_рождения, пол, домашний_адрес, домашний_телефон) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->execute([
            $data['номер_регистрации_клиента'], $data['номер_комнаты'], $data['дата_прибытия'], $data2['дата_убытия'], $data['ФИО'],
            $data['предъявленный_документ'], $data['серия_и_номер_документа'], $data['дата_рождения'],
            $data['пол'], $data['домашний_адрес'], $data['домашний_телефон']
        ]);

        // Удаление данных из таблицы "карточки_регистрации"
        $stmt_delete = $pdo->prepare("DELETE карточки_регистрации, расчетные_карточки FROM карточки_регистрации 
        JOIN расчетные_карточки ON карточки_регистрации.номер_регистрации_клиента = расчетные_карточки.номер_регистрации_клиента 
        WHERE карточки_регистрации.номер_регистрации_клиента = ?");
        $stmt_delete->execute([$registrationNumber]);

        // Получение данных из таблицы "номера"
        $stmt_select3 = $pdo->prepare("SELECT * FROM номера WHERE номер_комнаты = ?");
        $stmt_select3->execute([$data['номер_комнаты']]);
        $data3 = $stmt_select3->fetch(PDO::FETCH_ASSOC);

        if ($data3) { // Если есть данные в таблице "номера"
            // Изменение текущего количества проживающих
            $currentGuests = $data3['текущее_количество_проживающих'] - 1;
            $stmt_update = $pdo->prepare("UPDATE номера SET текущее_количество_проживающих = ? WHERE номер_комнаты = ?");
            $stmt_update->execute([$currentGuests, $data['номер_комнаты']]);

            // Изменение статуса номера
            if ($currentGuests < $data3['возможное_количество_проживающих']) {
                $stmt_update2 = $pdo->prepare("UPDATE номера SET занят_свободен = 'Свободен' WHERE номер_комнаты = ?");
                $stmt_update2->execute([$data['номер_комнаты']]);
            }
        }

        // Фиксация изменений в базе данных
        $pdo->commit();

        echo "Данные успешно перенесены в таблицу архив.";
    } else { // Если нет данных в таблице "расчетные_карточки"
        // Удаление данныхиз таблицы "карточки_регистрации"
        $stmt_delete = $pdo->prepare("DELETE FROM карточки_регистрации WHERE номер_регистрации_клиента = ?");
        $stmt_delete->execute([$registrationNumber]); // Фиксация изменений в базе данных
        $pdo->commit();

        echo "Данные успешно удалены из таблицы карточек регистрации.";
    }
} catch (PDOException $e) {
    // Отмена транзакции в случае ошибки
    $pdo->rollBack();
    echo "Ошибка: " . $e->getMessage();
}

<?php
$registrationNumber = $_POST["registrationNumber"];

// Подключение к базе данных
$pdo = new PDO("mysql:host=localhost;dbname=hotel", "root", "");

// Удаление данных из базы данных
$stmt = $pdo->prepare("DELETE FROM расчетные_карточки WHERE номер_регистрации_клиента = ?");
$stmt->execute([$registrationNumber]);

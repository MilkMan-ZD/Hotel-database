<?php
header("Content-Type:text/html; charset=UTF-8;"); //используется для отправки необработанных HTTP-шапок
require_once("api/config.php"); // подключаем конфигурационной файл
require_once("api/core.php"); // подключаемкласс ACore
if (file_exists("api/main.php")) { //проверяем существование файла
    include("api/main.php"); //загружаем его
    if (class_exists('Main')) { //проверяем существование класса
        $obj = new Main; //создаем объект - экземпляр класса main
        $obj->get_body(); //вызываем функцию класса
    } else {
        exit("<p>Не верные данные для входа</p>"); //если класса не существует - то выходим
    }
} else {
    exit("<p>Не правильный адрес</p>"); //если файла не существует - то выходим
}
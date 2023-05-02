<?php
abstract class ACore
{ //абстрактный класс
    protected $connect; //определяем переменную db видимую только потомкам классa
    public function __construct()
    { //создаем коснтруктор
        $this->connect = new mysqli(HOST, USER, PASSWORD, DB); //устанавливаем соединение
        if ($this->connect->connect_error) { //если невозможно установить соединение 
            exit("Ошибка соединения с базой данных: " . $this->connect->connect_error); // то выходим и выводим ошибку
        }
        $this->connect->set_charset("utf8"); //устанавливаем кодировку с которой будем работать с БД
    }
    public function __destruct()
    {
        $this->connect->close();
    }
    public function get_body()
    { //функция загрузки шаблона
        include "template/index.php";
    }
}

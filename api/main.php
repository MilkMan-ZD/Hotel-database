<?php
class Main extends ACore
{ //создаем класс main расширяющий класс Core
    public function get_content()
    {
        include("api/modules/mod_list.php");
    }
}

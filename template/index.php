<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="js/burger.js"></script>
    <title>Hotel</title>
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="container headercontainer">
                <div class="headerbody">
                    <div class="menu-burgerheader">
                        <span></span>
                    </div>
                    <div class="menu">
                        <nav class="headernav">
                            <ul class="menu headermenu">
                                <li class="menuitem"><a href="#" onclick="document.getElementById('formCardReg').submit()">Карточки регистрации</a></li>
                                <li class="menuitem"><a href="#" onclick="document.getElementById('formPaymentCards').submit()">Расчётные карточки</a></li>
                                <li class="menuitem"><a href="#" onclick="document.getElementById('formRooms').submit()">Номера</a></li>
                                <li class="menuitem"><a href="#" onclick="document.getElementById('formArchive').submit()">Архив</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div class="main">
            <form id="formCardReg" method="post" action="api/pages/card_reg.php">
                <input type="hidden" name="list" value="true">
            </form>
            <form id="formPaymentCards" method="post" action="api/pages/payment_card.php">
                <input type="hidden" name="list" value="true">
            </form>
            <form id="formRooms" method="post" action="api/pages/rooms_card.php">
                <input type="hidden" name="list" value="true">
            </form>
            <form id="formArchive" method="post" action="api/pages/archive_card.php">
                <input type="hidden" name="list" value="true">
            </form>
            <div class="searchDiv">
                <div class="searchDivInDiv">
                    <form method="post" action="api/modules/search/search_client_archive.php">
                        <div class="labelTxt"><label for="departure_date">Поиск выселившихся клиентов</label></div>
                        <div>
                            <label class="labelTxt" for="departure_date">Введите дату убытия клиента:</label>
                            <input type="date" name="departure_date" id="departure_date">
                            <button class="buttonAdd" type="submit" name="submit">Поиск</button>
                        </div>
                    </form>
                </div>
                <div class="searchDivInDiv">
                    <form method="post" action="api/modules/search/search_client_card_reg.php">
                        <div class="labelTxt"><label for="departure_date">Поиск прибывших клиентов за определёный день</label></div>
                        <div>
                            <label class="labelTxt" for="departure_date">Введите дату прибытия:</label>
                            <input type="date" name="departure_date" id="departure_date">
                            <button class="buttonAdd" type="submit" name="submit">Поиск</button>
                        </div>
                    </form>
                </div>
                <div class="searchDivInDiv">
                    <form method="post" action="api/modules/search/search_numbers.php">
                        <div class="margin">
                            <button class="buttonAdd" type="submit" name="submit">Найти свободные номера</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer">
            <p>&copy; Все права защищены</p>
        </footer>
    </div>

</body>

</html>
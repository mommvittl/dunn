<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>staff</title>
        <link href="/public/css/styles.css" rel="stylesheet" />
        <script src="public/js/my_js_library.js"></script>
    </head>
    <body>
        <div class="outDiv">
            <header class="header">
                <h1>Управление сотрудниками</h1>
            </header>
            <nav  class="mainnav">
                <p>
                    <span><a href="/index/index">Главная</a></span>
                    <span><a href="/employes/">Cотрудники</a></span>
                </p>
            </nav>
            <section class="sectionContent">
                <h2>Формирование URL</h2>
                <p>URL формируется стандартным образом - snake.dp.ua/controller/action/parameter</p>
                <p>Для контроллера employes, согласно ЕЗ, адрес формируется по след.правилам:</p>
                <p>snake.dp.ua/employes - вывод всех сотрудников, станица по умолчанию - 1</p>
                <p>snake.dp.ua/employes/5 - вывод всех сотрудников, станица по умолчанию - 5</p>
                <p>snake.dp.ua/employes/departamentName - вывод  сотрудников отдела departamentName,  станица по умолчанию - 1</p>
                <p>snake.dp.ua/employes/departamentName/4 - вывод  сотрудников отдела departamentName,  станица по умолчанию - 4</p>
                <p>В БД сформированы такие отделы:</p>
                <li>stock</li>
                <li>management</li>
                <li>marketing</li>
                <br><hr><br>
                <p>Для изменения параметров вывода в таблице можно использовать соотв. поля выбора
                    отделов и размерности вывода таблицы. Информация в таблице обновляется AJAX запросами.
                </p>
            </section>
        </div>
    </body>
</html>




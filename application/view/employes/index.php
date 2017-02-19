<html>
    <head>
        <meta charset="utf-8">
        <title>stock</title>
        <link href="/public/css/styles.css" rel="stylesheet" />
        <script src="/public/js/my_js_library.js"></script>
    </head>
    <body>
        <div class="outDiv">
            <header class="header">
                <h1>Управление сотрудниками.......</h1>
            </header>
            <nav  class="mainnav">
                <p>
                    <span><a href="/index/index">Главная</a></span>
                    <span><a href="/employes/">Cотрудники</a></span>
                </p>
            </nav>
            <section id="mainSection">
                <p class="selectStr">
                    <span>выберите отдел</span><select id="selectDepartament"><option value="0">Все отделы</option></select>
                    <span class="paginationSize"><select id="selectPaginationSize">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="60">60</option>
                        </select></span>
                </p>
                <div class="staffContent" id="staffContent">

                </div>
            </section>
        </div>
        <script>
            var idDepartament = <?php echo $this->departamentId ?>;
            var page = <?php echo $this->page ?>;
        </script>
        <script src="/public/js/employes/employes.js"></script>
    </body>
</html>


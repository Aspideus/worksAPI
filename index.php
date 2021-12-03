<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>API works</title>
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="scss/main.css">
</head>
<body>
            <header id="header" class="wrapper-column">
                <span>Поиск по номеру:</span>
                <form action="./scripts/search.php" onsubmit="" method="get">
                    <input type="text" name="search_field"></input>
                    <input type="submit" class="wrapper-column__input" value="Поиск"></input>
                </form>
                <button class="wrapper-column__input add-note" onclick="showModal();">Добавить новую запись</button>
            </header>

            <div class="main wrapper-column">
                <?php
                    require __DIR__.'/scripts/load.php';
                ?>
                
            </div>
            <div class="form-publish wrapper-column">
                <?php
                    require __DIR__.'/scripts/form-load.php';
                ?>
            </div>

    <script src="js/main.js"></script>
</body>
</html>

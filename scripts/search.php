<?php
    require_once 'db_connect.php';

    if (isset($_GET["search_field"])) {
        closeDatabase('phone', $_GET["search_field"]);
    }

    closeDatabase();

<?php

    function openDatabase($host, $user, $password, $database) {
        $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link)); 
        $link->set_charset('utf8');
        setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian'); 

        return $link;
    }

    function closeDatabase($get = null, $route = null)
    {
        mysqli_close($link); 

        if ($route != null) {
            header( 'Location: ../index.php?'.$get.'='.$route);
        } else {
            header( 'Location: ../index.php');
        }
        die();
    }

    function closeDatabaseWithError($message, $link) {
        echo "Error: " . $message . "<br>" . mysqli_error($link);
        mysqli_close($link);
        die();
    }

    function insertToDatabase($content, $link) {
        if (mysqli_query($link, $content)) {
            echo "New record created successfully";
        } else {
            closeDatabaseWithError($content, $link);
        }
    }

    function selectFromDatabase($query, $link) {
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        
        return mysqli_fetch_row($result);
    }
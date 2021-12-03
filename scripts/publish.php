<?php 
    require_once 'db_connect.php';

    function phoneCut($getphone) {
        //спецсимволы, которые нужно убрать
        $trim_symbols = array(" ", "(", ")", "-");
        //убираем спецсимволы
        $trimmed_phone = str_replace($trim_symbols, "", $getphone);
        //обрезать до 10 цифр с конца
        $phone_nocode = substr($trimmed_phone, -10, 10);
        //и вернём в переменную
        return $phone_nocode;
    }

    $p_name = mysqli_real_escape_string($link, $_POST["name"]);
    $p_phone = phoneCut(mysqli_real_escape_string($link, $_POST["phone"]));
    $p_email = mysqli_real_escape_string($link, $_POST["email"]);

    if($p_phone == "") {
        $time = 0;
    } else {
        $time = time();
    }

    $session = 'SELECT count(*) FROM user_info WHERE user_ip = "'.$user_ip.'"';
    $result = mysqli_query($link, $session); 
    $row = mysqli_fetch_row($result);

    $phone_check = 'SELECT `last_modified_phone` FROM user_info WHERE user_ip = "'.$user_ip.'"';
    $phone_checking = selectFromDatabase($phone_check, $link);
    //если нашли айпи в бд
    if ($row[0] > 0 ) {

        //если блок на фронтенде не сработал
        if ((time() - $phone_checking[0] < 86400) && ($p_phone != "")) { //86400 секунд в сутках
                echo "С момента прошлого добавления телефона прошло меньше суток. Повторите позднее.";
                echo "<div><a href='../index.php'>Вернуться на главную</a><div>";
                mysqli_close($link);
                die();
        } else if ($p_phone != "") {
            $phone_changed = 'UPDATE `user_info` SET `last_modified_phone` = '.$time.' WHERE user_ip = "'.$user_ip.'"';
            $phone_changing = insertToDatabase($phone_changed, $link);
        } 

    } else {
        $new_user_add = 'INSERT INTO `user_info` (`user_ip`, `last_modified_phone`) VALUES ("'.$user_ip.'", '.$time.')';
        insertToDatabase($new_user_add, $link);
    }

    $user_founded = 'SELECT id FROM user_info WHERE `user_ip` = "'.$user_ip.'"';

    $result = mysqli_query($link, $user_founded) or die("Ошибка " . mysqli_error($link)); 
    $row = mysqli_fetch_row($result);

    $shout_items = array(
        'name' => $p_name,
        'phone' => $p_phone,
        'email' => $p_email
    );

    $json = '['.json_encode($shout_items, JSON_UNESCAPED_UNICODE).']';
    var_dump($json);

    $sql = "INSERT INTO `contacts` (`items`, `source_id`) VALUES ('".$json."', '".(int)$row[0]."')";

    insertToDatabase($sql, $link);
    closeDatabase();
    die();
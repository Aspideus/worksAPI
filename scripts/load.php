<?php
    require_once 'db_connect.php';

    if (isset($_GET["phone"])) {
        $query = 'SELECT * FROM contacts WHERE `items` LIKE \'%"phone": "'.$_GET["phone"].'"%\'';
        $rows_count = 'SELECT count(*) FROM contacts WHERE `items` LIKE \'%"phone": "'.$_GET["phone"].'"%\'';
    } else {
        /*$query = 'SELECT * FROM contacts ORDER BY source_id'; //сортировка по сессиям
        $rows_count = 'SELECT count(*) FROM contacts ORDER BY source_id';*/
        $query = 'SELECT * FROM contacts';
        $rows_count = 'SELECT count(*) FROM contacts';
    }
    

    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    $rows = mysqli_num_rows($result);
    
    for ($j = 0 ; $j < $rows ; ++$j) {
        $row = mysqli_fetch_row($result);

        $row[1] = htmlspecialchars($row[1]);
        $row[1] = substr($row[1], 1, -1);

        $json = str_replace('&quot;', '"', $row[1]);
        $row_json = json_decode($json);

        echo ' <div class="main__message">
            <div class="main__message--number">'.htmlspecialchars($row[0]).'
            </div>
                <div><strong>Имя: </strong>'
                .$row_json->name.
                '</div><div><strong>Телефон: </strong>'
                .$row_json->phone.
                '</div><div><strong>E-mail: </strong>'
                .$row_json->email.
                '</div>';

                //echo '<div>Сессия '.htmlspecialchars($row[2]).'</div>';
                echo '</div>';

    };

    $rows_count = selectFromDatabase($rows_count, $link);
    echo "<div>Общее количество записей: ".$rows_count[0]."</div><br/>";

    mysqli_free_result($result);
    //mysqli_close($link);

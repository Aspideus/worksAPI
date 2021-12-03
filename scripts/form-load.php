<?php
    require_once 'db_connect.php';

        $phone_check = 'SELECT `last_modified_phone` FROM user_info WHERE user_ip = "'.$user_ip.'"';

        $phone_checking = selectFromDatabase($phone_check, $link);

        $is_phone_change_available = true;
        //если блок на фронтенде не сработал
        if (time() - $phone_checking[0] < 86400) {
            //echo "С момента прошлого добавления телефона прошло меньше суток. Повторите позднее.";
            $is_phone_change_available = false;
        }

        echo '
        <div class="modal-window hidden">
        <div class="modal-window__area close-modal"></div>
        <form action="./scripts/publish.php" onsubmit="onPublish();" method="post">
            <img src="./img/close.png" alt="Закрыть" class="close-img close-modal" />
            <label>Name: </label>
            <input type="text" name="name">
            <br />
            <label>Phone: </label>
            <input type="phone"';
            if(!$is_phone_change_available) {
                echo ' disabled ';
            }
            echo 'name="phone">
            <br />
            <label>E-mail: </label>
            <input type="email" name="email">
            <br />
            <button type="submit">Добавить</button>
        </form>
        </div>
';
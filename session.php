<?php
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        session_destroy();
        echo
        "
        <script>
            window.location = 'main.php';
        </script>
        ";
    }

?>
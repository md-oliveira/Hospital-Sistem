<?php
    session_start();

    session_unset();
    
    session_destroy();

    echo"<script>alert('Aguarde')</script>;";
    echo"<meta http-equiv='refresh' content='1;url=../Login/index.php'>";
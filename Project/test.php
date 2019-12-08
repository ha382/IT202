<?php
    session_start();
    $id = $_SESSION['id'];
    $transTable=$id."transTable";
    echo $transTable;

?>
<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=autocompletion;charset=utf8' , 'admin', 'admin');
}
catch (Exception $e) {
    die('error : ' . $e->getMessage());
}

?>
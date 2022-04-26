<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=autocompletion', 'admin', 'admin');
}
catch (Exception $e) {
    die('error : ' . $e->getMessage());
}

?>
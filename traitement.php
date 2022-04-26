<?php
require_once('db.php');

$result = array(
    'start' => [],
    'contain' => []
);
$queryStart = $db->prepare("SELECT * FROM `atome` WHERE `nom` LIKE CONCAT(:input, '%')");
$queryStart->execute(array(
    ':input' => htmlspecialchars($_GET['search'])
));
$resStart = $queryStart->fetchAll();

if (!empty($resStart)) {
    $result = array(
        'start' => $resStart,
        'contain' => []
    );
}

$queryContain = $db->prepare("SELECT * FROM `atome` WHERE `nom` LIKE CONCAT('%', :input, '%')");
$queryContain->execute(array(
    ':input' => htmlspecialchars($_GET['search'])
));
$resContain = $queryContain->fetchAll();

if (!empty($resContain)) {
    $result = array(
        'start' => $resStart,
        'contain' => $resContain
    );
}

echo json_encode($result);

?>

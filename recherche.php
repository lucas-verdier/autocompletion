<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=autocompletion', 'admin', 'admin');
}
catch (Exception $e) {
    die('error : ' . $e->getMessage());
}

$queryStart = $db->prepare("SELECT * FROM `atome` WHERE `nom` LIKE CONCAT(:input, '%')");
$queryStart->execute(array(
    ':input' => htmlspecialchars($_GET['search'])
));
$resStart = $queryStart->fetchAll(PDO::FETCH_ASSOC);

$queryContain = $db->prepare("SELECT * FROM `atome` WHERE `nom` LIKE CONCAT('%', :input, '%')");
$queryContain->execute(array(
    ':input' => htmlspecialchars($_GET['search'])
));
$resContain = $queryContain->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="script.js"></script>
    <title>Atom - Autocomplétion</title>
</head>
<body>
<main>
    <h1>Atom Search</h1>
    <form method="GET">
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">search</i>
                        <input type="text" id="autocomplete-input" class="autocomplete" name="search">
                        <label for="autocomplete-input">Search</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <section></section>
    <section></section>
    <article>
        <?php foreach($resStart as $key => $value): ?>
            <a href="#"><?= $value['nom'] ?></a>
        <?php endforeach ?>
    </article>
    <article>
        <?php foreach($resContain as $key => $value): ?>
            <a href="#"><?= $value['nom'] ?></a>
        <?php endforeach ?>
    </article>
</main>
</body>
</html>
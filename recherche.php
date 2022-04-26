<?php

require_once('db.php');

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
<header>
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
</header>
<main id="element">
    <section></section>
    <section></section>
    <article class="results">
        <?php foreach($resStart as $key => $value): ?>
        <div>
            <a href="element.php?id=<?= $value['slug'] ?>"><?= $value['symbole'] . ' - ' . $value['nom'] ?></a>
            <p>Symbole : <?= $value['symbole'] ?></p>
            <p>Découvert par : <?= $value['decouverte_noms'].'('.$value['decouverte_pays'].')'. ' - ' . $value['decouverte_annee'] ?></p>
            <a href="element.php?id=<?= $value['slug'] ?>">Voir plus...</a>
        </div>
        <?php endforeach ?>
    </article>
    <article class="results">
        <?php foreach($resContain as $key => $value): ?>
        <div>
            <a href="element.php?id=<?= $value['slug'] ?>"><?= $value['symbole'] . ' - ' . $value['nom'] ?></a>
            <p>Symbole : <?= $value['symbole'] ?></p>
            <p>Découvert par : <?= $value['decouverte_noms'].'('.$value['decouverte_pays'].')'. ' - ' . $value['decouverte_annee'] ?></p>
            <a href="element.php?id=<?= $value['slug'] ?>">Voir plus...</a>
        </div>
        <?php endforeach ?>
    </article>
</main>
</body>
</html>
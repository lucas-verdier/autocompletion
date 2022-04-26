<?php

require_once('db.php');

$item = htmlspecialchars($_GET['id']);

$query = $db->prepare("SELECT * FROM `atome` WHERE `slug` = :item");
$query->execute(array(
        ':item' => $item
));
$res = $query->fetch(PDO::FETCH_ASSOC);
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
    <article>
        <h2><?= $res['nom'] ?></h2>
        <table>
            <?php foreach($res as $key => $value): ?>
            <tr>
                <td class="tdKey"><?= $key ?></td>
                <td><?= $value ?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </article>
</main>
</body>
</html>
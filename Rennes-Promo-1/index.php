<?php include('head.php'); ?>
<h2>- Partie 1 : Dictionnaire -</h2>
<?php
    $string = file_get_contents("../dictionnaire.txt", FILE_USE_INCLUDE_PATH); 
    $dico = explode("\n", $string);
    
    // nombre de mots dans le dictionnaire.
    if (count($dico) <= 1) {
        echo '<p>Il y a <b>' . count($dico) . ' mot</b> dans ce dictionnaire.</p>';
    } else {
        echo '<p>Il y a <b>' . count($dico) . ' mots</b> dans ce dictionnaire.</p>';
    }
    
    // longueur du tableau...
    $dicoLength = count($dico);

    // nombre de mots à exactement 15 caractères dans le dictionnaire.
    $nbWord = 0;
    for ($x = 0; $x < $dicoLength; $x++) {
        if (strlen($dico[$x]) == 15) {
            $nbWord++;
        }
    }
    if ($nbWord <= 1) {
        echo '<p>Il y a <b>' . $nbWord . ' mot</b> <i>d\'exactement</i> <b>15 caractères</b> dans ce dictionnaire.</p>';
    } else {
        echo '<p>Il y a <b>' . $nbWord . ' mots</b> <i>d\'exactement</i> <b>15 caractères</b> dans ce dictionnaire.</p>';
    }

    // nombre de mots contenant la lettre "w".
    $nbWord = 0;
    for ($x = 0; $x < $dicoLength; $x++) {
        if (substr_count($dico[$x], 'w')) {
            $nbWord++;
        }
    }
    if ($nbWord <= 1) {
        echo '<p>Il y a <b>' . $nbWord . ' mot</b> contenant <i>au moins</i> un <b>"W"</b> dans ce dictionnaire.</p>';
    } else {
        echo '<p>Il y a <b>' . $nbWord . ' mots</b> contenant <i>au moins</i> un <b>"W"</b> dans ce dictionnaire.</p>';
    }

    // nombre de mots finissant par la lettre "q".
    $nbWord = 0;
    for ($x = 0; $x < $dicoLength; $x++) {
        $temp = strpos(strrev($dico[$x]), 'q');
        if ($temp === 0) {
            $nbWord++;
        }
    }
    if ($nbWord <= 1) {
        echo '<p>Il y a <b>' . $nbWord . ' mot</b> <i>finissant</i> par la lettre <b>"Q"</b> dans ce dictionnaire.</p>';
    } else {
        echo '<p>Il y a <b>' . $nbWord . ' mots</b> <i>finissant</i> par la lettre <b>"Q"</b> dans ce dictionnaire.</p>';
    }
?>

<h2>- Partie 2 : Liste de films -</h2>
<?php 
    $string = file_get_contents("../films.json", FILE_USE_INCLUDE_PATH);
    $brut = json_decode($string, true);
    $top = $brut["feed"]["entry"]; # liste de films
    
    // Top 10 des films.
    echo '<ol>- Top 10 des films -';
    for ($x = 0; $x < 10; $x++) {
        echo '<li>' . $top[$x]['im:name']['label'] . '</li>';
    }
    echo '</ol>';

    // Classement du film "Gravity".
    for ($x = 0; $x < count($top); $x++) {
        if ($top[$x]['im:name']['label'] == 'Gravity') {
            echo '<p>Gravity est le <b>' . ($x+1) . 'ème</b> film de la liste.</p>';
        }
    }

    // Auteur du film "The LEGO Movie".
    for ($x = 0; $x < count($top); $x++) {
        if ($top[$x]['im:name']['label'] == 'The LEGO Movie') {
            echo '<p><i>Réalisateur</i> de "' . $top[$x]['im:name']['label'] . '" : <b>' . $top[$x]['im:artist']['label'] . '</b> .</p>';
        }
    }
    
    // Nombre de films sorti avant 2000.
    $nbFilm = 0;
    for ($x = 0; $x < count($top); $x++) {
        if ($top[$x]['im:releaseDate']['label'] < 2000) {
            $nbFilm++;
        }
    }
    echo '<p>Il y a dans cette liste <b>' . $nbFilm . ' films</b> qui sont sorti <i>avant</i> <b>l\'année 2000.</b></p>';

    // Film le plus vieux.
    $date = $top[0]['im:releaseDate']['label'];
    for ($x = 1; $x < count($top); $x++) {
        if ($date > $top[$x]['im:releaseDate']['label']) {
            $date = $top[$x]['im:releaseDate']['label'];
            $name = $top[$x]['im:name']['label'];
        } 
    }
    echo '<p>Le film <i>le plus jeune</i> de la liste est <b>' . $name . '</b> .</p>';
    
    // Film le plus récent.
    $date = $top[0]['im:releaseDate']['label'];
    for ($x = 1; $x < count($top); $x++) {
        if ($date < $top[$x]['im:releaseDate']['label']) {
            $date = $top[$x]['im:releaseDate']['label'];
            $name = $top[$x]['im:name']['label'];
        } 
    }
    echo '<p>Le film <i>le plus vieux</i> de la liste est <b>' . $name . '</b> .</p>';
    
    // Catégories de film la plus représentée.
    $categoryTab = [];
    for ($x = 0; $x < count($top); $x++) {
        $value = $top[$x]['category']['attributes']['term'];
        array_push($categoryTab, $value);
    }
    $categoryTab = array_count_values($categoryTab);
    $categoryTab = array_search(max($categoryTab), $categoryTab);

    echo '<p>La catégorie <i>la plus représentée</i> dans la liste est <b>' . $categoryTab . '</b> .</p>';

    // Réalisateur le plus présent.
    $artistTab = [];
    for ($x = 0; $x < count($top); $x++) {
        $value = $top[$x]['im:artist']['label'];
        array_push($artistTab, $value);
    }
    $artistTab = array_count_values($artistTab);
    $artistTab = array_search(max($artistTab), $artistTab);

    echo '<p>Le réalisteur <i>le plus présent</i> dans la liste est <b>' . $artistTab . '</b> .</p>';

    // Prix total du TOP10.
    for ($x = 0; $x < 10; $x++) {
        $totalPrice = $totalPrice + ($top[$x]['im:price']['attributes']['amount']);
    }
    echo '<p>Le prix <i>total</i> du <i>TOP10</i> est de <b>' . $totalPrice . '$</b> .</p>';

    // Mois avec le plus sorti au cinéma.
    /*$mounth =  $top[0]['im:releaseDate']['attributes']['label'];
    $mounth = explode(" ", $top[0]['im:releaseDate']['attributes']['label']);
    echo $mounth[0];*/

    $mounthTab = [];
    for ($x = 0; $x < count($top); $x++) {
        $value = $top[$x]['im:releaseDate']['attributes']['label'];
        array_push($mounthTab, $value);
    }
    $mounthTab = array_count_values($mounthTab);
    $mounthTab = array_search(max($mounthTab), $mounthTab);

    $mounthTab = explode(" ", $mounthTab);
    $mounthTab = $mounthTab[0];

    echo '<p>Le <i>mois</i> qui a connus <i>le plus de sorti</i> est <b>' . $mounthTab . '</b> .';
?>


<?php include('footer.php'); ?>
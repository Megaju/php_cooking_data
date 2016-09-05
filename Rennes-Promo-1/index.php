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
        echo '<p>Il y a <b>' . $nbWord . ' mot</b> d\'exactement <b>15 caractères</b> dans ce dictionnaire.</p>';
    } else {
        echo '<p>Il y a <b>' . $nbWord . ' mots</b> d\'exactement <b>15 caractères</b> dans ce dictionnaire.</p>';
    }

    // nombre de mots contenant la lettre "w".
    $nbWord = 0;
    for ($x = 0; $x < $dicoLength; $x++) {
        if (substr_count($dico[$x], 'w')) {
            $nbWord++;
        }
    }
    if ($nbWord <= 1) {
        echo '<p>Il y a <b>' . $nbWord . ' mot</b> contenant au moins un <b>"W"</b> dans ce dictionnaire.</p>';
    } else {
        echo '<p>Il y a <b>' . $nbWord . ' mots</b> contenant au moins un <b>"W"</b> dans ce dictionnaire.</p>';
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
        echo '<p>Il y a <b>' . $nbWord . ' mot</b> finissant par la lettre <b>"Q"</b> dans ce dictionnaire.</p>';
    } else {
        echo '<p>Il y a <b>' . $nbWord . ' mots</b> finissant par la lettre <b>"Q"</b> dans ce dictionnaire.</p>';
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
    echo '<p>Réalisateur de "The LEGO Movie" : <b>' . $top[37]['im:artist']['label'] . '</b> .</p>';

    // Nombre de films sorti avant 2000.
    
    
?>



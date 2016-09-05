<?php
    $string = file_get_contents("../dictionnaire.txt", FILE_USE_INCLUDE_PATH); 
    $dico = explode("\n", $string);
    
    // nombre de mots dans le dictionnaire.
    if (count($dico) <= 1) {
        echo '<p>Il y a <b>' . count($dico) . ' mot</b> dans ce dictionnaire.</p>';
    } else {
        echo '<p>Il y a <b>' . count($dico) . ' mots</b> dans ce dictionnaire.</p>';
    }
    
    // initialisation de 2 var pour la suite...
    $nbWord = 0;
    $dicoLength = count($dico);

    // nombre de mots à exactement 15 caractères dans le dictionnaire.
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
    for ($x = 0; $x < $dicoLength; $x++) {
        if (substr_count($dico[$x],"w")) {
            $nbWord++;
        }
    }
    if ($nbWord <= 1) {
        echo '<p>Il y a <b>' . $nbWord . ' mot</b> contenant au moins un <b>"W"</b> dans ce dictionnaire.</p>';
    } else {
        echo '<p>Il y a <b>' . $nbWord . ' mots</b> contenant au moins un <b>"W"</b> dans ce dictionnaire.</p>';
    }

    // nombre de mots finissant par la lettre "q".
    for ($x = 0; $x < $dicoLength; $x++) {
        $temp = strpos(strrev($dico[$x]), 'q');
        if ($temp == 0) {
            $nbWord++;
        }
    }
    if ($nbWord <= 1) {
        echo '<p>Il y a <b>' . $nbWord . ' mot</b> finissant par la lettre <b>"Q"</b> dans ce dictionnaire.</p>';
    } else {
        echo '<p>Il y a <b>' . $nbWord . ' mots</b> finissant par la lettre <b>"Q"</b> dans ce dictionnaire.</p>';
    }
?>
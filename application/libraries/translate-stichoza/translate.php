<?php

require_once './vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;

$tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
$tr->setSource('en'); // Translate from English
$tr->setSource(); // Detect language automatically
$tr->setTarget('ru'); // Translate to Georgian

echo $tr->translate("
    <p>The utility's decision to curb electricity supplies proactively comes nearly a year after the \"Camp Fire,\" the deadliest fire in state history, 
    killed 86 people and destroyed nearly 20,000 structures in Butte County.</p>
    <p>PG&E officials said early Wednesday morning that they had begin shutting off power to approximately 513,000 
    customers in the areas of Amador, Butte, Calaveras, Colusa, El Dorado, Glenn, Humboldt, Lake, Marin, Mendocino, Napa, 
    Nevada, Placer, Plumas, Shasta, Sierra, Solano, Sonoma, Tehama, Trinity, Yolo and Yuba.
    </p>

    <p>
    An additional 234,00 customer were due to have their power cut around around noon Wednesday in the areas of Alameda, 
    Alpine, Contra Costa, Mariposa, San Joaquin, San Mateo and Santa Clara. At that point officials said they would 
    consider a third phase of cuts affecting approximately 42,000 customers in locations to be determined.
    </p>");

<?php

include('modules/recipe/api/api.php');

echo '<div style="margin:auto;">';

recipeparser_collect(recipeparser_fetch($_GET['material']));

brewingparser_collect(brewingparser_fetch($_GET['material']));

echo '</div>';
?>
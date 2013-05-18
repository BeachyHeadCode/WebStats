<?php
include('include/recipe/api/api.php');
recipeparser_collect(recipeparser_fetch($_GET['material']));
brewingparser_collect(brewingparser_fetch($_GET['material']));
smeltingparser_collect(smeltingparser_fetch($_GET['material']));
?>
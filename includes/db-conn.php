<?php

    $db = new PDO('mysql:host=172.31.22.43;dbname=Paramveer200491057', 'Paramveer200491057', 'JEK73Td9FB');

    // enable PDO error messages as these are hidden by default
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
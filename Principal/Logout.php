<?php
session_start();
session_destroy();

header('Location: ../Principal/home.html');
?>
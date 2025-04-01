<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: index.php");
} else {
    if ($_SESSION['tipoUsuario'] == "professor") {
        header("Location: dashboard_professor.php");
    } else {
        header("Location: dashboard_biblio.php");
    }
}

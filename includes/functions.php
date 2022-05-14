<?php

function getDbConnection()
{
    return new PDO('mysql:host=localhost;dbname=red_social', 'root','');
}

function calcula(string $date): string
{
    $t = strtotime($date);

    $time = time();

    if ($time - $t === 1) {
        return "Hace 1 segundo";
    }
    if ($time - $t === 0) {
        return "Ahora";
    }

    if ($time - $t < 60) {
        return "Hace " . ($time - $t) . " segundos";
    }

    if ($time - $t < 60 * 2) {
        return "Hace 1 minuto";
    }

    if ($time - $t < 60 * 60) {
        return "Hace " . floor(($time - $t) / 60) . " minutos";
    }

    if ($time - $t < 60 * 60 * 2) {
        return "Hace 1 hora";
    }

    if ($time - $t < 60 * 60 * 36) {
        return "Hace " . floor(($time - $t) / 60 / 60) . " horas";
    }

    if ($time - $t < 60 * 60 * 24 * 7) {
        return "Hace " . floor(($time - $t) / 60 / 60 / 24) . " días";
    }

    return "el " . date("d/m/Y", $t);
}

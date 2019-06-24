<?php

function extractFromMYSQL($addr, $username, $password, $DBName, $query) {
    $link = mysqli_connect($addr, $username, $password, $DBName);

    $result = mysqli_query($link, $query);
    $array = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }

    mysqli_close($link);

    return $array;
}

function updateMYSQL($addr, $username, $password, $DBName, $query) {
    $link = mysqli_connect($addr, $username, $password, $DBName);
    $result = mysqli_query($link, $query);
    mysqli_close($link);
    return $result;
}

function comparisonByPopularityDesc($a, $b) {
    return $b['popularity'] <=> $a['popularity'];
}
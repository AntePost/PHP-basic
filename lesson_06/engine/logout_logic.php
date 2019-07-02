<?php

include './session_start.php';

session_unset();

header("Location: ./../logout.php");
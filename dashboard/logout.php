<?php
include_once "./includes/db.php";

session_unset();
session_destroy();

header("location:./login.php");

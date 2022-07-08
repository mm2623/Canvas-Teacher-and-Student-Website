<?php
session_start();
require_once 'functions.php';
reset_session();
flash("Successfully logged out", "success");
redirect("login.php");
?>
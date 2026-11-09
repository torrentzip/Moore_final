<?php
function get_connection() {
    $host = "localhost";
    $user = "ecpi_user";
    $pass = "Password1";
    $db   = "sdc310_midterm";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        return new mysqli($host, $user, $pass, $db);
    } catch (mysqli_sql_exception $e) {
        die("Could not connect to the database: " . htmlspecialchars($e->getMessage()));
    }
}
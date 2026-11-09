<?php
require_once __DIR__ . "/../model/address_db.php";

function validate_address($first, $last, $street, $city, $state, $zip) {
    if ($first === "" || $last === "" || $street === "" || $city === "" || $state === "" || $zip === "") {
        return "Please fill in all fields.";
    }
    if (strlen($first) > 25 || strlen($last) > 30 || strlen($street) > 100 || strlen($city) > 25 || strlen($state) > 2 || strlen($zip) > 10) {
        return "One or more values are too long (State must be 2 characters).";
    }
    return "";
}

function process_post() {
    $action    = $_POST["action"] ?? "";
    $addressNo = (int)($_POST["addressno"] ?? 0);
    $first     = trim($_POST["first"] ?? "");
    $last      = trim($_POST["last"] ?? "");
    $street    = trim($_POST["street"] ?? "");
    $city      = trim($_POST["city"] ?? "");
    $state     = trim($_POST["state"] ?? "");
    $zip       = trim($_POST["zip"] ?? "");

    if ($action === "delete") {
        delete_address($addressNo);
        return "Address deleted.";
    }

    $error = validate_address($first, $last, $street, $city, $state, $zip);
    if ($error !== "") {
        return $error;
    }

    if ($action === "add") {
        add_address($first, $last, $street, $city, $state, $zip);
        return "Address added.";
    }
    if ($action === "update") {
        update_address($addressNo, $first, $last, $street, $city, $state, $zip);
        return "Address updated.";
    }
    return "";
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = process_post();
}

$editRow = null;
if (isset($_GET["edit"])) {
    $editRow = get_address((int)$_GET["edit"]);
}

$addresses = get_addresses();
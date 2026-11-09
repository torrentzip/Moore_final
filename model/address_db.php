<?php
require_once __DIR__ . "/database.php";

function get_addresses() {
    $conn = get_connection();
    $result = $conn->query("SELECT * FROM addresses ORDER BY AddressNo");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $rows;
}

function get_address($addressNo) {
    $conn = get_connection();
    $stmt = $conn->prepare("SELECT * FROM addresses WHERE AddressNo = ?");
    $stmt->bind_param("i", $addressNo);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $conn->close();
    return $row;
}

function add_address($first, $last, $street, $city, $state, $zip) {
    $conn = get_connection();
    $stmt = $conn->prepare("INSERT INTO addresses (`First`, `Last`, `Street`, `City`, `State`, `Zip`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first, $last, $street, $city, $state, $zip);
    $stmt->execute();
    $conn->close();
}

function update_address($addressNo, $first, $last, $street, $city, $state, $zip) {
    $conn = get_connection();
    $stmt = $conn->prepare("UPDATE addresses SET `First` = ?, `Last` = ?, `Street` = ?, `City` = ?, `State` = ?, `Zip` = ? WHERE AddressNo = ?");
    $stmt->bind_param("ssssssi", $first, $last, $street, $city, $state, $zip, $addressNo);
    $stmt->execute();
    $conn->close();
}

function delete_address($addressNo) {
    $conn = get_connection();
    $stmt = $conn->prepare("DELETE FROM addresses WHERE AddressNo = ?");
    $stmt->bind_param("i", $addressNo);
    $stmt->execute();
    $conn->close();
}
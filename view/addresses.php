<?php require_once __DIR__ . "/../controller/address_controller.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Torren Moore SDC310 Final</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <?php if ($message !== "") { ?>
        <p><b><?php echo htmlspecialchars($message); ?></b></p>
    <?php } ?>

    <table>
        <tr>
            <th>Address #</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Street Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip Code</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($addresses as $i => $row) { ?>
            <tr class="<?php echo ($i % 2 === 0) ? "light" : "dark"; ?>">
                <td><?php echo (int)$row["AddressNo"]; ?></td>
                <td><?php echo htmlspecialchars($row["First"]); ?></td>
                <td><?php echo htmlspecialchars($row["Last"]); ?></td>
                <td><?php echo htmlspecialchars($row["Street"]); ?></td>
                <td><?php echo htmlspecialchars($row["City"]); ?></td>
                <td><?php echo htmlspecialchars($row["State"]); ?></td>
                <td><?php echo htmlspecialchars($row["Zip"]); ?></td>
                <td>
                    <form method="get" action="addresses.php">
                        <input type="hidden" name="edit" value="<?php echo (int)$row["AddressNo"]; ?>">
                        <input type="submit" value="Edit">
                    </form>
                </td>
                <td>
                    <form method="post" action="addresses.php">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="addressno" value="<?php echo (int)$row["AddressNo"]; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <form method="post" action="addresses.php">
        <input type="hidden" name="action" value="<?php echo $editRow ? "update" : "add"; ?>">
        <input type="hidden" name="addressno" value="<?php echo $editRow ? (int)$editRow["AddressNo"] : 0; ?>">
        <p><b>Enter your first name:</b> <input type="text" name="first" value="<?php echo $editRow ? htmlspecialchars($editRow["First"]) : ""; ?>"></p>
        <p><b>Enter your last name:</b> <input type="text" name="last" value="<?php echo $editRow ? htmlspecialchars($editRow["Last"]) : ""; ?>"></p>
        <p><b>Enter your street address:</b> <input type="text" name="street" value="<?php echo $editRow ? htmlspecialchars($editRow["Street"]) : ""; ?>"></p>
        <p><b>Enter your city:</b> <input type="text" name="city" value="<?php echo $editRow ? htmlspecialchars($editRow["City"]) : ""; ?>"></p>
        <p><b>Enter your state:</b> <input type="text" name="state" value="<?php echo $editRow ? htmlspecialchars($editRow["State"]) : ""; ?>"></p>
        <p><b>Enter your zip code:</b> <input type="text" name="zip" value="<?php echo $editRow ? htmlspecialchars($editRow["Zip"]) : ""; ?>"></p>
        <input type="submit" value="<?php echo $editRow ? "Update Address" : "Add User"; ?>">
        <?php if ($editRow) { ?>
            <a href="addresses.php">Cancel</a>
        <?php } ?>
    </form>
</body>

</html>
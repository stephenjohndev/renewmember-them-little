<?php

# Set database parameters


require_once $_SERVER['DOCUMENT_ROOT'].'/_system/php/connection/db_connection.php';

# Retrieve POST parameters
$package_id = $_GET['package_id'];

# Check parameters if null
if (isset($package_id)) {

    try {

        # Connect to Database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        # Perform SQL Query
        $sql = "DELETE FROM packages WHERE package_id = $package_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        # Perform SQL Query
        $sql = "DELETE FROM package_inclusions WHERE package_id = $package_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        # Print success
        echo json_encode((object)[
            'success' => true
        ]);

    } catch (PDOException $e) {

        echo json_encode((object)[
            'success' => false,
            'message' => "Connection failed: " . $e->getMessage()
        ]);

    }
}
else {
    echo 'values not set';
}


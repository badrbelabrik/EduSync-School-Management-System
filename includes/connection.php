<?php 
try{
    $conn = new PDO ("mysql:host=localhost:3306;dbname=school_db","root","");
} catch(PDOException $e){
    echo "connection failed: " . $e->getMessage();
}
?>
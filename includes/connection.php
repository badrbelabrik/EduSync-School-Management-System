<?php 
try{
    $conn = new PDO ("mysql:host=localhost;dbname=school_db","root","");
} catch(PDOException $e){
    echo "connection failed: " . $e->getMessage();
}
?>
<?php
try{
$conn = new PDO('mysql:host=localhost; dbname=libreta', 'root', '');
} catch(PDOException $e){
   echo "Error: ". $e->getMessage();
   die();
}
?>
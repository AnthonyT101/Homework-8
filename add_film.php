<!DOCTYPE html>

<!-- Author: Anthony, Malachi, Sami
Date: 11/11/2023
File: Homework8
Purpose: Homework #8
-->

<?php

$host = 'localhost:3306';
$username = 'anthony';
$password = 'password123';
$database = 'sakila';

//Open database Connection
$connection = new mysqli($host, $username, $password, $database);

//Variables for the adding the film
$title = $_POST['title'];
$description = $_POST['description'];
$release_year = $_POST['release_year'];
$language_id = $_POST['language_id'];
$rental_duration = $_POST['rental_duration'];
$rental_rate = $_POST['rental_rate'];
$length = $_POST['length'];
$replacement_cost = $_POST['replacement_cost'];
$rating = $_POST['rating'];
$special_features = $_POST['special_features'];  

//Prepared Statement
$sql = "INSERT INTO sakila.film (title, description, release_year, language_id, rental_duration, rental_rate, length, replacement_cost, rating, special_features)
        VALUES ('$title', '$description', $release_year, $language_id, $rental_duration, $rental_rate, $length, $replacement_cost, '$rating', '$special_features')";

//Run the Query to the database
if ($connection->query($sql) === TRUE) {
    $message = "Film added successfully.";
} else {
    $message = "Error: " . $sql . "<br>" . $connection->error;
}

//Close the database connection
$connection->close();

?>

<html>
	<head>
		<title> PHP Add Film </title>
	</head>
	<body style="background-color: gray;">
    <h2>Add Film Results</h2>
    <p><?php echo $message; ?></p>
	<a href="manager.html"> Return to Manager Homepage.</a>
</body>
</html>
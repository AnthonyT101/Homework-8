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

//Query Code
$sql = "SELECT 
            c.customer_id,
            c.first_name, 
            c.last_name, 
            a.address,
            a.district, 
            a.postal_code, 
            ci.city,
            GROUP_CONCAT(f.title) as film_titles
        FROM 
            customer c
        LEFT JOIN 
            rental r ON c.customer_id = r.customer_id
        LEFT JOIN 
            inventory i ON r.inventory_id = i.inventory_id
        LEFT JOIN 
            film f ON i.film_id = f.film_id
        LEFT JOIN
            address a ON c.address_id = a.address_id
        LEFT JOIN
            city ci ON a.city_id = ci.city_id
        GROUP BY 
            c.customer_id
        ORDER BY 
            c.last_name";

//Run results to Database
$result = $connection->query($sql);
?>

<html>
	<head>
		<title> view_customers.php </title>
		<link rel="stylesheet" type="text/css" href="sample.css">
	</head>
	<body style="background-color: gray;">
	<center><h1>Customer Data</h1></center>
	<center><h2>View Customers</h2></center>
	<center><a href="manager.html"> Return to Manager Homepage.</a></center>
	<!--Create table-->
   		<center><table>
        	<tr>
           		<th>First Name</th>
            	<th>Last Name</th>
				<th>Address</th>
            	<th>City</th>
           		<th>District</th>
           		<th>Postal Code</th>
           		<th>Film Titles</th>
        	</tr>
	<?php
	//Fill the table with data from the database
	while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['first_name']}</td>";
            echo "<td>{$row['last_name']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['city']}</td>";
            echo "<td>{$row['district']}</td>";
            echo "<td>{$row['postal_code']}</td>";
            echo "<td>{$row['film_titles']}</td>";
            echo "</tr>";
        }	
	?>
	</table></center>
	</body>
</html>

<!--Close the Database Connection-->
<?php
$connection->close();
?>
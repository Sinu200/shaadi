<?php
require 'config.php';

$query = "CREATE TABLE ourservices (
    Srn INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    bg_img VARCHAR(500) NOT NULL,
    mark VARCHAR(150) NOT NULL,
    category VARCHAR(40) NOT NULL,
    rating VARCHAR(10) NOT NULL,
    price VARCHAR(30) NOT NULL,
    int_price VARCHAR(30) NOT NULL,
    address VARCHAR(300) NOT NULL,
    role VARCHAR(20) NOT NULL,
    city VARCHAR(10) NOT NULL
)";

$runQuery = mysqli_query($db, $query);

// if ($runQuery) {
//     echo "Table created successfully";
// } else {
//     echo "Error creating table: " . mysqli_error($db);
// }

<?php
require 'config.php';

$rowCount = 0;
$csvFile = '../shaadi/document/our-services.csv';

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

        // Assigning trimmed values from CSV columns
        $name = mysqli_real_escape_string($db, trim($data[0]));
        $bg_img  = mysqli_real_escape_string($db, trim($data[1]));
        $mark = mysqli_real_escape_string($db, trim($data[2]));
        $category = mysqli_real_escape_string($db, trim($data[3]));
        $rating = mysqli_real_escape_string($db, trim($data[4]));
        $price = mysqli_real_escape_string($db, trim($data[5]));
        $address = mysqli_real_escape_string($db, trim($data[6]));
        $role = mysqli_real_escape_string($db, trim($data[7]));
        $city = mysqli_real_escape_string($db, trim($data[8]));
        $int_price = mysqli_real_escape_string($db, trim($data[9]));

        // SQL query to insert data into 'data' table
        $query = "INSERT INTO ourservices (name, bg_img, mark, category, rating, price, address, role, city,int_price)
                  VALUES ('$name', '$bg_img', '$mark', '$category', '$rating', '$price', '$address', '$role', '$city','$int_price')";

        $runQuery = mysqli_query($db, $query);

        if ($runQuery) {
            echo "Product data inserted successfully for '$name'!<br>"; // Success message
        } else {
            echo "Error inserting data for Product '$name': " . mysqli_error($db) . "<br>"; // Error message
        }
        $rowCount++; // Increment the row count

    }
    fclose($handle);
} else {
    echo "Could not open the CSV file.";
}

mysqli_close($db);

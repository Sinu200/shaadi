<?php
require "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Services</title>
    <link rel="stylesheet" href=".//css/card-category.css">
</head>

<body>
    <div class="main-services">
        <div class="services">
            <div class="main-left">
                <form id="filter-form" method="GET" action="">
                    <!-- Radio Buttons for Cities -->
                    <div class="left">
                        <h2>Filter by City</h2>
                        <div class="filter">
                            <div id="radio-container">
                                <?php
                                if (isset($_GET['category'])) {
                                    $category = htmlspecialchars($_GET['category']);
                                    echo '<input type="hidden" name="category" value="' . $category . '">';

                                    $escaped_category = mysqli_real_escape_string($db, $category);
                                    $query = "SELECT DISTINCT city FROM ourservices WHERE category='$escaped_category'";

                                    $result = $db->query($query);
                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $cities[] = $row['city'];
                                        }
                                    }

                                    foreach ($cities as $city) {
                                        $checked = (isset($_GET['selected_city']) && $_GET['selected_city'] == $city) ? 'checked' : '';
                                        echo "<div>";
                                        echo "<input type='radio' id='$city' name='selected_city' value='$city' $checked>";
                                        echo "<label for='$city'>$city</label>";
                                        echo "</div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    <!-- Price Range Slider -->
                    <br>
                    <div class="left">
                        <h2>Price Range Slider</h2>
                        <div class="filter">
                            <div class="values">
                                <span id="min-value">$700</span>
                                <span id="max-value">$3000</span>
                            </div>
                            <input type="range" class="scroll" id="min-range" name="min_price" min="700" max="3000" value="<?= isset($_GET['min_price']) ? $_GET['min_price'] : '700'; ?>" step="100">
                            <input type="range" class="scroll" id="max-range" name="max_price" min="700" max="3000" value="<?= isset($_GET['max_price']) ? $_GET['max_price'] : '3000'; ?>" step="100">
                            <div class="output">
                                <div>$ <span id="min-output"><?= isset($_GET['min_price']) ? $_GET['min_price'] : '700'; ?></span></div>
                                <div>$ <span id="max-output"><?= isset($_GET['max_price']) ? $_GET['max_price'] : '3000'; ?></span></div>
                            </div>
                        </div>
                    </div>


                    <!-- Rating Filters -->
                    <br>
                    <div class="left rating-container">
                        <h2>By Rating</h2>
                        <div class="filter">
                            <?php
                            $ratings = [
                                'Under 1' => [0, 1],
                                'Between 1 and 2' => [1, 2],
                                'Between 2 and 3' => [2, 3],
                                'Between 3 and 4' => [3, 4],
                                'Between 4 and 5' => [4, 5],
                                'Above 5' => [5, 6]
                            ];

                            foreach ($ratings as $label => $range) {
                                $value = implode('-', $range);
                                $checked = (isset($_GET['selected_rating']) && $_GET['selected_rating'] == $value) ? 'checked' : '';
                                echo "<div class='left-rating-container'>";
                                echo "<input type='radio' id='$label' name='selected_rating' value='$value' $checked>";
                                echo "<label for='$label'>$label <span>★</span></label>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>

                </form>
            </div>
            <div class="right">
                <?php
                if (isset($_GET['category'])) {
                    $category = mysqli_real_escape_string($db, $_GET['category']);
                    $city_filter = isset($_GET['selected_city']) ? "AND city='" . mysqli_real_escape_string($db, $_GET['selected_city']) . "'" : "";
                    $price_filter = isset($_GET['min_price']) && isset($_GET['max_price']) ? "AND int_price BETWEEN " . (int)$_GET['min_price'] . " AND " . (int)$_GET['max_price'] : "";
                    $rating_filter = isset($_GET['selected_rating']) ? "AND rating BETWEEN " . implode(' AND ', explode('-', $_GET['selected_rating'])) : "";

                    $query = "SELECT * FROM ourservices WHERE category='$category' $city_filter $price_filter $rating_filter";
                    $runquery = mysqli_query($db, $query);

                    if (mysqli_num_rows($runquery) > 0) {
                        while ($row = mysqli_fetch_assoc($runquery)) {
                            echo "<div class='card'>
                                <img class='img-fluid' src='{$row["bg_img"]}' alt='{$row["name"]}'>
                                <h2 class='title'>{$row["name"]}</h2>
                                <p>{$row["mark"]}</p>
                                <p>{$row["rating"]}★</p>
                                <p>Starting Price: {$row["price"]}</p>
                                <div class='social-links'>
                                    <a class='btn' href='#'>Request price</a>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<p>No services found for this category.</p>";
                    }
                } else {
                    echo "Category parameter is missing from the URL.";
                }

                $db->close();
                ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('min-range').addEventListener('input', function() {
            document.getElementById('min-output').textContent = this.value;
            document.getElementById('filter-form').submit();
        });

        document.getElementById('max-range').addEventListener('input', function() {
            document.getElementById('max-output').textContent = this.value;
            document.getElementById('filter-form').submit();
        });

        document.querySelectorAll('input[name="selected_city"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('filter-form').submit();
            });
        });

        document.querySelectorAll('input[name="selected_rating"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('filter-form').submit();
            });
        });
    </script>
</body>

</html>
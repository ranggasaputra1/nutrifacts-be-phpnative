<?php
// Include config file
require_once "config.php";

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get hidden input value
    $id = $_POST["id"];

    // Process form data without checking for empty values

    $name = trim($_POST["name"]);
    $company = trim($_POST["company"]);
    $photoUrl = trim($_POST["photoUrl"]);
    $calories = trim($_POST["calories"]);
    $total_fat = trim($_POST["total_fat"]);
    $saturated_fat = trim($_POST["saturated_fat"]);
    $trans_fat = trim($_POST["trans_fat"]);
    $cholesterol = trim($_POST["cholesterol"]);
    $sodium = trim($_POST["sodium"]);
    $total_carbohydrate = trim($_POST["total_carbohydrate"]);
    $dietary_fiber = trim($_POST["dietary_fiber"]);
    $sugar = trim($_POST["sugar"]);
    $protein = trim($_POST["protein"]);
    $calcium = trim($_POST["calcium"]);
    $iron = trim($_POST["iron"]);
    $vitamin_a = trim($_POST["vitamin_a"]);
    $vitamin_c = trim($_POST["vitamin_c"]);
    $vitamin_d = trim($_POST["vitamin_d"]);
    $nutrition_level = trim($_POST["nutrition_level"]);
    $barcode = trim($_POST["barcode"]);

    // Prepare an update statement
    $sql = "UPDATE product SET name=?, company=?, photoUrl=?, calories=?, total_fat=?, saturated_fat=?, trans_fat=?, cholesterol=?, sodium=?, total_carbohydrate=?, dietary_fiber=?, sugar=?, protein=?, calcium=?, iron=?, vitamin_a=?, vitamin_c=?, vitamin_d=?, nutrition_level=?, barcode=? WHERE id=?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssi", $name, $company, $photoUrl, $calories, $total_fat, $saturated_fat, $trans_fat, $cholesterol, $sodium, $total_carbohydrate, $dietary_fiber, $sugar, $protein, $calcium, $iron, $vitamin_a, $vitamin_c, $vitamin_d, $nutrition_level, $barcode, $id);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records updated successfully. Redirect to the landing page
            header("location: index.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
}

// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Get URL parameter
    $id = trim($_GET["id"]);

    // Prepare a select statement
    $sql = "SELECT * FROM product WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                // Fetch result row as an associative array.
                $row = mysqli_fetch_assoc($result);

                // Retrieve individual field value
                $name = $row["name"];
                $company = $row["company"];
                $photoUrl = $row["photoUrl"];
                $calories = $row["calories"];
                $total_fat = $row["total_fat"];
                $saturated_fat = $row["saturated_fat"];
                $trans_fat = $row["trans_fat"];
                $cholesterol = $row["cholesterol"];
                $sodium = $row["sodium"];
                $total_carbohydrate = $row["total_carbohydrate"];
                $dietary_fiber = $row["dietary_fiber"];
                $sugar = $row["sugar"];
                $protein = $row["protein"];
                $calcium = $row["calcium"];
                $iron = $row["iron"];
                $vitamin_a = $row["vitamin_a"];
                $vitamin_c = $row["vitamin_c"];
                $vitamin_d = $row["vitamin_d"];
                $nutrition_level = $row["nutrition_level"];
                $barcode = $row["barcode"];
            } else {
                // URL doesn't contain a valid id. Redirect to the error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain an id parameter. Redirect to the error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Product | Nutrifacts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Product</h2>
                    </div>
                    <p>Harap edit nilai masukan dan submit untuk memperbarui produk.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>">
    </div>
    <div class="form-group">
        <label for="company">Company</label>
        <input type="text" name="company" id="company" class="form-control" value="<?php echo $company; ?>">
    </div>
    <div class="form-group">
        <label for="photoUrl">PhotoUrl</label>
        <input type="text" name="photoUrl" id="photoUrl" class="form-control" value="<?php echo $photoUrl; ?>">
    </div>
    <div class="form-group">
        <label for="calories">Calories</label>
        <input type="text" name="calories" id="calories" class="form-control" value="<?php echo $calories; ?>">
    </div>
    <div class="form-group">
        <label for="total_fat">Total Fat</label>
        <input type="text" name="total_fat" id="total_fat" class="form-control" value="<?php echo $total_fat; ?>">
    </div>
    <div class="form-group">
        <label for="saturated_fat">Saturated Fat</label>
        <input type="text" name="saturated_fat" id="saturated_fat" class="form-control" value="<?php echo $saturated_fat; ?>">
    </div>
    <div class="form-group">
        <label for="trans_fat">Trans Fat</label>
        <input type="text" name="trans_fat" id="trans_fat" class="form-control" value="<?php echo $trans_fat; ?>">
    </div>
    <div class="form-group">
        <label for="cholesterol">Cholesterol</label>
        <input type="text" name="cholesterol" id="cholesterol" class="form-control" value="<?php echo $cholesterol; ?>">
    </div>
    <div class="form-group">
        <label for="sodium">Sodium</label>
        <input type="text" name="sodium" id="sodium" class="form-control" value="<?php echo $sodium; ?>">
    </div>
    <div class="form-group">
        <label for="total_carbohydrate">Total Carbohydrate</label>
        <input type="text" name="total_carbohydrate" id="total_carbohydrate" class="form-control" value="<?php echo $total_carbohydrate; ?>">
    </div>
    <div class="form-group">
        <label for="dietary_fiber">Dietary Fiber</label>
        <input type="text" name="dietary_fiber" id="dietary_fiber" class="form-control" value="<?php echo $dietary_fiber; ?>">
    </div>
    <div class="form-group">
        <label for="sugar">Sugar</label>
        <input type="text" name="sugar" id="sugar" class="form-control" value="<?php echo $sugar; ?>">
    </div>
    <div class="form-group">
        <label for="protein">Protein</label>
        <input type="text" name="protein" id="protein" class="form-control" value="<?php echo $protein; ?>">
    </div>
    <div class="form-group">
        <label for="calcium">Calcium</label>
        <input type="text" name="calcium" id="calcium" class="form-control" value="<?php echo $calcium; ?>">
    </div>
    <div class="form-group">
        <label for="iron">Iron</label>
        <input type="text" name="iron" id="iron" class="form-control" value="<?php echo $iron; ?>">
    </div>
    <div class="form-group">
        <label for="vitamin_a">Vitamin A</label>
        <input type="text" name="vitamin_a" id="vitamin_a" class="form-control" value="<?php echo $vitamin_a; ?>">
    </div>
    <div class="form-group">
        <label for="vitamin_c">Vitamin C</label>
        <input type="text" name="vitamin_c" id="vitamin_c" class="form-control" value="<?php echo $vitamin_c; ?>">
    </div>
    <div class="form-group">
        <label for="vitamin_d">Vitamin D</label>
        <input type="text" name="vitamin_d" id="vitamin_d" class="form-control" value="<?php echo $vitamin_d; ?>">
    </div>
    <div class="form-group">
        <label for="nutrition_level">Nutrition Level</label>
        <input type="text" name="nutrition_level" id="nutrition_level" class="form-control" value="<?php echo $nutrition_level; ?>">
    </div>
    <div class="form-group">
        <label for="barcode">Barcode</label>
        <input type="text" name="barcode" id="barcode" class="form-control" value="<?php echo $barcode; ?>">
    </div>

    <input type="submit" class="btn btn-primary" value="Submit" onclick="return confirm('Apakah anda yakin akan memperbaharui data?');">
    <a href="index.php" class="btn btn-default">Cancel</a>
</form>


<br>    
                </div>
            </div>
        </div>
    </div>
</body>

</html>

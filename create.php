<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $company = $photoUrl = $calories = $total_fat = $saturated_fat = $trans_fat = $cholesterol = $sodium = $total_carbohydrate = $dietary_fiber = $sugar = $protein = $calcium = $iron = $vitamin_a = $vitamin_c = $vitamin_d = $nutrition_level = $barcode = "";
$name_err = $company_err = $photoUrl_err = $calories_err = $total_fat_err = $saturated_fat_err = $trans_fat_err = $cholesterol_err = $sodium_err = $total_carbohydrate_err = $dietary_fiber_err = $sugar = $protein_err = $calcium_err = $iron_err = $vitamin_a_err = $vitamin_c_err = $vitamin_d_err = $nutrition_level_err = $barcode_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // CSV File Handling
    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == UPLOAD_ERR_OK) {
        $csvFile = $_FILES['csvFile']['tmp_name'];

        // Read CSV file
        $handle = fopen($csvFile, "r");

        // Get the header
        $header = fgetcsv($handle, 1000, ";"); // Ganti koma dengan titik koma di sini

        // Check if the header matches the expected columns
        $expectedColumns = ["name", "company", "photoUrl", "calories", "total_fat", "saturated_fat", "trans_fat", "cholesterol", "sodium", "total_carbohydrate", "dietary_fiber", "sugar", "protein", "calcium", "iron", "vitamin_a", "vitamin_c", "vitamin_d", "nutrition_level", "barcode"];
        $header = array_map('trim', $header); // Trim any leading/trailing whitespaces

        if ($header !== $expectedColumns) {
            die("Error: Invalid CSV format. Expected columns: " . implode(", ", $expectedColumns));
        }

        // Insert data into the database
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { // Ganti koma dengan titik koma di sini
            // Escape and quote each value
            $escapedData = array_map(function ($value) use ($link) {
                return empty($value) ? 'NULL' : "'" . mysqli_real_escape_string($link, $value) . "'";
            }, $data);

            // Construct the SQL query
            $sql = "INSERT INTO product (" . implode(", ", $expectedColumns) . ") VALUES (" . implode(", ", $escapedData) . ")";

            // Execute the query
            if ($link->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $link->error;
            }
        }

        fclose($handle);
    }

    // Redirect to index.php after successful insertion
    header("Location: index.php");

    // Validate Company
    $input_name = trim($_POST["name"]);
    $name = empty($input_name) ? NULL : $input_name;

    // Validate Company
    $input_company = trim($_POST["company"]);
    $company = empty($input_company) ? NULL : $input_company;

    // Validate PhotoUrl
    $input_photoUrl = trim($_POST["photoUrl"]);
    $photoUrl = empty($input_photoUrl) ? NULL : $input_photoUrl;

    // Validate Calories
    $input_calories = trim($_POST["calories"]);
    $calories = empty($input_calories) ? NULL : $input_calories;

    // Validate Total Fat
    $input_total_fat = trim($_POST["total_fat"]);
    $total_fat = empty($input_total_fat) ? NULL : $input_total_fat;

    // Validate Saturated Fat
    $input_saturated_fat = trim($_POST["saturated_fat"]);
    $saturated_fat = empty($input_saturated_fat) ? NULL : $input_saturated_fat;

    // Validate Trans Fat
    $input_trans_fat = trim($_POST["trans_fat"]);
    $trans_fat = empty($input_trans_fat) ? NULL : $input_trans_fat;

    // Validate Cholesterol
    $input_cholesterol = trim($_POST["cholesterol"]);
    $cholesterol = empty($input_cholesterol) ? NULL : $input_cholesterol;

    // Validate Sodium
    $input_sodium = trim($_POST["sodium"]);
    $sodium = empty($input_sodium) ? NULL : $input_sodium;

    // Validate Total Carbohydrate
    $input_total_carbohydrate = trim($_POST["total_carbohydrate"]);
    $total_carbohydrate = empty($input_total_carbohydrate) ? NULL : $input_total_carbohydrate;

    // Validate Dietary Fiber
    $input_dietary_fiber = trim($_POST["dietary_fiber"]);
    $dietary_fiber = empty($input_dietary_fiber) ? NULL : $input_dietary_fiber;

    // Validate Dietary Fiber
    $input_sugar = trim($_POST["sugar"]);
    $sugar = empty($input_sugar) ? NULL : $input_sugar;

    // Validate Protein
    $input_protein = trim($_POST["protein"]);
    $protein = empty($input_protein) ? NULL : $input_protein;

    // Validate Calcium
    $input_calcium = trim($_POST["calcium"]);
    $calcium = empty($input_calcium) ? NULL : $input_calcium;

    // Validate Iron
    $input_iron = trim($_POST["iron"]);
    $iron = empty($input_iron) ? NULL : $input_iron;

    // Validate Vitamin A
    $input_vitamin_a = trim($_POST["vitamin_a"]);
    $vitamin_a = empty($input_vitamin_a) ? NULL : $input_vitamin_a;

    // Validate Vitamin C
    $input_vitamin_c = trim($_POST["vitamin_c"]);
    $vitamin_c = empty($input_vitamin_c) ? NULL : $input_vitamin_c;

    // Validate Vitamin D
    $input_vitamin_d = trim($_POST["vitamin_d"]);
    $vitamin_d = empty($input_vitamin_d) ? NULL : $input_vitamin_d;

    // Validate Vitamin D
    $input_nutrition_level = trim($_POST["nutrition_level"]);
    $nutrition_level = empty($input_nutrition_level) ? NULL : $input_nutrition_level;

    // Validate Barcode
    $input_barcode = trim($_POST["barcode"]);
    $barcode = empty($input_barcode) ? NULL : $input_barcode;

    // Check input errors before inserting into the database
    if (empty($name_err) && empty($company_err) && empty($photoUrl_err) && empty($calories_err) && empty($total_fat_err) && empty($saturated_fat_err) && empty($trans_fat_err) && empty($cholesterol_err) && empty($sodium_err) && empty($total_carbohydrate_err) && empty($dietary_fiber_err) && empty($protein_err) && empty($calcium_err) && empty($iron_err) && empty($vitamin_a_err) && empty($vitamin_c_err) && empty($vitamin_d_err) && empty($nutrition_level_err) && empty($barcode_err)) {
        // Prepare an insert statement for form input
        $sql = "INSERT INTO product (name, company, photoUrl, calories, total_fat, saturated_fat, trans_fat, cholesterol, sodium, total_carbohydrate, dietary_fiber, sugar, protein, calcium, iron, vitamin_a, vitamin_c, vitamin_d, nutrition_level, barcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($link, $sql);

        // Check if preparation was successful
        if ($stmt) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssssssssss", $name, $company, $photoUrl, $calories, $total_fat, $saturated_fat, $trans_fat, $cholesterol, $sodium, $total_carbohydrate, $dietary_fiber, $sugar, $protein, $calcium, $iron, $vitamin_a, $vitamin_c, $vitamin_d, $nutrition_level, $barcode);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to the landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($link);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product | Nutrifacts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
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
                        <h2>Tambah Product</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini kemudian submit untuk menambahkan data product ke dalam database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group ">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
        <span class="help-block"><?php echo $name_err; ?></span>
    </div>
    <div class="form-group">
        <label>Company</label>
        <input type="text" name="company" class="form-control" value="<?php echo $company; ?>">
        <span class="help-block"><?php echo $company_err; ?></span>
    </div>
    <div class="form-group ">
        <label>PhotoUrl</label>
        <input type="text" name="photoUrl" class="form-control" value="<?php echo $photoUrl; ?>">
        <span class="help-block"><?php echo $photoUrl_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Calories</label>
        <input type="text" name="calories" class="form-control" value="<?php echo $calories; ?>">
        <span class="help-block"><?php echo $calories_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Total Fat</label>
        <input type="text" name="total_fat" class="form-control" value="<?php echo $total_fat; ?>">
        <span class="help-block"><?php echo $total_fat_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Saturated Fat</label>
        <input type="text" name="saturated_fat" class="form-control" value="<?php echo $saturated_fat; ?>">
        <span class="help-block"><?php echo $saturated_fat_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Trans Fat</label>
        <input type="text" name="trans_fat" class="form-control" value="<?php echo $trans_fat; ?>">
        <span class="help-block"><?php echo $trans_fat_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Cholesterol</label>
        <input type="text" name="cholesterol" class="form-control" value="<?php echo $cholesterol; ?>">
        <span class="help-block"><?php echo $cholesterol_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Sodium</label>
        <input type="text" name="sodium" class="form-control" value="<?php echo $sodium; ?>">
        <span class="help-block"><?php echo $sodium_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Total Carbohydrate</label>
        <input type="text" name="total_carbohydrate" class="form-control" value="<?php echo $total_carbohydrate; ?>">
        <span class="help-block"><?php echo $total_carbohydrate_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Dietary Fiber</label>
        <input type="text" name="dietary_fiber" class="form-control" value="<?php echo $dietary_fiber; ?>">
        <span class="help-block"><?php echo $dietary_fiber_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Sugar</label>
        <input type="text" name="sugar" class="form-control" value="<?php echo $sugar; ?>">
        
    </div>
    <div class="form-group ">
        <label>Protein</label>
        <input type="text" name="protein" class="form-control" value="<?php echo $protein; ?>">
        <span class="help-block"><?php echo $protein_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Calcium</label>
        <input type="text" name="calcium" class="form-control" value="<?php echo $calcium; ?>">
        <span class="help-block"><?php echo $calcium_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Iron</label>
        <input type="text" name="iron" class="form-control" value="<?php echo $iron; ?>">
        <span class="help-block"><?php echo $iron_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Vitamin A</label>
        <input type="text" name="vitamin_a" class="form-control" value="<?php echo $vitamin_a; ?>">
        <span class="help-block"><?php echo $vitamin_a_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Vitamin C</label>
        <input type="text" name="vitamin_c" class="form-control" value="<?php echo $vitamin_c; ?>">
        <span class="help-block"><?php echo $vitamin_c_err; ?></span>
    </div>
    <div class="form-group ">
        <label>Vitamin D</label>
        <input type="text" name="vitamin_d" class="form-control" value="<?php echo $vitamin_d; ?>">
        <span class="help-block"><?php echo $vitamin_d_err; ?></span>
    </div> 
    <div class="form-group ">
        <label>Nutrition Level</label>
        <input type="text" name="nutrition_level" class="form-control" value="<?php echo $nutrition_level; ?>">
        <span class="help-block"><?php echo $nutrition_level_err; ?></span>
    </div> 
    <div class="form-group ">
        <label>Barcode</label>
        <input type="text" name="barcode" class="form-control" value="<?php echo $barcode; ?>">
        <span class="help-block"><?php echo $barcode_err; ?></span>
    </div>
    <div class="form-group">
        <label for="csvFile">ATAU Tambahkan data dari .CSV file</label>
        <input type="file" name="csvFile" id="csvFile" accept=".csv" class="form-control">
        <span class="help-block">Pastikan Kolom sudah benar</span>
    </div>
    <input type="submit" class="btn btn-primary" value="Submit" onclick="return confirm('Apakah anda yakin akan menambah data?');">
    <a href="index.php" class="btn btn-default">Cancel</a>
</form>


                    <br>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
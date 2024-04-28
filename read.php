<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM product WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
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
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Product | Nutrifacts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 800px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Detail Data Produk</h1>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td><?php echo $name; ?></td>
                            </tr>
                            <tr>
                                <th>Company</th>
                                <td><?php echo $company; ?></td>
                            </tr>
                            <tr>
                                <th>PhotoUrl</th>
                                <td><?php echo $photoUrl; ?></td>
                            </tr>
                            <tr>
                                <th>Calories</th>
                                <td><?php echo $calories; ?></td>
                            </tr>
                            <tr>
                                <th>Total Fat</th>
                                <td><?php echo $total_fat; ?></td>
                            </tr>
                            <tr>
                                <th>Saturated Fat</th>
                                <td><?php echo $saturated_fat; ?></td>
                            </tr>
                            <tr>
                                <th>Trans Fat</th>
                                <td><?php echo $trans_fat; ?></td>
                            </tr>
                            <tr>
                                <th>Cholesterol</th>
                                <td><?php echo $cholesterol; ?></td>
                            </tr>
                            <tr>
                                <th>Sodium</th>
                                <td><?php echo $sodium; ?></td>
                            </tr>
                            <tr>
                                <th>Total Carbohydrate</th>
                                <td><?php echo $total_carbohydrate; ?></td>
                            </tr>
                            <tr>
                                <th>Dietary Fiber</th>
                                <td><?php echo $dietary_fiber; ?></td>
                            </tr>
                            <tr>
                                <th>Sugar</th>
                                <td><?php echo $sugar; ?></td>
                            </tr>
                            <tr>
                                <th>Protein</th>
                                <td><?php echo $protein; ?></td>
                            </tr>
                            <tr>
                                <th>Calcium</th>
                                <td><?php echo $calcium; ?></td>
                            </tr>
                            <tr>
                                <th>Iron</th>
                                <td><?php echo $iron; ?></td>
                            </tr>
                            <tr>
                                <th>Vitamin A</th>
                                <td><?php echo $vitamin_a; ?></td>
                            </tr>
                            <tr>
                                <th>Vitamin C</th>
                                <td><?php echo $vitamin_c; ?></td>
                            </tr>
                            <tr>
                                <th>Vitamin D</th>
                                <td><?php echo $vitamin_d; ?></td>
                            </tr>
                            <tr>
                                <th>Nutrition Level</th>
                                <td><?php echo $nutrition_level; ?></td>
                            </tr>
                            <tr>
                                <th>Barcode</th>
                                <td><?php echo $barcode; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="text-right"><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div><br>
    </div>
</body>

</html>

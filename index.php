<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product | Nutrifacts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 80%;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Product Nutrifacts</h2>
                        <a href="create.php" class="btn btn-success pull-right">Tambah Baru</a>
                    </div>
                    <div class="table-responsive">
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                   // Attempt select query execution
                   $sql = "SELECT * FROM product";
                   if($result = mysqli_query($link, $sql)){
                       if(mysqli_num_rows($result) > 0){
                           echo "<table class='table table-bordered table-striped'>";
                               echo "<thead>";
                                   echo "<tr>";
                                       echo "<th></th>";
                                       echo "<th>ID</th>";
                                       echo "<th>Name</th>";
                                       echo "<th>Company</th>";
                                       echo "<th>PhotoUrl</th>";
                                       echo "<th>Calories</th>";
                                       echo "<th>Total Fat</th>";
                                       echo "<th>Saturated Fat</th>";
                                       echo "<th>Trans Fat</th>";
                                       echo "<th>Cholesterol</th>";
                                       echo "<th>Sodium</th>";
                                       echo "<th>Total Carbohydrate</th>";
                                       echo "<th>Dietary Fiber</th>";
                                       echo "<th>Sugar</th>";
                                       echo "<th>Protein</th>";
                                       echo "<th>Calcium</th>";
                                       echo "<th>Iron</th>";
                                       echo "<th>Vitamin A</th>";
                                       echo "<th>Vitamin C</th>";
                                       echo "<th>Vitamin D</th>";
                                       echo "<th>Nutirition Level</th>";
                                       echo "<th>Barcode</th>";

                                   echo "</tr>";
                               echo "</thead>";
                               echo "<tbody>";
                               while($row = mysqli_fetch_array($result)){
                                   echo "<tr>";
                                   echo "<td>";
                                       echo "<a href='read.php?id=". $row['id'] ."' title='Lihat detail product' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                           echo "<a href='update.php?id=". $row['id'] ."' title='Update Product' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                           echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Product' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                       echo "</td>";
                                       echo "<td>" . $row['id'] . "</td>";
                                       echo "<td>" . $row['name'] . "</td>";
                                       echo "<td>" . $row['company'] . "</td>";
                                       echo "<td>" . $row['photoUrl'] . "</td>";
                                       echo "<td>" . $row['calories'] . "</td>";
                                       echo "<td>" . $row['total_fat'] . "</td>";
                                       echo "<td>" . $row['saturated_fat'] . "</td>";
                                       echo "<td>" . $row['trans_fat'] . "</td>";
                                       echo "<td>" . $row['cholesterol'] . "</td>";
                                       echo "<td>" . $row['sodium'] . "</td>";
                                       echo "<td>" . $row['total_carbohydrate'] . "</td>";
                                       echo "<td>" . $row['dietary_fiber'] . "</td>";
                                       echo "<td>" . $row['sugar'] . "</td>";
                                       echo "<td>" . $row['protein'] . "</td>";
                                       echo "<td>" . $row['calcium'] . "</td>";
                                       echo "<td>" . $row['iron'] . "</td>";
                                       echo "<td>" . $row['vitamin_a'] . "</td>";
                                       echo "<td>" . $row['vitamin_c'] . "</td>";
                                       echo "<td>" . $row['vitamin_d'] . "</td>";
                                       echo "<td>" . $row['nutrition_level'] . "</td>";
                                       echo "<td>" . $row['barcode'] . "</td>";
                                   echo "</tr>";
                               }
                               echo "</tbody>";
                           echo "</table>";
                           // Free result set
                           mysqli_free_result($result);
                       } else{
                           echo "<p class='lead'><em>No records were found.</em></p>";
                       }
                   } else{
                       echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                   }

                   // Close connection
                   mysqli_close($link);
                   ?>
                   

                </div>
                <br><br><br><br>
            </div>
        </div>
    </div>
</body>
</html>
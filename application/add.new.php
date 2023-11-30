<?php
    include "db_conn.php";

    if (isset($_POST['submit'])) {
        $ID = $_POST['id'];
        $Full_name = $_POST['full_name'];
        $Age = $_POST['age'];
        $Address = $_POST['address'];

        $sql = "INSERT INTO `crud`(`id`, `full_name`, `age`, `address`) VALUES (NULL, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Check for prepare error
        if (!$stmt) {
            die("Error in SQL statement: " . mysqli_error($conn));
        }

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sss", $Full_name, $Age, $Address);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        // Check for execute success
        if ($result) {
            echo "Record added successfully!";
        } else {
            die("Error in SQL statement: " . mysqli_error($conn));
        }

        // Close the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <title>PHP CRUD APPLICATION</title>
        </head>
        <body>
            <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
                PHP Complete CRUD Application
            </nav>
            
        <div class="container">
            <div class="text-center mb-4">
                <h3>Add New</h3>
                <p class="text-muted">Complete the form below to add a new user</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width:50vm; min: width 300px;">
                    <div class="row">
                        <div class="col-md-9">
                        <label class="form-label">ID</label>
                            <input type="int" class="form-control" name="id"  placeholder="Enter your ID">
                        </div>
                        
                            <div class="col-md-9">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="full_name"  placeholder="Enter your Full Name">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <input type="int" class="form-control" name="age"  placeholder="Enter your age">
                            </div>

                            <div class="col-md-9">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address"  placeholder="Enter your address">
                            </div>
                    </div>
                            <br>
                            </br>
                        <div>
                            <button type="submit" class="btn btn-success" name="submit">Save</button>
                            <a href="index.php" class="btn btn-danger">Cancel</a>
                        </div>
                </form>
            </div>
        </div>

        <!-- bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </body>
</html>
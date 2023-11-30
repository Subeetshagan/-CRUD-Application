<?php
        include "db_conn.php";

        $id = $_GET['id'];

        // Function to sanitize user input
        function sanitize_input($input)
        {
            return htmlspecialchars(strip_tags($input));
        }

        // Update operation
        if (isset($_POST['submit'])) {
            $Full_name = sanitize_input($_POST['full_name']);
            $Age = sanitize_input($_POST['age']);
            $Address = sanitize_input($_POST['address']);

            $sql = "UPDATE `crud` SET `full_name`=?, `age`=?, `address`=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);

            // Check for prepare error
            if (!$stmt) {
                die("Error in SQL statement: " . mysqli_error($conn));
            }

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sssi", $Full_name, $Age, $Address, $id);

            // Execute the statement
            $result = mysqli_stmt_execute($stmt);

            // Check for execute success
            if ($result) {
                header("Location: index.php?msg=Record updated successfully");
                exit();
            } else {
                echo "Failed: " . mysqli_error($conn);
            }

            // Close the statement (not the connection)
            mysqli_stmt_close($stmt);
        }

        // Fetch operation
        $sql = "SELECT * FROM `crud` WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
        } else {
            die("Error in SQL statement: " . mysqli_error($conn));
        }

        // Close the connection after fetching data
        mysqli_close($conn);
?>

<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
            <!-- Bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
            <title>Edit User Information</title>
        </head>
        <body>
            <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
                PHP Complete CRUD Application
            </nav>
            
            <div class="container">
                <div class="text-center mb-4">
                    <h3>Edit User Information</h3>
                    <p class="text-muted">Click Update after changing any information</p>
                </div>

                <div class="container d-flex justify-content-center">
                    <form action="" method="post" style="width:50vw; min-width: 300px;">
                        <div class="row">
                            <div class="col-md-9">
                                <label class="form-label">ID</label>
                                <input type="text" class="form-control" name="id" value="<?php echo $row['id']; ?>" readonly>
                            </div>

                            <div class="col-md-9">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="full_name" value="<?php echo $row['full_name']; ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <input type="text" class="form-control" name="age" value="<?php echo $row['age']; ?>">
                            </div>

                            <div class="col-md-9">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>">
                            </div>
                        </div>
                        <br>
                        <div>
                            <button type="submit" class="btn btn-success" name="submit">Update</button>
                            <a href="index.php" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bootstrap -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </body>
</html>

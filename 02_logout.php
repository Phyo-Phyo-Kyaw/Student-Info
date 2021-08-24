<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body class="bg-dark text-white">
    <?php
        $conn = new mysqli('localhost' , 'root','','mydb') or die ('unenable to connect');
        $sql = "DELETE FROM StudentInfo";

        if ($conn->query($sql) === TRUE) {
          echo "Record deleted successfully";
        } else {
          echo "Error deleting record: " . $conn->error;
        }
    
        $conn->close();
    ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <a href="01_login.php">
                        <button class="btn btn-info text-center w-100">Login</button>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="03_register.php">
                        <button class="btn btn-secondary text-center w-100">Rgister</button>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="02_logout.php">
                        <button class="btn btn-success text-center w-100">Logout</button>
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-dark shadow-1-strong">
                    <div class="card-body">
                        <h3 class="text-center text-white p-3">Logout Successful</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    
</script>
</html>
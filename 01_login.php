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
        $result="";
        if(isset($_POST['login'])) {
            $email = $_POST ['email'] ;
            $password = $_POST ['password'] ;
            // $password = password_hash($password , PASSWORD_BCRYPT) ;
            $conn = new mysqli('localhost' , 'root','','mydb') or die ('unenable to connect');
            $sql = "SELECT * FROM StudentInfo 
            WHERE email = '$email'
            AND pass = '$password' ;";
            $result = $conn->query($sql);
   
               if ($result->num_rows > 0) {
                 // output data of each row
                   while($row = $result->fetch_assoc()) {
                    echo " id: " . $row["id"]. " - Name: " . $row["stuname"]. " - Roll No: " . $row["rollno"] . "password :  "
                    . $row["pass"] . "<br>" ;
            
                 }
               } else {
                 echo "0 results";
               } 
     
            $conn->close();
        }
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
                <form method="POST">
                    <div class="card bg-dark shadow-1-strong">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="email" class="form-control" placeholder="example@gmail.com" name="email">
                            </div>

                            <div class="mb-3">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control">
                                    <i class="bi bi-eye-slash" id="togglePassword" class="form-control"></i>
                                </div>
                            </div>
                            
                            <div class="mb-3" style="text-align: center;">
                                
                                    <input type="submit" value="Login" class="btn btn-info" name="login">
                                
                            </div>
                            
                            <!-- <p> 11</p> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('bi-eye');
    });
</script>
</html>
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
    function checkPassword($password){
        //$password = $_POST['password'];

        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
         return false;
        } else {
         return true;
        }
  }
       $comError = "";
       $nameErr = $emailErr = $rollErr = $passwordErr = $error ="" ;
       if(isset($_POST['register'])) {
        

           $name = $_POST['username'] ;
           $email = $_POST['email'] ;
           $rollNo = $_POST['rno'] ;
           $password = $_POST['password'] ;
           $comfirmPassword = $_POST['comfirmPassword'] ;

        if(($name == "" && $rollNo == "" && $email == "" && $password == "") || (empty($name) && empty($email) && empty($rollNo) && empty($password))) {
            $nameErr = "Name is required";
            $rollErr = "Roll Number is required";
            $email = "Email is required" ;
            $passwordErr = "Password is required";
            echo "Failed!";
      }else {
        $name = $_POST['username'] ;
        $email = $_POST['email'] ;
        $rollNo = $_POST['rno'] ;
        $password = $_POST['password'] ;
        $error = "";
        
        //db create
        $conn = new mysqli('localhost' , 'root','','mydb') or die ('unenable to connect');
        //table create
        $sql = "CREATE TABLE StudentInfo (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            stuname VARCHAR(30) NOT NULL,
            rollno VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            pass VARCHAR(50) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
        if($password == $comfirmPassword) {
            $status = checkPassword($password);
                          
              if($status) {
                    //data insert   
                    // $password = password_hash($password , PASSWORD_BCRYPT) ;                        
                    $insertStudent = "INSERT INTO StudentInfo (stuname, rollno , email , pass)
                       VALUES ('$name' , '$rollNo' ,'$email' , '$password')";
                   /*  $insertStudent = "INSERT INTO StudentInfo (stuname, rollno , email , pass)
                    VALUES ('Reba' , '1CST-1' ,'reba@gmail.com' , 'Reba1234@')"; */

                       if ($conn->query($insertStudent) === TRUE) {
                         echo "New record created successfully<br>";
                       } else {
                         echo "Error: " . $insertStudent . "<br>" . $conn->error;
                       }

                               
                            
              }else {
                    $error = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character";
              }
        } else {
              $comError = "Password not same" ;
        }
        //data select             
        /* $sql1 = "SELECT id, stuname, rollno , pass FROM StudentInfo";
           $result = $conn->query($sql1);
   
           if ($result->num_rows > 0) {
             // output data of each row
             while($row = $result->fetch_assoc()) {
               echo " id: " . $row["id"]. " - Name: " . $row["stuname"]. " - Roll No: " . $row["rollno"] . "password :  " . $row["pass"] . "<br>" ;
            
             }
           } else {
             echo "0 results";
           } */
     
             $conn->close();
        }
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
                            <span class="text-danger" >*required field</span> 
                            <div class="mb-3">
                                <label for="">Name</label>
                                <span class="text-danger" >
                                      * <?php echo $nameErr; ?>
                                 </span>
                                <input type="text" class="form-control" placeholder="Enter Your Name" name="username">
                                
                            </div>

                            <div class="mb-3">
                                <label for="">Roll No</label>
                                <span class="text-danger" >
                                      * <?php echo $rollErr; ?>
                                 </span>
                                <input type="text" class="form-control" placeholder="eg 4CS-1" name="rno">
                                
                            </div>

                            <div class="mb-3">
                                <label for="">Email</label>
                                <span class="text-danger" >
                                      * <?php echo $emailErr; ?>
                                 </span>
                                <input type="email" class="form-control" placeholder="example@gmail.com" name="email">
                                
                            </div>

                            <div class="mb-3">
                                <label for="password">Password</label>
                                <span class="text-danger" >
                                    * <?php echo $passwordErr; ?></span>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control">
                                    <i class="bi bi-eye-slash" id="togglePassword" class="form-control"></i>
                                </div>
                                <small class="text-danger disable" name="error"><?php echo $error; ?></small>
                            </div>

                            <div class="mb-3">
                                <label for="password">Comfirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="comfirmPassword" id="comfirmPassword" class="form-control">
                                    <i class="bi bi-eye-slash" id="togglePassword1" class="form-control"></i>
                                    <small class="text-danger disable" name=""><?php echo $comError; ?></small>
                                </div>
                            </div>
                            
                            <div class="mb-3" style="text-align: center;">
                                
                                    <input type="submit" value="Register" class="btn btn-info" name="register">

                                
                            </div>
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
    const togglePassword1 = document.querySelector('#togglePassword1');
    const comfirmPassword = document.querySelector('#comfirmPassword');
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('bi-eye');

        
    });

    togglePassword1.addEventListener('click', function (e) {
       //toogle the type attribute
        const type1 = comfirmpassword.getAttribute('type') === 'password' ? 'text' : 'password';
        comfirmPassword.setAttribute('type', type1);
        // toggle the eye / eye slash icon
        this.classList.toggle('bi-eye');
    });
</script>
</html>
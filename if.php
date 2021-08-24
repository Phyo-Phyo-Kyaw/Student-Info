<?php

            
$nameErr = $emailErr = $rollErr = $passwordErr ="" ;
if(isset($_POST['register'])){
      $name = $_POST['username'] ;
      $email = $_POST['email'] ;
      $rollNo = $_POST['rno'] ;
      $password = $_POST['password'] ;
      $comfirmPassword = $_POST['comfirmPassword'] ;
      var_dump($name) ;
      echo  "   yy <br>";
      if($name == "" && $rollNo == "" && $email == "" && $password == "") {
            /* $nameErr = "Name is required";
            $rollErr = "Roll Number is required";
            $email = "Email is required" ;
            $passwordErr = "Password is required"; */
            echo "Failed!";
      }else {
        $name = $_POST['username'] ;
        $email = $_POST['email'] ;
        $rollNo = $_POST['rno'] ;
        $password = $_POST['password'] ;
        echo $name . " aa<br>";
        $conn = new mysqli('localhost' , 'root','','mydb') or die ('unenable to connect');
        if(!$conn){
            echo "Connection Failed!";
        }else {
            echo "Connection Success <br>" ;
        }
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
                    // echo "Success" ;
                         

                          

                    /* if ($conn->query($sql) === TRUE) {
                        echo "Table MyGuests created successfully";
                    } else {
                        echo "Error creating table: <br>" . $conn->error;
                    } */
                    /* $name = $_POST['name'] ;
                    $email = $_POST['email'] ;
                    $rollNo = $_POST['rno'] ;
                    $password = $_POST['password'] ; */
                         
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
                    echo "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character";
              }
        } else {
              echo "Password not same" ;
        }
                   
        $sql1 = "SELECT id, stuname, rollno FROM StudentInfo";
           $result = $conn->query($sql1);
 
           if ($result->num_rows > 0) {
             // output data of each row
             while($row = $result->fetch_assoc()) {
               echo "id: " . $row["id"]. " - Name: " . $row["stuname"]. " - Roll No: " . $row["rollno"]. "<br>";
             }
           } else {
             echo "0 results";
           }
   
             $conn->close();
      }

}
?>
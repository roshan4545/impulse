<?php 
        if(isset($_POST['submit']))
        {
            require "./personalconfig.php";
            try {


                $conn = new PDO($dsn,$username,$password,$options);


                $newuser = array(
                    "name"=>$_POST['name'],
                    "uname"=>$_POST['uname'],
                    "pwd"=>$_POST['pwd']
                );


                $sql = sprintf(
                    "INSERT INTO %s (%s) values (%s)",
                    "register",
                    implode(", ", array_keys($newuser)),
                    ":" . implode(", :", array_keys($newuser))
            );

            $statement = $conn->prepare($sql);
            $statement->execute($newuser);

            }  catch(PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }
            ?>
            <?php 
            echo 'registration successful';
        }
?>

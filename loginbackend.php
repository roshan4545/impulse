<?php 

if(isset($_POST['submit']))
 {
     require "./personalconfig.php";
     try {


        $conn = new PDO($dsn,$username,$password,$options);

        $uname=$_POST['uname'];
        
        $pwd=$_POST['pwd'];

        $sql = "SELECT * FROM register WHERE uname='$uname' And pwd='$pwd'";

        $statement1 = $conn->prepare($sql);
        
        $statement1->execute();

        $result1 = $statement1->fetchAll();

        if($result1 && $statement1->rowCount() <= 0)
        {
            echo "check the username and password";
        }
        else
        {
            $tempsql = "SELECT * FROM videos";

            $statement2 = $conn->prepare($tempsql);

            $statement2->execute();

            $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);

            foreach($result2 as $row)
            {
                echo $row['content'];
                ?>
                <video width = "300" height = "200" controls>
                    <source src = "<?php echo $row['location']?>" type = "video/mp4" >
                </video>
                <br><br>
                <?php
            }

        }
     }  catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

 }

 ?>
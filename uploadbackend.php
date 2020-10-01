<?php

    if(isset($_POST['submit']))
    {
        include "./personalconfig.php";

        try{

            $maxsize = 2000000000;
            $conn = new PDO($dsn,$username,$password,$options);

            $content = $_POST['content'];
            $location = $_FILES['file']['name'];
            $target_dir = "videos/";
            $target_file = $target_dir . $_FILES["file"]["name"];
            $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if($videoFileType == "mp4" or $videoFileType == "mkv")
            {
                if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                    echo "File too large. File must be less than 1000MB.";
                }
                else{
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
                        // Insert record
                        $sql = "INSERT INTO videos(content,location) VALUES('$content','$target_file')";
                        $statement = $conn->prepare($sql);
                        $statement->execute();
                        echo "Upload successfully.";
                      }
                }
            }
            else
            {
                echo "only mp4 is allowed";
            }
        }
        catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

?>
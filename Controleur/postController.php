
<?php 

require_once("../Model/postClass.php");
$action = $_GET["action"] ?? null;

switch ($action) {
    case "post":
        $id = $_GET["idPoster"] ?? null;
        if (isset($_POST["titre"]) && isset($_POST["contenu"])) {
            $contenu = $_POST["contenu"];
            $titre = $_POST["titre"];
            if (!empty($_FILES["img"]["tmp_name"])) {
                $dir = "../user/postImg/";
                $dirName = rand(0, 1000000000000);
                mkdir($dir . $dirName);
                $target_file = $dir .  $dirName . '/' . basename($_FILES["img"]["name"]) ;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES["img"]["tmp_name"]);
                if ($check !== false) { 
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                if ($_FILES["img"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        $post = Post::setPost(new Post($id, $titre, $contenu, true, "/SAE/user/postImg/" . $dirName . '/' . basename($_FILES["img"]["name"])));
                        header("Location: ../Vue/html/listePost.php");

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                var_dump($id);
                $post = Post::setPost(new Post($id, $titre, $contenu, false, ""));
                header("Location: ../Vue/html/listePost.php");
            }   
        }
        break;

        
    default:
        break;
}


?>
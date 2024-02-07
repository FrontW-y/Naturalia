<?php



require_once('ModelClass.php');

class Post
{

    private int $posterId = 0;
    private string $titre = "";
    private string $corps = "";
    private bool $hasImage = false;
    private string $imagePath = "";

    public function __construct(int $posterId, string $titre, string $corps, bool $hasImage, string $imagePath)
    {
        $this->posterId = $posterId;
        $this->titre = $titre;
        $this->corps = $corps;
        $this->hasImage = $hasImage;
        $this->imagePath = $imagePath;
    }

    public static function setPost(Post $post): bool
    {
        $pdo = Model::getPdo();
        $values = ["posterId" => $post->posterId, "titre" => $post->titre, "corps" => $post->corps, "hasImage" => $post->hasImage, "imagePath" => $post->imagePath];
        $stmt = "INSERT INTO post (posterId, postTitre, postCorps, hasImg, imgPath) VALUES (:posterId, :titre, :corps, :hasImage, :imagePath)";
        $stmt = $pdo->prepare($stmt);
        return $stmt->execute($values);
    }

    public static function getUserPosts(int $posterId): array {

        $pdo = Model::getPdo();
        $stmt = "SELECT post.idPost, post.PostTitre, users.Username FROM post INNER JOIN users  ON post.posterId = users.UUID WHERE posterId = :posterId";
        $stmt = $pdo->prepare($stmt);
        $stmt->bindParam(":posterId", $posterId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(); 
    }

    public static function getllPostView(): array {

        $pdo = Model::getPdo();
        $stmt = "SELECT post.idPost, post.postTitre, users.username FROM post INNER JOIN users ON post.posterId = users.UUID;";
        $stmt = $pdo->prepare($stmt);
        $stmt->execute();
        return $stmt->fetchAll(); 
    }

    public static function getPost(int $postId): array {

        $pdo = Model::getPdo();
        $stmt = "SELECT post.idPost, post.postTitre, post.PostCorps,users.username, post.hasImg, post.imgPath FROM post INNER JOIN users ON post.posterId = users.UUID WHERE idPost = :postId";
        $stmt = $pdo->prepare($stmt);
        $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(); 
    }

}





?>
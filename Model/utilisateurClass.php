<?php

require_once "ModelClass.php";
class Utilisateur
{

    private static Utilisateur | null $utilisateur = null;

    public static function getCurrentUser() : Utilisateur{
        if (static::$utilisateur === null) {
            return static::$utilisateur = static::getUserToken($_COOKIE['token']);
        }
        return static::$utilisateur;
    }
    
    private string $id = "";
    private string $username = "";
    private string $email = "";
    private string $fName = "";
    private string $lName = "";
    private string $dateNaissance = "";
    private string $dateInscription = "";
    private string $pfpPath = "";


    public function __construct($id,$username, $email, $fName, $lName, $dateNaissance, $dateInscription, $pfpPath)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->fName = $fName;
        $this->lName = $lName;
        $this->dateNaissance = $dateNaissance;
        $this->dateInscription = $dateInscription;
        $this->pfpPath = $pfpPath;
    }

    private static function generateRandomToken($length = 64, $login) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
    
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[random_int(0, strlen($characters) - 1)];
        }
    
        $pdo = Model::getPdo();
        $stmt = $pdo->prepare("UPDATE `users` SET token = :token WHERE login = :login");
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
        setcookie('token', $token, time() + time() + (3600 * 24 * 365),'/');
        return $token;
    }

    public static function getUserToken($token): Utilisateur | null
    {
        try {
        $pdo = Model::getPdo();
        $stmt = "SELECT UUID, username, login, fName, lName, birth, creationDate FROM users WHERE token = :token";
        $stmt = $pdo->prepare($stmt);
        $stmt->bindParam(":token", $token, PDO::PARAM_STR);
    
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Utilisateur($data["UUID"],$data["username"], $data["login"], $data["fName"], $data["lName"], $data["birth"], $data["creationDate"], "");}
        catch (PDOException $e) {
            header("Location: ../Vue/html/connexion.php");
            return null;
        }
    }

    private static function checkValidity($username, $email): string
    {
        $pdo = Model::getPdo();
        $stmt = "SELECT username, login FROM users WHERE username = :username OR login = :email";
        $stmt = $pdo->prepare($stmt);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data) > 0) {
            if ($data[0]["username"] == $username) {
                return "username";
            } else {
                return "email";
            }
        } else {
            return "valid";
        }
    }

    public static function insertUser($username, $email, $password ,$fName, $lName, $dateNaissance): bool
    {
        if (self::checkValidity($username, $email) === "valid") {
            $pdo = Model::getPdo();
            $stmt = "INSERT INTO users (username, login, passwd, fName, lName, birth, creationDate, creationTime) VALUES (:username, :email, :password ,:fName, :lName, :dateNaissance, CURDATE(), CURTIME())";
            $stmt = $pdo->prepare($stmt);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":fName", $fName, PDO::PARAM_STR);
            $stmt->bindParam(":lName", $lName, PDO::PARAM_STR);
            $stmt->bindParam(":dateNaissance", $dateNaissance, PDO::PARAM_STR);
            return $stmt->execute() ? true : false;
        } else if (self::checkValidity($username, $email) === "username") {
            $_SERVER['INSCRIPTION_ERROR'] = ["username" => "Ce nom d'utilisateur est déjà pris."];
            return false;
        } else if (self::checkValidity($username, $email) === "email") {
            $_SERVER['INSCRIPTION_ERROR'] = ["email" => "Cette adresse email est déjà utilisée."];
            return false;
        } else {
            return false;
        }
    }

    public static function getUser($login, $passwd): Utilisateur|null
    {

        $pdo = Model::getPdo();
        $stmt = $pdo->prepare("SELECT passwd FROM `users` WHERE (login = ?)");
        $stmt->bindParam(1, $login, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (count($data) > 0) {
            if (password_verify($passwd, $data['passwd'])) {
                $stmt = "SELECT UUID, username, login, fName, lName, birth, creationDate FROM users WHERE login = :login";
                $stmt = $pdo->prepare($stmt);
                $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                $stmt->execute();
                $data = $stmt->fetch();
                var_dump($data);

                self::generateRandomToken(64, $login);
                return new Utilisateur($data["UUID"], $data["username"], $data["login"], $data["fName"], $data["lName"], $data["birth"], $data["creationDate"], "");
            } else {
                return null;
            }
        } else {
            return null;
        }

    }

    public static function createPassWd () : string
    {
        $alphabet = "azertyuiopqsdfghjklmwxcvbn";
        $upperCase = "AZERTYUIOPQSDFGHJKLMWXCVBN";
        $number = "1234567890";
        $longueurAlpha = 26;
        $longueurNums = 10;
        $nouveauPassWd = '';

        for ($i = 0; $i < 8; $i++) {
            $nouveauPassWd .= $alphabet[rand(0, $longueurAlpha - 1)];
            $nouveauPassWd .= $upperCase[rand(0, $longueurAlpha - 1)];
            $nouveauPassWd .= $number[rand(0, $longueurNums - 1)];
        }
        $nouveauPassWd = str_shuffle($nouveauPassWd);

        return $nouveauPassWd;
    }

    public static function setPassWd($nouveauPassWd, $mail) : bool {
        $hash = password_hash($nouveauPassWd, PASSWORD_DEFAULT);
        $pdo = Model::getPdo();
        $stmt = $pdo->prepare("UPDATE `users` SET passwd = ? where login = ?");
        $stmt->bindParam(1, $hash, PDO::PARAM_STR);
        $stmt->bindParam(2, $mail, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (PDOException $e){echo $e->getMessage(); return false;}
        return true;
    }
    
    public function getFriend(){
        $pdo = Model::getPdo();
        $stmt = $pdo->prepare("SELECT DISTINCT users.UUID, users.username FROM friend INNER JOIN users ON userUn = :id where users.UUID not like userUn;");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function addFriend($username){
        $pdo = Model::getPdo();
        $stmt = $pdo->prepare("SELECT UUID FROM `users` WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch();
        $friendId = $data["UUID"];
        $stmt = $pdo->prepare("INSERT INTO `friend` (`userUn`, `userDeux`) VALUES (:UUID, :friendId)");
        $stmt->bindParam(':UUID', $this->id, PDO::PARAM_STR);
        $stmt->bindParam(':friendId', $friendId, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getFriendDetails($username){
        $pdo = Model::getPdo();
        $stmt = $pdo->prepare("SELECT UUID, username, login, fName, lName, birth, creationDate FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

    

    public function getSelfInfo() : array{
        $arrayUser = [
            "id" => $this->id,
            "username" => $this->username,
            "email" => $this->email,
            "fName" => $this->fName,
            "lName" => $this->lName,
            "dateNaissance" => $this->dateNaissance,
            "dateInscription" => $this->dateInscription,
            "pfpPath" => $this->pfpPath
        ];
        
        return $arrayUser;
    }

    public function getId() : string {
        return $this->id;
    }
    
    


}




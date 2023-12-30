<?php
include_once "db.php";
session_start();
class UserModel
{
    private $db;
    function __construct()
    {
        $this->db = new Db();
    }

    public function register($email, $password, $image, $user_status)
    {
        if ($this->check_email($email) == 0) {
            $sql = "INSERT INTO users (user_email, user_password,user_image_data,user_status,user_verifly) VALUES ('$email','$password','$image','$user_status',NULL)";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->execute();
            return json_encode(["status" => "success", "msg" => "success"]);
        } else {
            return json_encode(["status" => 0, "msg" => "อีเมลนี้มีผู้ใช้งานแล้ว"]);
        }
    }

    public function getUser()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function check_email($email)
    {
        $sql = "SELECT * FROM users WHERE user_email = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->rowCount();
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE user_email = ? AND user_password = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$email, $password]);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $user = $stmt->fetch();
            $this->set_cookie($user);
            if($user['user_status'] == 1){
                return json_encode(["status" => "success", "msg" => "success",'role' => 'admin']);
            }else{
                return json_encode(["status" => "success", "msg" => "success",'role' => 'user']);
            }
        } else {
            return json_encode(["status" => "error", "msg" => "email or password incorrect"]);
        }
    }

    private function set_cookie($datauser)
    {
        $key = 'kamenrider123456';
        $data = ['user_email' => $datauser['user_email'], 'user_password' => $datauser['user_password']];
        $cipherText = openssl_encrypt(json_encode($data), 'aes-256-cbc', $key, 0, $key);
        setcookie('login', $cipherText, time() + 3600, '/'); // 1 hour
    }

    public function get_cookie($datauser)
    {
        $key = "kamenrider123456";
        $encryptedData = isset($_COOKIE['login']) ? $_COOKIE['login'] : '';
        $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $key);
        $data_de = json_decode($decryptedData, true);
        $data_email = $this->get_user_by_email($data_de['user_email']);
        $_SESSION['user_id'] = $data_email['user_id'];
        $_SESSION['user_email'] = $data_email['user_email'];
        $_SESSION['user_image_data'] = $data_email['user_image_data'];
        $_SESSION['user_status'] = $data_email['user_status'];
    }

    public function get_user_by_email($email)
    {
        $sql = "SELECT * FROM users WHERE user_email = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function sign_out(){
        setcookie('login', '', time() - 3600, '/');
        session_destroy();
        header('location: ../index.php');
    }

    public function user_verifly($email,$codenumber)
    {
        $sql = "UPDATE users SET user_verifly = $codenumber WHERE user_email = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$email]);
    }

    public function check_verifly($email,$codenumber)
    {
        $sql = "SELECT * FROM users WHERE user_email = ? AND user_verifly = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$email,$codenumber]);
        $count = $stmt->rowCount();
        if ($count > 0) {
            return json_encode(["status" => "success", "msg" => "success"]);
        } else {
            return json_encode(["status" => "error", "msg" => "email or password incorrect"]);
        }
    }

    public function newpassword($email,$password)
    {
        $sql = "UPDATE users SET user_password = ? WHERE user_email = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$password,$email]);
        //check execute 
        if($stmt){
            $sql = "UPDATE users SET user_verifly = NULL WHERE user_email = ?";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->execute([$email]);
            unset($_SESSION['user_emailverifly']);
            return json_encode(["status" => "success", "msg" => "success"]);
        }else{
            return json_encode(["status" => "error", "msg" => "email or password incorrect"]);
        }
    }
}

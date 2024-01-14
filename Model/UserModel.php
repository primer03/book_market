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
            if ($stmt) {
                $sql1 = "SELECT *FROM users ORDER BY user_id DESC LIMIT 1";
                $stmt1 = $this->db->connect()->prepare($sql1);
                $stmt1->execute();
                $result = $stmt1->fetch(PDO::FETCH_ASSOC);
                return json_encode(["status" => 'success', "msg" => "สมัครสมาชิกเรียบร้อยแล้ว", "user_id" => $result['user_id']]);
            } else {
                return json_encode(["status" => 'error', "msg" => "สมัครสมาชิกไม่สำเร็จ"]);
            }
        } else {
            return json_encode(["status" => 0, "msg" => "อีเมลนี้มีผู้ใช้งานแล้ว"]);
        }
    }

    public function getUser()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            if ($user['user_status'] == 1) {
                return json_encode(["status" => "success", "msg" => "success", 'role' => 'admin']);
            } else {
                return json_encode(["status" => "success", "msg" => "success", 'role' => 'user']);
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
        if ($data_email != 0) {
            $_SESSION['user_id'] = $data_email['user_id'];
            $_SESSION['user_email'] = $data_email['user_email'];
            $_SESSION['user_image_data'] = $data_email['user_image_data'];
            $_SESSION['user_status'] = $data_email['user_status'];
            return true;
        } else {
            return false;
        }
    }

    public function get_user_by_email($email)
    {
        $sql = "SELECT * FROM users WHERE user_email = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$email]);
        $cout = $stmt->rowCount();
        if ($cout > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function sign_out()
    {
        setcookie('login', '', time() - 3600, '/');
        session_destroy();
        header('location: ../index.php');
    }

    public function user_verifly($email, $codenumber)
    {
        $sql = "UPDATE users SET user_verifly = $codenumber WHERE user_email = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$email]);
    }

    public function check_verifly($email, $codenumber)
    {
        $sql = "SELECT * FROM users WHERE user_email = ? AND user_verifly = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$email, $codenumber]);
        $count = $stmt->rowCount();
        if ($count > 0) {
            return json_encode(["status" => "success", "msg" => "success"]);
        } else {
            return json_encode(["status" => "error", "msg" => "email or password incorrect"]);
        }
    }

    public function newpassword($email, $password)
    {
        $sql = "UPDATE users SET user_password = ? WHERE user_email = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$password, $email]);
        //check execute 
        if ($stmt) {
            $sql = "UPDATE users SET user_verifly = NULL WHERE user_email = ?";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->execute([$email]);
            unset($_SESSION['user_emailverifly']);
            return json_encode(["status" => "success", "msg" => "success"]);
        } else {
            return json_encode(["status" => "error", "msg" => "email or password incorrect"]);
        }
    }

    public function get_image_user($user_id)
    {
        $sql = "SELECT user_image_data FROM users WHERE user_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return base64_encode($result['user_image_data']);
    }

    public function update_user($user_id, $user_email, $old_email, $user_status, $user_image_data = null)
    {
        if ($this->check_uniq_email($old_email, $user_email) == 0) {
            if ($user_image_data != NULL) {
                $sql = "UPDATE users SET user_email = '$user_email',user_status = '$user_status',user_image_data = '$user_image_data' WHERE user_id = ?";
                $stmt = $this->db->connect()->prepare($sql);
                $stmt->execute([$user_id]);
            } else {
                $sql = "UPDATE users SET user_email = ?,user_status = ? WHERE user_id = ?";
                $stmt = $this->db->connect()->prepare($sql);
                $stmt->execute([$user_email, $user_status, $user_id]);
            }
            if ($stmt) {
                return json_encode(["status" => "success", "msg" => "อัพเดทข้อมูลเรียบร้อยแล้ว"]);
            } else {
                return json_encode(["status" => "error", "msg" => "อัพเดทข้อมูลไม่สำเร็จ"]);
            }
        } else {
            return json_encode(["status" => "error", "msg" => "อีเมลนี้มีผู้ใช้งานแล้ว"]);
        }
    }

    private function check_uniq_email($user_email, $user_email_new)
    {
        $sql = "SELECT * FROM users WHERE user_email = ? AND user_email != ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$user_email_new, $user_email]);
        $count = $stmt->rowCount();
        return $count;
    }

    public function delete_user($user_id)
    {
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        if ($stmt) {
            $sql1 = "SELECT * FROM book_area WHERE b_user_id = ?";
            $stmt1 = $this->db->connect()->prepare($sql1);
            $stmt1->execute([$user_id]);
            $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $value) {
                $sql2 = "DELETE FROM book_area WHERE b_id = ?";
                $stmt2 = $this->db->connect()->prepare($sql2);
                $stmt2->execute([$value['b_id']]);
                
                $sql3 = "UPDATE area_item SET item_active = 0 WHERE item_id = ?";
                $stmt3 = $this->db->connect()->prepare($sql3);
                $stmt3->execute([$value['b_item_id']]);

                $sql4 = "DELETE FROM receipt WHERE r_book_id = ?";
                $stmt4 = $this->db->connect()->prepare($sql4);
                $stmt4->execute([$value['b_id']]);
            }
            return json_encode(["status" => "success", "msg" => "ลบข้อมูลเรียบร้อยแล้ว"]);
        } else {
            return json_encode(["status" => "error", "msg" => "ลบข้อมูลไม่สำเร็จ"]);
        }
    }

    public function update_image_userById($user_id, $user_image_data)
    {
        $sql = "UPDATE users SET user_image_data = '$user_image_data' WHERE user_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        if ($stmt) {
            return json_encode(["status" => "success", "msg" => "อัพเดทข้อมูลเรียบร้อยแล้ว"]);
        } else {
            return json_encode(["status" => "error", "msg" => "อัพเดทข้อมูลไม่สำเร็จ"]);
        }
    }

    public function update_email($user_id, $user_email, $old_email)
    {
        if ($this->check_uniq_email($old_email, $user_email) == 0) {
            $sql = "UPDATE users SET user_email = '$user_email' WHERE user_id = ?";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->execute([$user_id]);
            if ($stmt) {
                setcookie('login', '', time() - 3600, '/');
                session_destroy();
                return json_encode(["status" => "success", "msg" => "อัพเดทข้อมูลเรียบร้อยแล้ว"]);
            } else {
                return json_encode(["status" => "error", "msg" => "อัพเดทข้อมูลไม่สำเร็จ"]);
            }
        } else {
            return json_encode(["status" => "error", "msg" => "อีเมลนี้มีผู้ใช้งานแล้ว"]);
        }
    }

    public function check_password($user_id, $user_password)
    {
        $sql = "SELECT * FROM users WHERE user_id = ? AND user_password = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$user_id, $user_password]);
        $count = $stmt->rowCount();
        if ($count > 0) {
            return json_encode(["status" => "success", "msg" => "รหัสผ่านถูกต้อง"]);
        } else {
            return json_encode(["status" => "error", "msg" => "รหัสผ่านไม่ถูกต้อง"]);
        }
    }

    public function update_password($user_id, $user_password)
    {
        $sql = "UPDATE users SET user_password = '$user_password' WHERE user_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        if ($stmt) {
            return json_encode(["status" => "success", "msg" => "อัพเดทข้อมูลเรียบร้อยแล้ว"]);
        } else {
            return json_encode(["status" => "error", "msg" => "อัพเดทข้อมูลไม่สำเร็จ"]);
        }
    }    
}

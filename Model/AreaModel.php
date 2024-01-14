<?php
include_once "db.php";

class AreaModel
{
    private $db;
    function __construct()
    {
        $this->db = new Db();
    }

    public function getArea()
    {
        $sql = "SELECT * FROM areas ORDER BY area_name ASC";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAreaById($id)
    {
        $sql = "SELECT * FROM areas WHERE area_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function addArea($name, $image)
    {
        $sql = "INSERT INTO areas (area_name, area_image) VALUES ('$name','$image')";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return json_encode(["status" => "success", "msg" => "success"]);
    }

    public function updateArea($id, $name, $image)
    {
        $sql = "UPDATE areas SET area_name = '$name', area_image = '$image' WHERE area_id = '$id'";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return json_encode(["status" => "success", "msg" => "success"]);
    }

    public function deleteArea($id)
    {
        $sql = "DELETE FROM areas WHERE area_id = '$id'";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return json_encode(["status" => "success", "msg" => "success"]);
    }

    public function getAreaitem($id)
    {
        $sql = "SELECT * FROM area_item AS aitm , areas as ar  WHERE ar.area_id=aitm.item_area_id AND aitm.item_area_id = '" . $id . "'";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAreaitemById($id)
    {
        $sql = "SELECT * FROM area_item as item , areas as area WHERE item.item_area_id = area.area_id AND item.item_area_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function bookArea($item_id, $user_id, $shopname, $firstname, $lastname, $email, $phone)
    {
        date_default_timezone_set("Asia/Bangkok");
        $sql = "INSERT INTO book_area (b_user_id, b_item_id, b_shop_name, b_firstname, b_lastname, b_email, b_phone, b_wait_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$user_id, $item_id, $shopname, $firstname, $lastname, $email, $phone, date("Y-m-d H:i:s")]);


        $sql1 = "UPDATE area_item SET item_active = '1' WHERE item_id = '$item_id'";
        $stmt1 = $this->db->connect()->prepare($sql1);
        $stmt1->execute();
        return json_encode(["status" => "success", "msg" => "success"]);
    }

    public function itemActive($id)
    {
        $sql = "SELECT * FROM book_area  as ba, users as u , areas as area, area_item as item WHERE ba.b_user_id=u.user_id AND ba.b_item_id=item.item_id AND item.item_area_id=area.area_id AND item.item_id = '" . $id . "'";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        // $result[0]['user_image_data'] = base64_encode($result[0]['user_image_data']);
        return $result;
    }

    public function getitemActive($id)
    {
        $sql = "SELECT * FROM book_area  as ba, users as u , areas as area, area_item as item WHERE ba.b_user_id=u.user_id AND ba.b_item_id=item.item_id AND item.item_area_id=area.area_id AND item.item_id = '" . $id . "'";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        $reslut =  $stmt->fetchAll();
        // $reslut[0]['user_image_data'] = base64_encode($reslut[0]['user_image_data']);
        return base64_encode($reslut[0]['user_image_data']);
    }

    public function getitemUser($id)
    {
        $sql = "SELECT * FROM book_area  as ba, users as u , areas as area, area_item as item WHERE ba.b_user_id=u.user_id AND ba.b_item_id=item.item_id AND item.item_area_id=area.area_id AND u.user_id = '" . $id . "' ORDER BY area.area_name ASC";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getItemBookByiD($id)
    {
        $sql = "SELECT * FROM book_area  as ba , areas as area, area_item as item WHERE ba.b_item_id=item.item_id AND item.item_area_id=area.area_id AND ba.b_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$id]);
        $reslut =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode(["status" => "success", "data" => $reslut[0]]);
    }

    public function getitemUserActive($id)
    {
        $sql = "SELECT * FROM book_area  as ba, users as u , areas as area, area_item as item WHERE ba.b_user_id=u.user_id AND ba.b_item_id=item.item_id AND item.item_area_id=area.area_id AND item.item_id = '" . $id . "'";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        $reslut =  $stmt->fetchAll();
        // $reslut[0]['user_image_data'] = base64_encode($reslut[0]['user_image_data']);
        return $reslut[0]['b_shop_name'];
    }
    public function count_area($id)
    {
        $sql = "SELECT * FROM area_item AS item , areas AS areas  WHERE item.item_area_id=areas.area_id AND areas.area_id = '" . $id . "'";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        $result =  $stmt->fetchAll();
        $use = 0;
        if ($result != null) {
            $notuse = count($result);
            foreach ($result as $key => $value) {
                if ($value['item_active'] == 2) {
                    $use++;
                }
            }
            return ['use' => $use, 'notuse' => $notuse, 'check' => true];
        } else {
            return ['use' => 0, 'notuse' => 0, 'check' => false];
        }
    }

    public function getareauser($item_id, $area_id, $user_id)
    {
        $sql = "SELECT * FROM book_area  as ba, users as u , areas as area, area_item as item WHERE ba.b_user_id=u.user_id AND ba.b_item_id=item.item_id AND item.item_area_id=area.area_id AND item.item_id = '" . $item_id . "' AND area.area_id = '" . $area_id . "' AND u.user_id = '" . $user_id . "'";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        $reslut =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = [];
        foreach ($reslut as $key => $value) {
            foreach ($value as $keyx => $valuex) {
                if ($keyx != 'user_image_data') {
                    //echo $keyx . " " . $valuex . "<br>";
                    $data[$keyx] = $valuex;
                }
            }
        }
        return $data;
    }

    public function cancelBook($b_id, $user_id)
    {
        $sql = "SELECT * FROM book_area  as ba, users as u , areas as area, area_item as item WHERE ba.b_user_id=u.user_id AND ba.b_item_id=item.item_id AND item.item_area_id=area.area_id AND ba.b_id = '" . $b_id . "' AND u.user_id = '" . $user_id . "'";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        $reslut =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $area_id = $reslut[0]['item_area_id'];
        $item_id = $reslut[0]['item_id'];
        $sql1 = "DELETE FROM book_area WHERE b_id = '$b_id'";
        $stmt1 = $this->db->connect()->prepare($sql1);
        $stmt1->execute();
        if ($stmt1) {
            $sql2 = "UPDATE area_item SET item_active = '0' WHERE item_id = '$item_id'";
            $stmt2 = $this->db->connect()->prepare($sql2);
            $stmt2->execute();
            if ($stmt2) {
                return json_encode(["status" => "success", "msg" => "success"]);
            } else {
                return json_encode(["status" => "error", "msg" => "error"]);
            }
        } else {
            return json_encode(["status" => "error", "msg" => "error"]);
        }
    }

    public function count_user()
    {
        $sql = "SELECT * FROM users WHERE user_status = 0";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function count_area_all()
    {
        $sql = "SELECT * FROM areas";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function count_item_all()
    {
        $sql = "SELECT * FROM area_item";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function count_book_item()
    {
        $sql = "SELECT * FROM area_item WHERE item_active != 0";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function Checkuniqarea($name, $newname)
    {
        $check = true;
        $sql = "SELECT * FROM areas WHERE area_name != ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$name]);
        $result = $stmt->fetchAll();
        foreach ($result as $key => $value) {
            if ($value['area_name'] == $newname) {
                $check = false;
                break;
            } else {
                $check = true;
            }
        }
        if ($check) {
            $sql1 = "UPDATE areas SET area_name = '$newname' WHERE area_name = '$name'";
            $stmt1 = $this->db->connect()->prepare($sql1);
            $stmt1->execute();
            return json_encode(["status" => "success", "msg" => "success"]);
        } else {
            return json_encode(["status" => "error", "msg" => "error"]);
        }
    }

    public function get_checkuniq($area_name)
    {
        $sql = "SELECT * FROM areas WHERE area_name = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$area_name]);
        $count = $stmt->rowCount();
        return $count;
    }

    public function insert_area($area_name)
    {
        if ($this->get_checkuniq($area_name) == 0) {
            $sql = "INSERT INTO areas (area_name) VALUES (?)";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->execute([$area_name]);
            return json_encode(["status" => "success", "msg" => "success"]);
        } else {
            return json_encode(["status" => "error", "msg" => "error"]);
        }
    }

    public function delete_area($area_id)
    {
        $sql = "DELETE FROM areas WHERE area_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$area_id]);
        if ($stmt) {
            $sql1 = "SELECT * FROM area_item WHERE item_area_id = ?";
            $stmt1 = $this->db->connect()->prepare($sql1);
            $stmt1->execute([$area_id]);
            $result = $stmt1->fetchAll();
            $count = $stmt1->rowCount();
            if ($count > 0) {
                foreach ($result as $key => $value) {
                    $sql2 = "DELETE FROM area_item WHERE item_id = ?";
                    $stmt2 = $this->db->connect()->prepare($sql2);
                    $stmt2->execute([$value['item_id']]);
                    if ($stmt2) {
                        $sql3 = "DELETE FROM book_area WHERE b_item_id = ?";
                        $stmt3 = $this->db->connect()->prepare($sql3);
                        $stmt3->execute([$value['item_id']]);
                        if ($stmt3) {
                            return json_encode(["status" => "success", "msg" => "success"]);
                        } else {
                            return json_encode(["status" => "error", "msg" => "error"]);
                        }
                    } else {
                        return json_encode(["status" => "error", "msg" => "error"]);
                    }
                }
            } else {
                return json_encode(["status" => "success", "msg" => "success"]);
            }
        } else {
            return json_encode(["status" => "error", "msg" => "error"]);
        }
    }

    public function get_approved()
    {
        $sql = "SELECT * FROM book_area as ba, users as u, area_item as item, areas as area WHERE ba.b_user_id=u.user_id AND ba.b_item_id=item.item_id AND item.item_area_id=area.area_id AND ba.b_appove_time IS NULL";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_area_item($id)
    {
        $sql = "SELECT * FROM area_item WHERE item_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_Area_Item($id, $height, $width, $price)
    {
        $sql = "UPDATE area_item SET item_height = :height, item_width = :width,item_price = :price WHERE item_id = :id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute(['height' => $height, 'width' => $width, 'price' => $price, 'id' => $id]);
        return json_encode(["status" => "success", "msg" => "success"]);
    }

    public function deleteAreaItemById($item_id)
    {
        $sql = "DELETE FROM area_item WHERE item_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$item_id]);
        if ($stmt) {
            $sql1 = "SELECT * FROM book_area WHERE b_item_id = ?";
            $stmt1 = $this->db->connect()->prepare($sql1);
            $stmt1->execute([$item_id]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                $sql2 = "DELETE FROM book_area WHERE b_item_id = ?";
                $stmt2 = $this->db->connect()->prepare($sql2);
                $stmt2->execute([$item_id]);
                if ($stmt2) {
                    return json_encode(["status" => "success", "msg" => "success"]);
                } else {
                    return json_encode(["status" => "error", "msg" => "error"]);
                }
            } else {
                return json_encode(["status" => "success", "msg" => "success"]);
            }
        } else {
            return json_encode(["status" => "error", "msg" => "error"]);
        }
    }

    public function insertAreaItem($area_id, $item_width, $item_height, $item_price)
    {
        $sql = "INSERT INTO area_item (item_area_id,item_width,item_height,item_price) VALUES (?,?,?,?)";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$area_id, $item_width, $item_height, $item_price]);
        if ($stmt) {
            return json_encode(["status" => "success", "msg" => "success"]);
        } else {
            return json_encode(["status" => "error", "msg" => "error"]);
        }
    }

    public function get_book_area()
    {
        $sql = "SELECT * FROM book_area as ba, users as u, area_item as item, areas as area WHERE ba.b_user_id=u.user_id AND ba.b_item_id=item.item_id AND item.item_area_id=area.area_id AND ba.b_appove_time IS NULL ORDER BY ba.b_id DESC";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_book_areaAll()
    {
        $sql = "SELECT * FROM book_area as ba, users as u, area_item as item, areas as area WHERE ba.b_user_id=u.user_id AND ba.b_item_id=item.item_id AND item.item_area_id=area.area_id AND item.item_active = 2 ORDER BY ba.b_id DESC";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_time_book($time)
    {
        date_default_timezone_set('Asia/Bangkok');
        $date = $time;
        $unixTimestamp = strtotime($date);
        $thaiDate = 'วัน' . date('l', $unixTimestamp) . 'ที่ ' . date('j', $unixTimestamp) . ' ' . date('F', $unixTimestamp) . ' ' . (date('Y', $unixTimestamp) + 543) . ' เวลา ' . date('H:i:s', $unixTimestamp);
        $thaiDate = str_replace(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'], $thaiDate);
        $thaiDate = str_replace(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'], $thaiDate);
        return $thaiDate;
    }

    public function get_book_area_by_id($id)
    {
        $sql = "SELECT * FROM book_area WHERE b_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_book_area($id, $time)
    {
        $sql = "UPDATE book_area SET b_appove_time = ? WHERE b_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$time, $id]);
        if ($stmt) {
            $sql2 = "SELECT * FROM book_area WHERE b_id = ?";
            $stmt2 = $this->db->connect()->prepare($sql2);
            $stmt2->execute([$id]);
            $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            $item_id = $result[0]['b_item_id'];
            $sql1 = "UPDATE area_item SET item_active = '2' WHERE item_id = ?";
            $stmt1 = $this->db->connect()->prepare($sql1);
            $stmt1->execute([$item_id]);
            if ($stmt1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function update_book_area_notapprove($id)
    {
        $sql = "SELECT * FROM book_area WHERE b_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $item_id = $result[0]['b_item_id'];
        $sql1 = "DELETE FROM book_area WHERE b_id = ?";
        $stmt1 = $this->db->connect()->prepare($sql1);
        $stmt1->execute([$id]);
        if ($stmt1) {
            $sql2 = "UPDATE area_item SET item_active = '0' WHERE item_id = ?";
            $stmt2 = $this->db->connect()->prepare($sql2);
            $stmt2->execute([$item_id]);
            if ($stmt2) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_receiptById($id, $month, $year)
    {
        date_default_timezone_set('Asia/Bangkok');
        $sql = "SELECT * FROM receipt WHERE r_book_id = ? AND MONTH(r_month) = ? AND YEAR(r_month) = ? ORDER BY r_month ASC";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$id, $month, $year]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update_bookItem($item_id, $b_id)
    {
        $sql = "SELECT * FROM book_area WHERE b_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$b_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $item_id_old = $result[0]['b_item_id'];
        $sql1 = "UPDATE area_item SET item_active = '0' WHERE item_id = ?";
        $stmt1 = $this->db->connect()->prepare($sql1);
        $stmt1->execute([$item_id_old]);
        if ($stmt1) {
            $sql2 = "UPDATE area_item SET item_active = '2' WHERE item_id = ?";
            $stmt2 = $this->db->connect()->prepare($sql2);
            $stmt2->execute([$item_id]);
            if ($stmt2) {
                $sql3 = "UPDATE book_area SET b_item_id = ? WHERE b_id = ?";
                $stmt3 = $this->db->connect()->prepare($sql3);
                $stmt3->execute([$item_id, $b_id]);
                if ($stmt3) {
                    return json_encode(["status" => "success", "msg" => "success"]);
                } else {
                    return json_encode(["status" => "error", "msg" => "error"]);
                }
            } else {
                return json_encode(["status" => "error", "msg" => "error"]);
            }
        } else {
            return json_encode(["status" => "error", "msg" => "error"]);
        }
    }

    public function updateBookItemById($b_id, $b_shop_name, $b_firstname, $b_lastname, $b_email, $b_phone)
    {
        $sql = "UPDATE book_area SET b_shop_name = ?, b_firstname = ?, b_lastname = ?, b_email = ?, b_phone = ? WHERE b_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$b_shop_name, $b_firstname, $b_lastname, $b_email, $b_phone, $b_id]);
        if ($stmt) {
            return json_encode(["status" => "success", "msg" => "success"]);
        } else {
            return json_encode(["status" => "error", "msg" => "error"]);
        }
    }

    public function deleteBookItemById($b_id)
    {
        $sql = "SELECT * FROM book_area WHERE b_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$b_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $item_id = $result[0]['b_item_id'];
        $sql1 = "DELETE FROM book_area WHERE b_id = ?";
        $stmt1 = $this->db->connect()->prepare($sql1);
        $stmt1->execute([$b_id]);
        if ($stmt1) {
            $sql2 = "UPDATE area_item SET item_active = '0' WHERE item_id = ?";
            $stmt2 = $this->db->connect()->prepare($sql2);
            $stmt2->execute([$item_id]);
            if ($stmt2) {
                return json_encode(["status" => "success", "msg" => "success"]);
            } else {
                return json_encode(["status" => "error", "msg" => "error"]);
            }
        } else {
            return json_encode(["status" => "error", "msg" => "error"]);
        }
    }

    public function insert_receipt($r_id, $r_book_id, $r_month, $r_total)
    {
        $sql = "INSERT INTO receipt (r_id,r_book_id, r_month, r_total) VALUES (?,?,?,?)";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$r_id, $r_book_id, $r_month, $r_total]);
        if ($stmt) {
            return json_encode(["status" => "success", "msg" => "success"]);
        } else {
            return json_encode(["status" => "error", "msg" => "error"]);
        }
    }

    public function get_receiptId($id)
    {
        $sql = "SELECT * FROM receipt WHERE r_book_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result != null) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function get_receiptAll()
    {
        $sql = "SELECT * FROM receipt as r, book_area as ba, users as u, area_item as item, areas as area WHERE r.r_book_id = ba.b_id AND ba.b_user_id = u.user_id AND ba.b_item_id = item.item_id AND item.item_area_id = area.area_id ORDER BY r.r_month ASC";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function get_areaItemByid($id)
    {
        $sql = "SELECT * FROM area_item WHERE item_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_book_userById($user_id)
    {
        $sql = "SELECT * FROM book_area as ba, users as u, area_item as item, areas as area WHERE ba.b_user_id = u.user_id AND ba.b_item_id = item.item_id AND item.item_area_id = area.area_id AND u.user_id = ? ORDER BY area.area_name ASC";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = [];
        if (count($result) != 0) {
            $keyDat = array_keys($result[0]);
            foreach ($result as $key => $value) {
                foreach ($value as $keyx => $valuex) {
                    if ($keyx != 'user_image_data') {
                        $data[$key][$keyx] = $valuex;
                    }
                }
            }
            foreach ($data as $key => $value) {
                $count = 0;
                $dataItem = $this->get_areaItemByid($value['b_item_id']);
                foreach ($dataItem as $keyx => $valuex) {
                    if($value['b_item_id'] == $valuex['item_id']){
                        break;
                    }
                    $count++;
                }
                $data[$key]['item_position'] = $count+1;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function get_count_month($month, $year)
    {
        $sql = "SELECT * FROM receipt WHERE MONTH(r_month) = ? AND YEAR(r_month) = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$month, $year]);
        return $stmt->rowCount();
    }
}

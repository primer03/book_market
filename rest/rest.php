<?php
include_once "../Model/UserModel.php";
include_once "../Model/AreaModel.php";
header("content-type: application/json");

$user = new UserModel();
$area = new AreaModel();
if (isset($_GET['logout'])) {
  $user->sign_out();
  //header("location: ../index.php");
}elseif (isset($_GET['getarea'])) {
  echo json_encode($area->getArea());
}
if (isset($_POST['status'])) {
  if ($_POST['status'] == 'register') {
    if ($_FILES['images']['size'] < 1048576 * 4) { // 4 MB
      $email = $_POST['user_email'];
      $password = md5($_POST['user_password']);
      $image = addslashes(file_get_contents($_FILES['images']['tmp_name']));
      $user_status = $_POST['user_status'];
      echo  $user->register($email, $password, $image, $user_status);
    }else{
      echo json_encode(['status' => 'error', 'msg' => 'ขนาดไฟล์ใหญ่เกินไป']);
    }
  } elseif ($_POST['status'] == 'login') {
    $email = $_POST['user_email'];
    $password = md5($_POST['user_password']);
    echo $user->login($email, $password);
  } elseif ($_POST['status'] == 'getareaitemBYid') {
    $id = $_POST['id'];
    echo json_encode($area->getAreaitemById($id));
  } elseif ($_POST['status'] == 'addBookarea') {
    $item_id = $_POST['b_item_id'];
    $user_id = $_POST['b_user_id'];
    $shopname = $_POST['b_shop_name'];
    $firstname = $_POST['b_firstname'];
    $lastname = $_POST['b_lastname'];
    $email = $_POST['b_email'];
    $phone = $_POST['b_phone'];
    // echo json_encode([$item_id, $user_id, $shopname, $firstname, $lastname, $email, $phone]);
    echo $area->bookArea($item_id, $user_id, $shopname, $firstname, $lastname, $email, $phone);
  } elseif ($_POST['status'] == 'getimage') {
    $itemx_id = $_POST['item_id'];
    echo $area->getitemActive($itemx_id);
  } elseif ($_POST['status'] == 'get_item_user') {
    $itemx_id = $_POST['item_id'];
    echo json_encode(['status' => 'success', 'msg' => $area->getitemUserActive($itemx_id)]);
  } elseif ($_POST['status'] == 'getbookuser') {
    $user_id = $_POST['user_id'];
    $area_id = $_POST['area_id'];
    $item_id = $_POST['item_id'];
    $result = $area->getareauser($item_id, $area_id, $user_id);
    if ($result) {
      echo json_encode(['status' => 'success', 'msg' => $result]);
    } else {
      echo json_encode(['status' => 'error', 'msg' => 'ไม่พบข้อมูล']);
    }
  } elseif ($_POST['status'] == 'cancelbook') {
    $b_id = $_POST['b_id'];
    $user_id = $_POST['user_id'];
    echo $area->cancelbook($b_id, $user_id);
  }elseif ($_POST['status'] == 'verifly') {
    $verifly = $_POST['verifly'];
    $email = $_POST['user_email'];
    echo $user->check_verifly($email,$verifly);
  }elseif ($_POST['status'] == 'newpassword') {
    $newpassword = md5($_POST['newpassword']);
    $email = $_POST['user_email'];
    echo $user->newpassword($email,$newpassword);
  }elseif ($_POST['status'] == 'getArea') {
    echo json_encode(['status' => 'success', 'data' => $area->getArea()]);
  }elseif ($_POST['status'] == 'Checkuniqarea') {
    $area_name = $_POST['area_name'];
    $area_name_new = $_POST['area_name_new'];
    sleep(1);
    echo $area->Checkuniqarea($area_name,$area_name_new);
  }elseif ($_POST['status'] == 'insertzone') {
    $area_name = $_POST['area_name'];
    echo $area->insert_area($area_name);
  }elseif ($_POST['status'] == 'deletezone') {
    $area_id = $_POST['area_id'];
    echo $area->delete_area($area_id);
  }elseif ($_POST['status'] == 'getAreaitems') {
    $area_id = $_POST['area_id'];
    echo json_encode(['status' => 'success', 'data' => $area->getAreaitem($area_id)]);
  }elseif ($_POST['status'] == 'getAreaItemID') {
    $item_id = $_POST['item_id'];
    echo json_encode(['status' => 'success', 'data' => $area->get_area_item($item_id)]);
  }elseif ($_POST['status'] == 'updateAreaItem') {
    $item_id = $_POST['item_id'];
    $item_height = $_POST['item_height'];
    $item_width = $_POST['item_width'];
    $item_price = $_POST['item_price'];
    echo $area->update_area_item($item_id,$item_height,$item_width,$item_price);
  }elseif ($_POST['status'] == 'deleteAreaItem') {
    $item_id = $_POST['item_id'];
    echo $area->deleteAreaItemById($item_id);
  }elseif ($_POST['status'] == 'count_area') {
    $area_id = $_POST['area_id'];
    echo json_encode(['status' => 'success', 'data' => $area->count_area($area_id)]);
  }elseif ($_POST['status'] == 'getArea') {
    echo json_encode(['status' => 'success', 'data' => $area->getArea()]);
  }elseif ($_POST['status'] == 'insertAreaItem') {
    $area_id = $_POST['area_id'];
    $item_height = $_POST['item_height'];
    $item_width = $_POST['item_width'];
    $item_price = $_POST['item_price'];
    echo $area->insertAreaItem($area_id,$item_height,$item_width,$item_price);
  }elseif ($_POST['status'] == 'getBookItemById') {
    $b_id = $_POST['b_id'];
    echo json_encode(['status' => 'success', 'data' => $area->get_book_area_by_id($b_id)]);
  }
}

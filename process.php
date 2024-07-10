<?php

include 'conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
  $errors = [];
  $success = [];

  $email = htmlentities($_POST['email']);
  $item_name = htmlentities($_POST['item_name']);
  $qty = htmlentities($_POST['qty']);
  $price = htmlentities($_POST['price']);

  if(empty(trim($email))){
    $errors['email'] = 'Email is required!';
  }

  if(empty(trim($item_name))){
    $errors['itemName'] = 'Item name is required!';
  }
  if(empty(trim($qty))){
    $errors['qty'] = 'Quantity is required!';
  }
  if(empty(trim($price))){
    $errors['price'] = 'Product Price cannot be empty!';
  }

  if (empty($errors)) {
    $sql = "INSERT INTO `sellers` (`Email` ,`items`,`quantity`,`price`) VALUES ('$email' ,'$item_name','$qty','$price')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $success['success'] = 'Product book successfull!';
    } else {
        $errors['errordb'] = 'Connection failure';
    }
}

  if(count($errors) > 0){
    echo json_encode([
      'status' => false,
      'errors' => $errors
    ]);
  }else{
    echo json_encode([
      'status' => true,
      'message' => $success
    ]);
  }
}

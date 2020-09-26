<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// set user property values
$user->email = $_POST['email'];
$user->password = base64_encode($_POST['password']);
$user->created = date('Y-m-d H:i:s');
 
// create the user
if($user->signup()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "email" => $user->email
    );
    json_encode($user_arr);
    header("location:../../Dashboard/");
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Username already exists!"
    );
    json_encode($user_arr); 
    header("location:../../");
}

?>
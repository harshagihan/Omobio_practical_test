<?php



header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');



include_once "database.php";

include_once 'models/Users.php';



$database = new Database();

$db = $database->connect();



$user = new User($db);



$result = $user->getUsers();



$num = $result->rowCount();



if ($num > 0) {​​

    $user_arr = array();

    $user_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {​​

        extract($row);

        $single_user = array(

            'id' => $id,

            'username' => $useremail,

            'password' => $userepassword,

            'name' => $name,

            'email' => $email

        );

        array_push($user_arr['data'], $single_user);

    }​​

    $user_arr['status'] = true;

    $user_arr['msg'] = "Success";

    echo json_encode($user_arr);

}​​ else {​​

    $user_arr['status'] = false;

    echo json_encode($user_arr);

}​​
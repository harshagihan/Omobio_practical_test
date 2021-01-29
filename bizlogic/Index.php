<?php



header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

header('Access-Control-Allow-Methods: POST');

header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');



include_once "database.php";

include_once '../../models/Users.php';



$database = new Database();

$db = $database->connect();



$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->username = $data->username;

$user->password = $data->password;



$result = $user->signIn();



$num = $result->rowCount();



if ($num > 0) {​​

    $user_obj = array();

    $user_obj['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {​​

        extract($row);

        $single_user = array(

            'id' => $id,

            'username' => $username,

            'password' => $password,

            'name' => $name,

            'email' => $email

        );

        $user_obj['data'] = $single_user;

        $user_obj['status'] = true;

        $user_obj['msg'] = "Success";

    }​​

    echo json_encode($user_obj);

}​​ else {​​

    $user_obj['status'] = false;

    $user_obj['msg'] = "Please check username and password and try again";

    echo json_encode($user_obj);

}​​
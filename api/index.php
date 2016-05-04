<?php

require 'vendor/autoload.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();


$app->get('/users/:id','getOneUser');
$app->get('/users','getUsers');
$app->post('/users','createUser');
$app->put('/users','updateUser');
$app->delete('/users/','delUsers');


function getUsers(){
    $db = new PDO('mysql:host=localhost;dbname=app','root','');

    $stmt = $db->query("SELECT * FROM users");
    $res = $stmt->fetchAll();

    $res = json_encode($res);
    header('Content-Type: application/json');
    echo $res;
    exit();
    $db=null;
}

function createUser(){
    $db = new PDO('mysql:host=localhost;dbname=app','root','');

    $request = \Slim\Slim::getInstance()->request();
    $user = $request->params();

    $stmt1 = $db->prepare("SELECT email FROM users WHERE email = :email2");
    $stmt1->bindParam(":email2",$user['email'],PDO::PARAM_STR);
    $stmt1->execute();
    $my = $stmt1->rowCount();

    if($my == 0){
        $stmt = $db->prepare("INSERT INTO users(username,password,email,phone) VALUES(:username,:password,:email,:phone)");
        $stmt->bindParam(":username",$user['user'],PDO::PARAM_STR);
        $stmt->bindParam(":password",$user['pass'],PDO::PARAM_STR);
        $stmt->bindParam(":email",$user['email'],PDO::PARAM_STR);
        $stmt->bindParam(":phone",$user['phone'],PDO::PARAM_STR);
        // $stmt->bindParam(":rol",$user['rol'],PDO::PARAM_INT);
        // $stmt->bindParam(":city",$user['city'],PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->rowCount();

        echo "Usuario añadido correctamente";
        // die();
    }
    else
    {
        echo "No puedes insertar un usuario con el mismo mail";
    }

    exit();
    $db=null;
}

function updateUser(){
    $db = new PDO('mysql:host=localhost;dbname=app','root','');

    $request = \Slim\Slim::getInstance()->request();
    $params = $request->params();

    if(isset($params['id_user']))
    {   
        $stmt = $db->prepare("SELECT * FROM users WHERE id_user = :id");
        $stmt->bindParam(":id",$params['id_user'],PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll();

        if(isset($params['user']))
        {
            $username = $params['user'];
        }
        else
        {
            $username = $res[0]['username'];
        }

        if(isset($params['pass']))
        {
            $pass = $params['pass'];
        }
        else
        {
            $pass = $res[0]['password'];
        }

        if(isset($params['email']))
        {
            $email = $params['email'];
        }
        else
        {
            $email = $res[0]['email'];
        }

        if(isset($params['phone']))
        {
            $phone = $params['phone'];
        }
        else
        {
            $phone = $res[0]['phone'];
        }

        if(isset($params['rol']))
        {
            $rol = (integer)$params['rol'];
        }
        else
        {
            $rol = (integer)$res[0]['rol'];
        }

        if(isset($params['city']))
        {
            $city = (integer)$params['city'];
        }
        else
        {
            $city = (integer)$res[0]['city'];
        }


        $upd = $db->prepare("UPDATE users SET username = :user, password = :pass, email = :email, phone = :phone,
                            rol = :rol, city = :city WHERE id_user = :id");

        $upd->bindParam(":user",$username,PDO::PARAM_STR);
        $upd->bindParam(":pass",$pass,PDO::PARAM_STR);
        $upd->bindParam(":email",$email,PDO::PARAM_STR);
        $upd->bindParam(":phone",$phone,PDO::PARAM_STR);
        $upd->bindParam(":rol",$rol,PDO::PARAM_INT);
        $upd->bindParam(":city",$city,PDO::PARAM_INT);
        $upd->bindParam(":id",$params['id_user'],PDO::PARAM_INT);
        $upd->execute();
        $resupd = $upd->rowCount();

        if($resupd > 0)
        {
            echo "Usuario actualizado correctamente";
        }
        else
        {
            echo "No se ha podido actualizar el usuario";
        }

        }
    else{
        echo "no hay id";
    }

    exit();
    $db=null;
}

function delUsers(){
    $db = new PDO('mysql:host=localhost;dbname=app','root','');

    $request = \Slim\Slim::getInstance()->request();
    $params = $request->params();

    $stmt = $db->prepare("DELETE FROM users WHERE id_user = :id");
    $stmt->bindParam(":id",$params['id_user'],PDO::PARAM_INT);
    $stmt->execute();
    $resupd = $stmt->rowCount();


    if($resupd > 0)
    {
        echo "Usuario eliminado correctamente";
    }
    else
    {
        echo "No se ha podido eliminar el usuario";
    }
    exit();
    $db=null;
}

function getOneUser($id){

    $db = new PDO('mysql:host=localhost;dbname=app','root','');



    $stmt= $db->prepare("SELECT username, password,email,phone,rol,id_user FROM users WHERE id_user = :userid");
    $stmt->bindParam(':userid', $id,PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch();

    // print_r($row);

    $res = json_encode($res);
    header('Content-Type: application/json');

    echo $res;
    exit();
    $db=null;
};



$app->run();
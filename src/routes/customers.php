<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// $app = new \Slim\App;

//Get All Customers
$app->get('/api/customers',function (Request $request, Response $response){
    $sql = "SELECT * FROM customers";
    try {
       //Get DB Object and connect to the database
       $db      = (new DB)->connect();
       $stmt = $db->query($sql);
       $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
       $db = null;
       echo json_encode($customers);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
});

//Get Single Customers
$app->get('/api/customer/{id}',function (Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM customers WHERE id = :id ";
    try {
       //Get DB Object and connect to the database
       $db      = (new DB)->connect();
       $stmt = $db->prepare($sql);
       $stmt->execute([':id'=>$id]);
       $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
       $db = null;
       echo json_encode($customer);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
});

//Add Customers
$app->post('/api/customer/add',function (Request $request, Response $response){
    $firstname = $request->getParam('firstname');
    $lastname  = $request->getParam('lastname');
    $phone     = $request->getParam('phone');
    $email     = $request->getParam('email');
    $address   = $request->getParam('address');
    $city      = $request->getParam('city');
    $state     = $request->getParam('state');
    $sql = "INSERT INTO customers(firstname,lastname,phone,email,address,city,state)
    VALUES
    (:firstname,:lastname,:phone,:email,:address,:city,:state)
    ";
    try {
       //Get DB Object and connect to the database
       $db      = (new DB)->connect();
       $stmt = $db->prepare($sql);
       $stmt->execute([
            ':firstname' => $firstname,
            ':lastname'  => $lastname,
            ':phone'     => $phone,
            ':email'     => $email,
            ':address'   => $address,
            ':city'      => $city,
            ':state'     => $state,
       ]);

       $db = null;

       echo '{"notice" : {"text":"Customer Added"}}';
    } catch (PDOException $e) {
        die($e->getMessage());
    }
});


//Update Customers
$app->put('/api/customer/update/{id}',function (Request $request, Response $response){
    $id = $request->getAttribute('id');
    $firstname = $request->getParam('firstname');
    $lastname  = $request->getParam('lastname');
    $phone     = $request->getParam('phone');
    $email     = $request->getParam('email');
    $address   = $request->getParam('address');
    $city      = $request->getParam('city');
    $state     = $request->getParam('state');
    $sql =
    "
    UPDATE customers SET firstname=:firstname , lastname=:lastname , phone=:phone , email=:email , address=:address ,
    city=:city , state=:state WHERE id = $id
    ";
    try {
       //Get DB Object and connect to the database
       $db      = (new DB)->connect();
       $stmt = $db->prepare($sql);
       $stmt->execute([
            ':firstname' => $firstname,
            ':lastname'  => $lastname,
            ':phone'     => $phone,
            ':email'     => $email,
            ':address'   => $address,
            ':city'      => $city,
            ':state'     => $state,
       ]);

       $db = null;

       echo '{"notice" : {"text":"Customer Updated"}}';
    } catch (PDOException $e) {
        die($e->getMessage());
    }
});

//Get Single Customers
$app->delete('/api/customer/delete/{id}',function (Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM customers WHERE id = :id ";
    try {
       //Get DB Object and connect to the database
       $db      = (new DB)->connect();
       $stmt = $db->prepare($sql);
       $stmt->execute([':id'=>$id]);
       $db = null;
       echo '{"notice" : {"text":"Customer Deleted"}}';
    } catch (PDOException $e) {
        die($e->getMessage());
    }
});

?>
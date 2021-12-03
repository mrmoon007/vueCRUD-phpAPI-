<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "vueapi";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$response = [];
$response["error"] = false;

$employees = [];

$action = "read";

if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
if ($action == "read") {
    $result = $conn->query("SELECT * FROM `employee`");
    // mysqli_fetch_assoc($result)
    while ($row = $result->fetch_assoc()) {
        array_push($employees, $row);
    }
    if ($result) {
        $response["employees"] = $employees;
    } else {
        $response["message"] = "Server fail";
    }
} elseif ($action == "create") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $result = $conn->query("INSERT INTO `employee`(`name`, `email`, `phone`) VALUES ('$name','$email','$phone')");
    if ($result) {
        $response["employees"] = "Data save successfully";
    } else {
        $response["message"] = "Data save fail";
    }
} elseif ($action == "update") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $result = $conn->query("UPDATE `employee` SET `name`='$name',`email`='$email',`phone`='$phone' WHERE `id`='$id'");

    if ($result) {
        $response["employees"] = "Data updated successfully";
    } else {
        $response["message"] = "Data update fail";
    }
} elseif ($action == "delete") {
    $id = $_POST['id'];
    $result = $conn->query("DELETE FROM `employee` WHERE  `id`='$id'");

    if ($result) {
        $response["employees"] = "Data delete successfully";
    } else {
        $response["message"] = "Data delete fail";
    }
} else {
    die("Invalid Action");
}

header("content-type:application/json");
echo json_encode($response);

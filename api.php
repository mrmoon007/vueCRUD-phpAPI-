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
    $response["employees"] = $employees;
} elseif ($action == "create") {
    # code...
} elseif ($action == "update") {
    # code...
} elseif ($action == "delete") {
    # code...
} else {
    die("Invalid Action");
}

header("content-type:application/json");
echo json_encode($response);

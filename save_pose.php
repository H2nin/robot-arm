<?php
$conn = new mysqli("localhost", "root", "", "robot_arm");

$sql = "INSERT INTO poses (motor1, motor2, motor3, motor4, motor5, motor6)
        VALUES (
          {$_POST['motor1']},
          {$_POST['motor2']},
          {$_POST['motor3']},
          {$_POST['motor4']},
          {$_POST['motor5']},
          {$_POST['motor6']}
        )";

$conn->query($sql);
header("Location: index.php");
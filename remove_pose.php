<?php
$conn = new mysqli("localhost", "root", "", "robot_arm");
$id = $_GET['id'];
$conn->query("DELETE FROM poses WHERE id = $id");
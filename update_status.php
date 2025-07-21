<?php
$conn = new mysqli("localhost", "root", "", "robot_arm");
$conn->query("UPDATE poses SET status = 0");
echo "Status updated";
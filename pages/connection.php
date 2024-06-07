<?php
// host, user and password please refer to your MySQL account yea heh
$serverhost = 'localhost';
$username = 'root';
$password = '';
$database = 'gamerhub';

// This is where the connection is being created yea
$connect = mysqli_connect($serverhost, $username, $password, $database);

//to check if connection is established
// if (!$connect) {
//     die("Connection failed:" . mysqli_connect_error());
// } else {
//     echo "Connected successfully";
// }

// // //mysqli_close($connect);

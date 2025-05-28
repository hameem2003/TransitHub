<?php
$conn = mysqli_connect("localhost", "root", "", "transithub_db");
if (!$conn) {
    die("Connection not established: " . mysqli_connect_error());
}
?>

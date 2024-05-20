<?php

require "config.php";

if(isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $delete = $conn->prepare("DELETE FROM tblskitag WHERE id = :id");
    $delete->execute([':id' => $id]);
}

header("Location: index.php");
?>
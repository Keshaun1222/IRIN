<?php
$mysqli = new mysqli('localhost', 'root', 'dwayne12', 'irin');

$query = $mysqli->query("SELECT * FROM users");

while ($users = $query->fetch_array()) {
    $mysqli->query("INSERT INTO awards VALUES ({$users['id']}, '', '')");
}
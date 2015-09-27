<?php

// Connect to the database
require_once('config.php');
$mysqli = new mysqli($config['host'], $config['user'], $config['passwd'], $config['db']);

// Get the number of questions
$result = $mysqli->query("SELECT COUNT(*) FROM " . $config['table']);
$row = $result->fetch_row();
$num_rows = (int) $row[0];

$min = $_POST['min'];
$max = $_POST['max'];

if ($min < 1 || $min > $num_rows) {
    $min = 1;
}

if ($max < 1 || $max > $num_rows) {
    $max = $num_rows;
}

// Get the question ID to display
if ($_POST['id'] != -1) {
    // Not sure if the escape is necessary, but better safe than sorry
    $id = (int) $mysqli->real_escape_string($_POST['id']);

    // Check if the supplied ID is valid
    if ($id < 1 || $id > $num_rows) {
        // If not valid, get a random ID
        $id = rand($min, $max);
    }
} else {
    // If no ID was supplied, get a random ID
    $id = rand($min, $max);
}

// Get the question
$result = $mysqli->query("SELECT * FROM questions WHERE _id=" . $id);
$rows = $result->fetch_assoc();

// Return question as a JSON array
echo json_encode($rows);
?>
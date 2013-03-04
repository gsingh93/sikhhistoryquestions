<?php

// Connect to the database
require_once('config.php');
$mysqli = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);

// Get the number of questions
$result = $mysqli->query("SELECT COUNT(*) FROM questions");
$row = $result->fetch_row();
$num_rows = (int) $row[0];

// Get the question ID to display
if (isset($_POST['id'])) {
  $id = (int) $_POST['id'];

  // Check if the supplied ID is valid
  if ($id < 1 || $id > $num_rows) {
    // If not valid, get a random ID
    $id = rand(1, $num_rows);
  }
} else {
  // If no ID was supplied, get a random ID
  $id = rand(1, $num_rows);
}

// Get the question 
$result = $mysqli->query("SELECT * FROM questions WHERE _id=" . $id);
$rows = $result->fetch_assoc();

// Return question as a JSON array
echo json_encode($rows);
?>
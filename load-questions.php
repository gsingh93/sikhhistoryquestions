<?php
require_once('config.php');

$questions = simplexml_load_file("questions.xml");
$mysqli = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);

$createQuery = "create table questions ( _id int not null auto_increment primary key, question varchar(4000) not null, answer varchar(4000) not null)";

$mysqli->query("DROP TABLE questions");
$mysqli->query($createQuery);

foreach ($questions as $question) {
  $query = "INSERT INTO questions VALUES (" . $question['id'] . ",'" . $question->text . "','" . $question->answer . "')";
  $mysqli->query($query);
}

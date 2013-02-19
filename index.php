<!DOCTYPE html>
  <html>
    <head>
      <title>Sikh History Questions</title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <script>
	function showAnswer() {
	  var answer = document.getElementById("answer");
	  answer.style.visibility="visible";
	}
      </script>
    </head>
    <body>
      <div id="header">
	<div id="header_inner">
	  Sikh History Questions
	</div>
      </div>
      <div id="container">
	<p>
	  Click random question for a new random Sikh history question. The answer will be hidden until you click "Show Answer". If you want to go to a specific question, you will have to save the question number yourself and type the number in the "Specific Question" text box. Questions created by __.
	</p>
	<br>
      <?php
   require_once('config.php');
   $mysqli = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);
	 
      $result = $mysqli->query("SELECT COUNT(*) FROM questions");
      $row = $result->fetch_row();
      $num_rows = (int) $row[0];

      if (isset($_POST['id'])) {
	 $id = (int) $_POST['id'];
         if ($id < 1 || $id > $num_rows) {
	    $id = rand(1, $num_rows);
	 }
      } else {
         $id = rand(1, $num_rows);
      }
      
      $result = $mysqli->query("SELECT * FROM questions WHERE _id=" . $id);
      $rows = $result->fetch_assoc();
      
      ?>
      <div id="question">
      <?php
      echo $rows['_id'];
      echo ".&nbsp;&nbsp;";
      echo $rows['question'];
      echo '<br><br>';
      ?>

      <div id="answer">
      <?php
      echo $rows['answer'];
     ?>
      </div>
      </div>
      <div style="text-align: center">
	<button class="answer-button" onclick="showAnswer()">Show Answer</button>
	<button class="answer-button" onclick="location.reload()">Random Question</button>
	<br><br>
	<span style="font-family: Arial">Specific Question:</span>
	<form style="display: inline" method="post">
	  <input type="text" name="id" size="4">
	  <input type="submit" class="answer-button" value="Go!">
	</form>
      </div>
      </div>
      <div id="footer">
	<p>Please contact Gulshan Singh at gsingh2011@gmail.com for any questions, comments, or errors.</p>
      </div>
    </body>
</html>

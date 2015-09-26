<!DOCTYPE html>
<html>
  <head>
    <title>Sikh History Questions</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div id="header">
      <div id="header_inner">
        Sikh History Questions
      </div>
    </div>
    <?php
      // Connect to the database
      require_once('config.php');
      $mysqli = new mysqli($config['host'], $config['user'], $config['passwd'], $config['db']);

      if (!$mysqli) {
          die($mysqli->connect_error);
      }

      // Get the number of questions
      $result = $mysqli->query("SELECT * FROM " . $config['table']);
      if ($result === false) {
          die($mysqli->error);
      }
      $num_rows = $result->num_rows;
    ?>
    <ol id="selectable">
      <?php while ($row = $result->fetch_assoc()): ?>
        <li class="ui-widget-content"><?php echo $row['_id'] . '. ' . $row['question']; ?></li>
      <?php endwhile; ?>
    </ol>
    <div id="container">
      <p>
        Click random question for a new random Sikh history question. The answer will be hidden until you click "Show Answer". If this site does not display correctly or does not seem to be working correctly for you, please update your browser.
      </p>
      <br>
      <div id="question-wrap">
        <div id="question"></div>
        <div id="answer"></div>
      </div>
      <div class="buttons">
        <button class="answer-button" onclick="showAnswer()">Show Answer</button>
        <button class="answer-button" onclick="getQuestion(-1)">Random Question</button><br>
        <br>
        <form id="range">
          Question Range: <input id="min" name="min" size="4" type="text" value="1"> to <input id="max" name="max" size="4" type="text" value="<?php echo $num_rows; ?>">
        </form>
      </div>
    </div>
    <div id="footer">
      <p>Please contact Gulshan Singh at gsingh2011@gmail.com for any questions, comments, or corrections.</p>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
    <script src="script.js"></script>
    <script>
     var _gaq = _gaq || [];
     _gaq.push(['_setAccount', 'UA-37238415-1']);
     _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();
    </script>
  </body>
</html>

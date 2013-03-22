<!DOCTYPE html>
  <html>
    <head>
      <title>Sikh History Questions</title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <script type="text/javascript"> 
      	      var $buoop = {vs:{i:8,f:12,o:10.6,s:4,n:9}} 
      	      $buoop.ol = window.onload; 
      	      window.onload=function(){ 
      	       try {if ($buoop.ol) $buoop.ol();}catch (e) {} 
               var e = document.createElement("script"); 
	       e.setAttribute("type", "text/javascript"); 
	       e.setAttribute("src", "http://browser-update.org/update.js"); 
	       document.body.appendChild(e); 
	     } 
      </script> 
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
      $mysqli = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);

      // Get the number of questions
      $result = $mysqli->query("SELECT * FROM questions");
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
	    Question Range: <input name="min" size="4" type="text" value="1"> to <input name="max" size="4" type="text" value="<?php echo $num_rows; ?>">
	  </form>
	</div>
      </div>
      <div id="footer">
	<p>Please contact Gulshan Singh at gsingh2011@gmail.com for any questions, comments, or corrections.</p>
      </div>

      <!-- JAVASCRIPT -->

      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
      <script>
	$(function() {
	  $("#selectable").selectable({
	    stop: function() {
              $(".ui-selected").each(function() {
	         var index = $("#selectable li").index(this);
	         getQuestion(index + 1);
       	      });
      	    }});

	  $("#selectable").on("selectableselected", function( event, ui ) {
	     $(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
	  });
	});

	function showAnswer() {
	  var answer = document.getElementById("answer");
	  answer.style.visibility = "visible";
	}
	
	function getQuestion(index) {
	  answer.style.visibility = "hidden";
 	  $('#question').html('<span style="font-family: Arial">Loading question...</span>');
	  dataString = "id=" + index + "&" + $("#range").serialize();
          $.ajax({url: "/sikhhistoryquestions/get-question.php", type: "POST", data: dataString, success : function(data) {
	    data = $.parseJSON(data);

	    var container = $('#selectable');
	    var scrollTo = $("#selectable li").eq(data._id - 1);
	    scrollTo.addClass('ui-selected').siblings().removeClass('ui-selected');
	    container.animate({
    	      scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
	    });
    
	    $('#question').html(data._id + ". " + data.question);
	    $('#answer').html(data.answer);
	  }});
	}

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-37238415-1']);
	_gaq.push(['_trackPageview']);

	(function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

	// Initial call to getQuestion when page is ready
	$(getQuestion(-1));
      </script>
    </body>
</html>

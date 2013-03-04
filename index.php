<!DOCTYPE html>
  <html>
    <head>
      <title>Sikh History Questions</title>
      <link rel="stylesheet" type="text/css" href="style.css">
        <style>
	  #selectable .ui-selecting { background: #FECA40; }
	  #selectable .ui-selected { background: #F39814; color: white; }
	  #selectable { position: absolute; top: 150px; bottom: 0; list-style-type: none; float: left; background: white; width: 200px; border-right: 1px solid grey;}
	  #selectable li { padding: 5px 20px; font-family: "Arial"; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;}
	</style>
    </head>
    <body>
      <div id="header">
	<div id="header_inner">
	  Sikh History Questions
	</div>
      </div>
      <ol id="selectable">
	<li class="ui-widget-content">Item 1 Really long text that won't fit and shoud be ellipsized</li>
	<li class="ui-widget-content">Item 2</li>
	<li class="ui-widget-content">Item 3</li>
	<li class="ui-widget-content">Item 4</li>
	<li class="ui-widget-content">Item 5</li>
	<li class="ui-widget-content">Item 6</li>
	<li class="ui-widget-content">Item 7</li>
      </ol>
      <div id="container">
	<p>
	  Click random question for a new random Sikh history question. The answer will be hidden until you click "Show Answer". If you want to go to a specific question, you will have to save the question number yourself and type the number in the "Specific Question" text box.
	</p>
	<br>
	<div id="question-wrap">
	  <div id="question"></div>
	  <div id="answer"></div>
	</div>
	<div style="text-align: center">
	  <button class="answer-button" onclick="showAnswer()">Show Answer</button>
	  <button class="answer-button" onclick="getQuestion()">Random Question</button>
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
	  $("#selectable").selectable();
	});
      </script>

      <script type="text/javascript">
	function showAnswer() {
	  var answer = document.getElementById("answer");
	  answer.style.visibility = "visible";
	}
	
	function getQuestion() {
	  answer.style.visibility = "hidden";
 	  $('#question').html('<span style="font-family: Arial">Loading question...</span>');
	  $.post("/sikhhistoryquestions/get-question.php", function(data) {
	    data = $.parseJSON(data);
	    $('#question').html(data.question);
	    $('#answer').html(data.answer);
	  });
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
	$(getQuestion());
      </script>
    </body>
</html>

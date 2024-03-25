<!DOCTYPE html>
<html>
<head>
<title>Great Explorers Quiz</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="php_styles.css" type="text/css" />
</head>
<body>
<h1>Quiz Results</h1>
<?php
function scoreQuestions() {
}

if (count($_GET) == 5) {
	$CorrectAnswers = array("b", "d", "a", "b", "c");
	$TotalCorrect = 0;
	$Count = 1;

	foreach ($_GET as $Answer) {
	  echo "<p>Question $Count: $Answer";
	   
	   if ($Answer == $CorrectAnswers[$Count-1]) {
		  echo " (Correct!)</p>";
		  $TotalCorrect++;
		}
		else {
		  echo " (Incorrect)</p>";
		}
		$Count++;
	}

	echo "<p><strong>You scored $TotalCorrect out of 5 answers correctly!</strong></p>";
}
else {
	echo "You did not answer all the questions! Click your browser's Back button to return to the quiz.";
}

scoreQuestions();
?>
</form>
</body>
</html>
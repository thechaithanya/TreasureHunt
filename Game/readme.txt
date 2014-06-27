Instalation Notes:
============================
0. make sure that your PHP server is working properly.
1. chmod to 777 the "data" Directory.
2. chmod to 666 the files in the "data" Directory.

-
Some Explanations:
============================

- The first member that registere is admin
- There can be only one admin, and he cannot be deleted
- First player to answer will get max_score and all the subsequent answers will be awarded 50 points less than previous one. (Eg: first 1000, then 950, 900, etc).
- If you want to hange this value, goto "game.php" in modules and change the value of "$dec" to desired value. If you dont want to decrement the score, set it to ZERO.

-------------------------------
Add Questions:
========================
- Open the file named "questions.php" in "data" directory
- Add questions in the followinf format
	- question_no|question|answer|0|max_score|
	- If you want to display image in the question, replace '0' with any question number

Set mindex.php as home page, when you are making some modifications to website.

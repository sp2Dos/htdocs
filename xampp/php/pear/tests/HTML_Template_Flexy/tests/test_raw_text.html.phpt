--TEST--
Template Test: raw_text.html
--FILE--
<?php
require_once 'testsuite.php';
compilefile('raw_text.html');

--EXPECTF--
===Compiling raw_text.html===



===Compiled file: raw_text.html===
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
 
<body>
<h2>Example Template for HTML_Template_Flexy</h2>

 a full string example ~!@#$%^&*() |": ?\][;'/.,=-_+ ~` abcd....
 asfasfdas
 
 
 
<h2>Bugs: 809 Comments:</h2>


<!--- this is a comment with alot of stuff.. --# ---->

<!-- this is a comment with alot of stuff.. --# -- -->



</body>
</html>
 

===With data file: raw_text.html===
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
 
<body>
<h2>Example Template for HTML_Template_Flexy</h2>

 a full string example ~!@#$%^&*() |": ?\][;'/.,=-_+ ~` abcd....
 asfasfdas
 
 
 
<h2>Bugs: 809 Comments:</h2>


<!--- this is a comment with alot of stuff.. --# ---->

<!-- this is a comment with alot of stuff.. --# -- -->



</body>
</html>
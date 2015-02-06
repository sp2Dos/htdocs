<?php 
/**
 * Horizontal String ProgressBar example.
 * 
 * @version    $Id: horizontal_string.php,v 1.1 2003/11/15 18:27:10 thesaur Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 */

require_once ('HTML/Progress.php');

$bar = new HTML_Progress();
$bar->setIncrement(5);
$bar->setStringPainted(true);          // get space for the string
$bar->setString('');                   // but don't paint it

$ui =& $bar->getUI();
$ui->setStringAttributes('width=350 align=left');

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Horizontal String ProgressBar example</title>
<style type="text/css">
<!--
<?php echo $bar->getStyle(); ?>

body {
	background-color: #FFFFFF;
	color: #000000;
	font-family: Verdana, Arial;
}

a:visited, a:active, a:link {
	color: navy;
}
// -->
</style>
<script type="text/javascript">
<!--
<?php echo $bar->getScript(); ?>
//-->
</script>
</head>
<body>
<h1><?php echo basename(__FILE__); ?></h1>

<?php 
echo $bar->toHtml(); 

$pkg = array('PEAR', 'Archive_Tar', 'Config', 
    'HTML_QuickForm', 'HTML_CSS', 'HTML_Page', 'HTML_Template_Sigma', 
    'Log', 'MDB', 'PHPUnit');

do {
    $val = $bar->getValue();
    $i = floor($val / 10);
    $msg = ($val == 100) ? '' : "&nbsp; installing package ($val %) ... : ".$pkg[$i];
    $bar->setString($msg);

    $bar->display();
    if ($bar->getPercentComplete() == 1) {
        break;   // the progress bar has reached 100%
    }
    $bar->incValue();
} while(1);
?>

<p>&lt;&lt; <a href="index.html">Back examples TOC</a></p>

<h2>print_r </h2>
<pre>
<?php 
print_r($bar->toArray()); 
?>
</pre>

</body>
</html>
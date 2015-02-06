<?php 
/**
 * ProgressBar model example.
 * 
 * @version    $Id: constructor_model.php,v 1.1 2003/11/15 18:27:10 thesaur Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 */

require_once ('HTML/Progress.php');

class TimerProgress extends HTML_Progress_DM
{
    function TimerProgress()
    {       
        $this->HTML_Progress_DM(0,60,5);
    }
}

$timer = new TimerProgress();
$bar = new HTML_Progress($timer);
$bar->setStringPainted(true);          // get space for the string
$bar->setString('');                   // but don't paint it

$ui =& $bar->getUI();
$ui->setStringAttributes('width=170 height=20 valign=bottom align=center');

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>ProgressBar model example</title>
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

do {
    $bar->display();
    if ($bar->getPercentComplete() == 1) {
        $bar->setString('All done!');
        $bar->display();
        break;   // the progress bar has reached 100%
    }
    if ($bar->getPercentComplete() == 0.25) {
        $bar->setString('Fourth part way done!');
    }
    if ($bar->getPercentComplete() == 0.5) {
        $bar->setString('Half way done!');
    }
    if ($bar->getPercentComplete() == 0.75) {
        $bar->setString('Three quarters way done!');
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
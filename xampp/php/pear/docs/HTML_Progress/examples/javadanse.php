<?php 
/**
 * 20 cells Reverse Horizontal ProgressBar example with JavaScript customization.
 * 
 * @version    $Id: javadanse.php,v 1.1 2003/11/15 18:27:10 thesaur Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 */

require_once ('HTML/Progress.php');

$bar = new HTML_Progress();
$bar->setIncrement(5);
$bar->setBorderPainted(true);

$ui =& $bar->getUI();
$ui->setFillWay('reverse');
$ui->setCellCount(20);
$ui->setCellAttributes('active-color=#970038 inactive-color=#FFDDAA width=20 height=20');
$ui->setBorderAttributes('width=1 color=#000000');
$ui->setStringAttributes('width=440 font-size=14 color=#FF0000 align=center valign=bottom');
$ui->setScript('progress_number.js');

foreach (range(0,2) as $index) {
    $ui->setCellAttributes('color=red', $index);
}
foreach (range(3,6) as $index) {
    $ui->setCellAttributes('color=yellow', $index);
}
foreach (range(7,9) as $index) {
    $ui->setCellAttributes('color=white ', $index);
}

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>JavaDanse Progress example</title>
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
<script type="text/javascript" src="<?php echo $bar->getScript(); ?>"></script>
</head>
<body>
<h1><?php echo basename(__FILE__); ?></h1>

<?php 
echo $bar->toHtml(); 

do {
    $bar->display();
    if ($bar->getPercentComplete() == 1) {
        break;   // the progress bar has reached 100%
    }
    $bar->incValue();
} while(1);
?>

<p>&lt;&lt; <a href="index.html">Back examples TOC</a></p>

</body>
</html>
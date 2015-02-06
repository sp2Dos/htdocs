<?php
/**
 * Basic Horizontal ProgressBar
 * with a simple text label on top side (using absolute position).
 *
 * @version    $Id: text2.php,v 1.3 2005/08/18 13:13:11 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress2
 * @subpackage Examples
 * @access     public
 * @example    examples/label/text2.php
 *             text2 source code
 * @link       http://www.laurent-laville.org/img/progress/screenshot/labeltext2.png
 *             screenshot (Image PNG, 722x262 pixels) 5.96 Kb
 */
require_once 'HTML/Progress2.php';

$pb = new HTML_Progress2();
$pb->setAnimSpeed(300);
$pb->setIncrement(10);
$pb->setProgressAttributes(array(
    'position' => 'absolute',
    'left' => 450,
    'top' => 80
));

$pct1 = array('left' => 120, 'top' => 25);
$pb->setLabelAttributes('pct1', $pct1);

// Adds additional text label
$pb->addLabel(HTML_PROGRESS2_LABEL_TEXT, 'txt1', 'Progress2 (c) 2005');
$pb->setLabelAttributes('txt1', array(
    'left' => 0,
    'top' => -16,
    'color' => 'navy'
));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Text Label absolute Progress2 example</title>
<style type="text/css">
<!--
<?php echo $pb->getStyle(); ?>

body {
    background-color: #E0E0E0;
    color: #000000;
    font-family: Verdana, Arial;
}
// -->
</style>
<?php echo $pb->getScript(false); ?>
</head>
<body>
<p style="background-color:lightblue;
          width:500px;height:150px;
          text-align:center;">
500x150</p>
<h1>Text and Percent Labels using absolute position </h1>

<?php
echo $pb->toHtml();
$pb->run();
?>

<p>Process Ended !</p>

</body>
</html>
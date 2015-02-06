<?php
/**
 * Basic Horizontal ProgressBar
 * with a simple percent label on right side (using absolute position).
 *
 * @version    $Id: percent2.php,v 1.3 2005/08/18 13:13:11 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress2
 * @subpackage Examples
 * @access     public
 * @example    examples/label/percent2.php
 *             percent2 source code
 * @link       http://www.laurent-laville.org/img/progress/screenshot/labelpercent2.png
 *             screenshot (Image PNG, 690x318 pixels) 5.25 Kb
 */
require_once 'HTML/Progress2.php';

$pb = new HTML_Progress2();
$pb->setAnimSpeed(300);
$pb->setIncrement(10);
$pb->setProgressAttributes(array(
    'position' => 'absolute',
    'left' => 350,
    'top' => 100)
);
$pct1 = array('width' => 0, 'left' => 180);
$pb->setLabelAttributes('pct1', $pct1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Percent Label absolute Progress2 example</title>
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
<p style="background-color:orange;
          width:400px;height:200px;
          text-align:center;">
400x200</p>
<h1>Percent Label using absolute position </h1>
<p>Progress bar is positionned at coordinates x=350, y=100</p>

<?php
echo $pb->toHtml();
$pb->run();
$pb->hide();
?>

<p>Process Ended !</p>

</body>
</html>
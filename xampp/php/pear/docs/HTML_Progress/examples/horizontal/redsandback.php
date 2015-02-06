<?php
/**
 * 5 cells Reverse Horizontal ProgressBar example with red skin.
 * See also ProgressMaker usage with pre-set UI model 'RedSandBack'.
 *
 * @version    $Id: redsandback.php,v 1.2 2005/07/25 10:25:30 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 * @subpackage Examples
 */

require_once 'HTML/Progress.php';

$bar = new HTML_Progress();
$bar->setAnimSpeed(100);
$bar->setIncrement(10);
$bar->setBorderPainted(true);

$ui =& $bar->getUI();
$ui->setTab('    ');
$ui->setFillWay('reverse');
$ui->setCellCount(5);
$ui->setCellAttributes('active-color=#970038 inactive-color=#FFDDAA width=20');
$ui->setBorderAttributes('width=1 color=#000000');
$ui->setStringAttributes('font-size=14 color=#FF0000 align=left valign=bottom');
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>RedSandBack Progress example</title>
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

<?php
echo $bar->toHtml();
$bar->run();
?>

</body>
</html>
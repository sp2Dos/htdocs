<?php
/**
 * Natural Horizontal ProgressBar example with blue skin.
 * See also ProgressMaker usage with pre-set UI model 'BlueSand'.
 *
 * @version    $Id: bluesand.php,v 1.2 2005/07/25 10:25:30 farell Exp $
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
$ui->setCellAttributes('active-color=#3874B4 inactive-color=#EEEECC width=10');
$ui->setBorderAttributes('width=1 color=navy');
$ui->setStringAttributes('width=60 font-size=14 background-color=#EEEEEE align=center');
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>BlueSand Progress example</title>
<style type="text/css">
<!--
<?php echo $bar->getStyle(); ?>

body {
    background-color: #EEEEEE;
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
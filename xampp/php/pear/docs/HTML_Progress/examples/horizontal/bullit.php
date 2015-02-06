<?php
/**
 * Natural Horizontal plain ProgressBar example.
 * See also ProgressMaker usage with pre-set UI model 'Bullit'.
 *
 * @version    $Id: bullit.php,v 1.2 2005/07/25 10:25:30 farell Exp $
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
$ui->setCellAttributes('active-color=#000084 inactive-color=#3A6EA5 width=20 spacing=0');
$ui->setBorderAttributes('width=1 style=inset color=white');
$ui->setStringAttributes(array(
    'width' => 200,
    'height' => 20,
    'font-size' => 14,
    'background-color' => '#C3C6C3',
    'valign' => 'top'
));
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Bullit Progress example</title>
<style type="text/css">
<!--
<?php echo $bar->getStyle(); ?>

body {
    background-color: #C3C6C3;
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
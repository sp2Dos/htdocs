<?php
/**
 * Basic Horizontal ProgressBar v0.5 style example.
 * See also ProgressMaker usage with pre-set UI model 'Ancestor'.
 *
 * @version    $Id: ancestor.php,v 1.2 2005/07/25 10:25:30 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 * @subpackage Examples
 */

require_once 'HTML/Progress.php';

$bar = new HTML_Progress();
$bar->setAnimSpeed(100);
$bar->setIncrement(10);

$ui =& $bar->getUI();
$ui->setTab('    ');
$ui->setStringAttributes('width=60 font-size=14 align=center');
?>
<html>
<head>
<title>Ancestor Progress example</title>
<style type="text/css">
<!--
<?php echo $bar->getStyle(); ?>

body {
    background-color: #444444;
    color: #EEEEEE;
    font-family: Verdana, Arial;
}

a:visited, a:active, a:link {
    color: yellow;
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
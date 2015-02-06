<?php
/**
 * Basic vertical progress bar.
 *
 * @version    $Id: vlimit.php,v 1.3 2005/08/18 13:49:21 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress2
 * @subpackage Examples
 * @access     public
 * @example    examples/vertical/vlimit.php
 *             vlimit source code
 * @link       http://www.laurent-laville.org/img/progress/screenshot/vlimit.png
 *             screenshot (Image PNG, 80x190 pixels) 616 bytes
 */
require_once 'HTML/Progress2.php';

$pb = new HTML_Progress2();
$pb->setOrientation(HTML_PROGRESS2_BAR_VERTICAL);
$pb->setAnimSpeed(200);
$pb->setValue(75);
$pb->setLabelAttributes('pct1', array('top' => 80));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>VLimit Progress2 example</title>
<style type="text/css">
<!--
<?php echo $pb->getStyle(); ?>

body {
    background-color: #FFFFFF;
}
// -->
</style>
<?php echo $pb->getScript(false); ?>
</head>
<body>

<?php
$pb->display();
$pb->run();
?>

</body>
</html>
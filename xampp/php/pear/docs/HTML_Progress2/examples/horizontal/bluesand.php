<?php
/**
 * Natural horizontal ProgressBar with blue skin.
 *
 * @version    $Id: bluesand.php,v 1.3 2005/08/18 12:58:43 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress2
 * @subpackage Examples
 * @access     public
 * @example    examples/horizontal/bluesand.php
 *             bluesand source code
 * @link       http://www.laurent-laville.org/img/progress/screenshot/bluesand.png
 *             screenshot (Image PNG, 190x40 pixels) 352 bytes
 */
require_once 'HTML/Progress2.php';

$pb = new HTML_Progress2();
$pb->setAnimSpeed(200);
$pb->setIncrement(10);
$pb->setCellAttributes('active-color=#3874B4 inactive-color=#EEEECC width=10');
$pb->setBorderPainted(true);
$pb->setBorderAttributes('width=1 color=navy');
$pb->setLabelAttributes('pct1', array(
    'width' => 60,
    'font-size' => 14,
    'align' => 'center'
));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>BlueSand Progress2 example</title>
<style type="text/css">
<!--
<?php echo $pb->getStyle(); ?>

body {
    background-color: #EEEEEE;
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
<?php
/**
 * Custom Circle Reverse Progress example.
 *
 * @version    $Id: circleback.php,v 1.2 2005/07/25 11:19:41 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 * @subpackage Examples
 */

require_once 'HTML/Progress.php';

$bar = new HTML_Progress(HTML_PROGRESS_CIRCLE);
$bar->setAnimSpeed(100);
$bar->setIncrement(10);

$ui =& $bar->getUI();
$ui->setfillway('reverse');
$ui->setStringAttributes('font-size=20 width=100');
$ui->setCellAttributes(array(
    'width' => 100,
    'height' => 100,
    'spacing' => 0,
    'inactive-color' => 'navy',
    'active-color' => 'red'
    )
);

if (file_exists('../temp/cb0.png')) {
    // uses cached files rather than create it again and again
    foreach (range(0,10) as $index) {
        $ui->setCellAttributes(array('background-image' => '../temp/cb'.$index.'.png'),$index);
    }
} else {
    // creates circle segments pictures only once
    $ui->drawCircleSegments('../temp', 'cb%s.png');
}
?>
<html>
<head>
<title>Custom Circle Reverse ProgressBar example</title>
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
<?php echo $ui->getScript(); ?>
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
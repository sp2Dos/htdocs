<?php
/**
 * Horizontal String ProgressBar example.
 *
 * @version    $Id: string.php,v 1.2 2005/07/25 10:25:30 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 * @subpackage Examples
 */

require_once 'HTML/Progress.php';

$pkg = array('PEAR', 'Archive_Tar', 'Config',
    'HTML_QuickForm', 'HTML_CSS', 'HTML_Page', 'HTML_Template_Sigma',
    'Log', 'MDB', 'PHPUnit');

function myFunctionHandler($progressValue, &$obj)
{
    global $pkg;

    $obj->sleep();
    $i = floor($progressValue / 10);
    if ($progressValue == 100) {
        $msg = '';
    } else {
        $msg = "&nbsp; installing package ($progressValue %) ... : ".$pkg[$i];
    }
    $obj->setString($msg);
}

$bar = new HTML_Progress();
$bar->setAnimSpeed(100);
$bar->setIncrement(5);
$bar->setStringPainted(true);          // get space for the string
$bar->setString('');                   // but don't paint it
$bar->setProgressHandler('myFunctionHandler');

$ui =& $bar->getUI();
$ui->setTab('    ');
$ui->setStringAttributes('width=350 align=left');
?>
<html>
<head>
<title>Horizontal String ProgressBar example</title>
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
$bar->display();  // to display the last custom string (blank)
?>

</body>
</html>
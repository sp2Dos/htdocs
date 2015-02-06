<?php
/**
 * Horizontal ProgressBar in indeterminate mode
 * using the Progress_Monitor V2 solution (with QF renderer).
 *
 * @version    $Id: half_monitor.php,v 1.3 2005/07/25 11:33:24 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 * @subpackage Examples
 */

require_once 'HTML/Progress/monitor.php';

function myProgressHandler($progressValue, &$bar)
{
    global $monitor;
    static $c;

    if (!isset($c)) {
        $c = 0;
    }
    $c += 16;
    $monitor->setCaption("completed $c out of 400");

    $bar->sleep();
    /* rules to determine when switch back from indeterminate to determinate mode */
    if ($c >= 240 && $bar->isIndeterminate()) {
        $bar->setIndeterminate(false);
        $bar->setString(null);           // show percent-info
        $bar->setValue(0);
    }
    if ($bar->getPercentComplete() == 1) {
        if ($bar->isIndeterminate()) {
            $bar->setValue(0);
        } else {
            $bar->setString('');            // hide percent-info
        }
    }
}

$monitor = new HTML_Progress_Monitor('frmMonitor',
    array( 'button' => array('style' => 'width:80px;'),
           'title'  => 'Progress ...' )
);

// Attach a progress bar custom model
$progress = new HTML_Progress();
$ui = & $progress->getUI();
$ui->setProgressAttributes(array(
    'background-color' => '#e0e0e0'
));
$ui->setStringAttributes(array(
    'color'  => '#996',
    'background-color' => '#CCCC99'
));
$ui->setCellAttributes(array(
    'active-color' => '#996'
));

$progress->setAnimSpeed(100);
$progress->setIncrement(10);
$progress->setStringPainted(true);     // get space for the string
$progress->setString("");              // but don't paint it
$progress->setIndeterminate(true);     // Progress start in indeterminate mode
// your custom user process goes here !
$progress->setProgressHandler('myProgressHandler');

$monitor->setProgressElement($progress);
?>
<html>
<head>
<title>Indeterminate Mode Progress example</title>
<style type="text/css">
<!--
.progressStatus {
    color:#000000;
    font-size:10px;
}

body {
    background-color: #444444;
    color: #EEEEEE;
    font-family: Verdana, Arial;
}

a:visited, a:active, a:link {
    color: yellow;
}

<?php echo $monitor->getStyle(); ?>
// -->
</style>
<script type="text/javascript">
<!--
<?php echo $monitor->getScript(); ?>
//-->
</script>
</head>
<body>

<?php
$renderer =& HTML_QuickForm::defaultRenderer();
$renderer->setFormTemplate('
<form{attributes}>
  <table width="450" border="0" cellpadding="3" cellspacing="2" bgcolor="#CCCC99">
  {content}
  </table>
</form>
');
$renderer->setHeaderTemplate('
  <tr>
    <td style="white-space:nowrap;background:#996;color:#ffc;" align="left" colspan="2"><b>{header}</b></td>
  </tr>
');
$monitor->accept($renderer);

// Display progress monitor dialog box
echo $renderer->toHtml();
$monitor->run();
?>

</body>
</html>
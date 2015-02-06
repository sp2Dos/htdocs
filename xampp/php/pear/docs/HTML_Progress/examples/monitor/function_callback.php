<?php
/**
 * Monitor example with a new form template and progress bar
 * color scheme. Used a function as user callback.
 *
 * @version    $Id: function_callback.php,v 1.3 2005/08/28 14:57:57 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 * @subpackage Examples
 */

require_once 'HTML/Progress/monitor.php';

/**
 * @ignore
 */
class Progress_ITDynamic extends HTML_Progress_UI
{
    function Progress_ITDynamic()
    {
        parent::HTML_Progress_UI();

        $this->setCellCount(20);
        $this->setProgressAttributes('background-color=#EEE');
        $this->setStringAttributes('background-color=#EEE color=navy');
        $this->setCellAttributes('inactive-color=#FFF active-color=#444444');
    }
}

function myFunctionHandler($progressValue, &$bar)
{
    global $monitor;

    $bar->sleep();
    if (!$bar->isIndeterminate()) {
        if (fmod($progressValue,10) == 0) {
            $monitor->setCaption("myFunctionHandler -> progress value is = $progressValue");
        }
    } else {
        /* in case we have attached an indeterminate progress bar to the monitor ($obj)
           after a first pass that reached 60%,
           we swap from indeterminate mode to determinate mode
           and run a standard progress bar from 0 to 100%
        */
        if ($progressValue == 60) {
            $bar->setIndeterminate(false);
            $bar->setString(null);           // show percent-info
            $bar->setValue(0);
        }
    }
}

$monitor = new HTML_Progress_Monitor('frmMonitor4', array(
    'button' => array('style' => 'width:80px;')
    )
);

$progress = new HTML_Progress();
$progress->setAnimSpeed(20);
$progress->setUI('Progress_ITDynamic');// Attach a progress ui-model
$progress->setStringPainted(true);     // get space for the string
$progress->setString("");              // but don't paint it
$progress->setIndeterminate(true);     // Progress start in indeterminate mode
$progress->setProgressHandler('myFunctionHandler');

$monitor->setProgressElement($progress);
?>
<html>
<head>
<title>ProgressBar Monitor - Default renderer </title>
<style type="text/css">
<!--
body {
    background-color: lightgrey;
    font-family: Verdana, Arial;
}
.progressStatus {
    color: navy;
    font-size:10px;
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
  <table width="450" border="0" cellpadding="3" cellspacing="2" bgcolor="#EEEEEE">
  {content}
  </table>
</form>
');
$renderer->setHeaderTemplate('
  <tr>
    <td style="white-space:nowrap;background:#7B7B88;color:#ffc;" align="left" colspan="2"><b>{header}</b></td>
  </tr>
');
$monitor->accept($renderer);

echo $renderer->toHtml();
$monitor->run();
?>

</body>
</html>
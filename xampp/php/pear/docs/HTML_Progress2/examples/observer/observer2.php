<?php
/**
 * Complex observer pattern for progress meter.
 * Uses a custom observer to log second progress bar process.
 *
 * @version    $Id: observer2.php,v 1.4 2005/08/18 13:37:34 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress2
 * @subpackage Examples
 * @access     public
 * @example    examples/observer/observer2.php
 *             observer2 source code
 * @link       http://www.laurent-laville.org/img/progress/screenshot/observer2.png
 *             screenshot (Image PNG, 438x216 pixels) 1.36 Kb
 */
require_once 'HTML/Progress2.php';

function getmicrotime($time)
{
    list($usec, $sec) = explode(' ', $time);
    return ((float)$usec + (float)$sec);

}

// 1. Defines custom observer pattern
function myProgressObserver(&$notification)
{
    static $fileCount = 0;

    $notifyName = $notification->getNotificationName();
    $notifyInfo = $notification->getNotificationInfo();

    if (strcasecmp($notifyName, 'onChange') == 0) {
        if (strcasecmp($notifyInfo['handler'], 'moveNext') == 0) {
            if ($notifyInfo['value'] < 100) {
                $fileCount++;
                $timestamp = getmicrotime($notifyInfo['time']);
                $msg = sprintf('file #%s was proceed on %s', $fileCount, date('r', $timestamp));
                error_log ($msg . PHP_EOL, 3, 'observer2.log');
            }
        }
    }
}

// 2. Creates progress bars
$pb1 = new HTML_Progress2();
$pb1->setIdent('PB1');
$pb1->setComment('Complex Observer Progress2 example');
$pb1->setTabOffset(1);
$pb1->setOrientation(HTML_PROGRESS2_BAR_VERTICAL);
$pb1->setAnimSpeed(100);
$pb1->setIncrement(10);
$pb1->setProgressAttributes('position=absolute top=5 left=100');

$pb2 = new HTML_Progress2();
$pb2->setIdent('PB2');
$pb2->setTabOffset(1);
$pb2->setOrientation(HTML_PROGRESS2_BAR_VERTICAL);
$pb2->setAnimSpeed(100);
$pb2->setIncrement(25);
$pb2->setProgressAttributes('position=absolute top=5 left=250');

// 3. Attach an observer
$pb2->addListener('myProgressObserver');

// 4. Changes look-and-feel of progress bars
$pb1->setProgressAttributes('background-color=#E0E0E0');
$pb1->setLabelAttributes('pct1', array(
    'top' => 85,
    'left' => -50,
    'color'  => 'red'
));

$pb2->setBorderPainted(true);
$pb2->setBorderAttributes(array(
    'width' => 1,
    'color' => 'navy'
));
$pb2->setCellAttributes(array(
    'active-color' => '#3874B4',
    'inactive-color' => '#EEEECC'
));
$pb2->setLabelAttributes('pct1', array(
    'top' => 85,
    'left' => 15,
    'width'  => 100,
    'align'  => 'center',
    'color'  => 'yellow'
));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Complex Observer Progress2 example</title>
<style type="text/css">
<!--
<?php
echo $pb1->getStyle();
echo $pb2->getStyle();
?>
div.container {
    position: absolute;
    left: 40px;
    top: 80px;
    width: 400px;
    height: 190px;
    background-color: lightblue;
    border: 2;
    border-color: navy;
    border-style: dashed;
}
// -->
</style>
<?php echo $pb1->getScript(false); ?>
</head>
<body>

<div class="container">
<?php
$pb1->display();
$pb2->display();
?>
</div>

<?php
do {
    $pb1->process();    // warning: don't forget it (even for a demo)
    if ($pb1->getPercentComplete() == 1) {
        // the 1st progress bar has reached 100%, do a new loop
        $pb1->moveStep(0);
        // updates $pb2 because $pb1 has completed a full loop
        $pb2->moveNext();
    } else {
        $pb1->moveNext();   // updates 1st progress bar
    }
} while($pb2->getPercentComplete() < 1);
?>

</body>
</html>
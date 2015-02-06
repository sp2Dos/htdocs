<?php
/**
 * PEAR::HTML_Page package made it easy to build
 * a very simple ProgressBar Monitor.
 *
 * @version    $Id: htmlpage.php,v 1.2 2005/07/25 12:15:50 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 * @subpackage Examples
 */

require_once 'HTML/Progress/monitor.php';
require_once 'HTML/Page.php';

$p = new HTML_Page(array(
        'charset'  => 'utf-8',
        'lineend'  => OS_WINDOWS ? 'win' : 'unix',
        'doctype'  => "XHTML 1.0 Strict",
        'language' => 'en',
        'cache'    => 'false'
     ));

$p->setTitle("PEAR::HTML_Progress - Simple Monitor demo");
$p->setMetaData("author", "Laurent Laville");

$progressMonitor = new HTML_Progress_Monitor();

$bar =& $progressMonitor->getProgressElement();
$bar->setAnimSpeed(20);

$p->addStyleDeclaration(
    $progressMonitor->getStyle()
    );
$p->addScriptDeclaration(
    $progressMonitor->getScript()
    );
$p->addBodyContent(
    '<h1>PEAR::HTML_Page renderer without user-callback</h1>'
    );
$p->addBodyContent(
    $progressMonitor->toHtml()
    );
$p->display();

$progressMonitor->run();
?>
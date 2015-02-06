<?php
/**
 * PEAR::HTML_Page2 package made it easy to build
 * a very simple Progress2 Monitor.
 *
 * @version    $Id: monitorpg2.php,v 1.2 2005/08/18 13:30:53 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress2
 * @subpackage Examples
 * @access     public
 * @example    examples/monitor/monitorpg2.php
 *             monitorpg2 source code
 * @link       http://www.laurent-laville.org/img/progress/screenshot/monitordef.png
 *             screenshot (same as monitordef)
 */
require_once 'HTML/Progress2/Monitor.php';
require_once 'HTML/Page2.php';

$p = new HTML_Page2(array(
        'charset'  => 'utf-8',
        'lineend'  => PHP_EOL,
        'doctype'  => "XHTML 1.0 Strict",
        'language' => 'en',
        'cache'    => 'false'
     ));

$p->setTitle('PEAR::HTML_Progress2 - Simple Monitor');
$p->setMetaData('author', 'Laurent Laville');

$pm = new HTML_Progress2_Monitor();

$bar =& $pm->getProgressElement();
$bar->setAnimSpeed(50);

$p->addStyleDeclaration(
    $pm->getStyle()
    );
$p->addScriptDeclaration(
    $pm->getScript()
    );
$p->addBodyContent(
    $pm->toHtml()
    );
echo $p->toHtml();

$pm->run();
?>
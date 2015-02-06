<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997 - 2003 The PHP Group                              |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Author:  Klaus Guenther <klaus@capitalfocus.org>                     |
// +----------------------------------------------------------------------+
//
// $Id: CSS_InHeader.php,v 1.1 2003/07/31 14:58:19 thesaur Exp $

require_once 'HTML/Page.php';
require_once 'HTML/CSS.php';

// generate an instance
$css = new HTML_CSS();

// define the various settings for <body>
$css->setStyle('body', 'background-color', '#0c0c0c');
$css->setStyle('body', 'color', '#ffffff');
// define <h1> element
$css->setStyle('h1', 'text-align', 'center');
$css->setStyle('h1', 'font', '16pt helvetica, arial, sans-serif');
// define <p> element
$css->setStyle('p', 'font', '12pt helvetica, arial, sans-serif');

// create a new HTML page
$p = new HTML_Page();
$p->setTitle("My page");
// it can be added as an object
$p->addStyleDeclaration(&$css, 'text/css');
$p->addMetaData("author", "My Name");
$p->addBodyContent = "<h1>headline</h1>";
$p->addBodyContent = "<p>some text</p>";
$p->addBodyContent = "<p>some more text</p>";
$p->addBodyContent = "<p>yet even more text</p>";
$p->display();
?>
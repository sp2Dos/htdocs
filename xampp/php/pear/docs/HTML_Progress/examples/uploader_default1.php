<?php
/**
 * Standard Default Upload ProgressBar example.
 *
 * @version    $Id: uploader_default1.php,v 1.1 2004/02/14 22:07:25 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_Progress
 */

require_once 'HTML/Progress/uploader.php';

// Account FTP on remote server
$ftp = array(
    'user' => 'farell',
    'pass' => 'xxxxxx',
    'host' => 'ftpperso.free.fr'
);

// A standard progress uploader dialog box 
$uploader = new HTML_Progress_Uploader();

// Allow only pictures upload
$uploader->setValidExtensions(array('gif','jpg','jpeg','png'));
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Web-FTP Uploader with ProgressBar - Default renderer </title>
<style type="text/css">
<!--
.progressStatus {
	color:#000000; 
	font-size:10px;
}
<?php echo $uploader->getStyle(); ?>
// -->
</style>
<script type="text/javascript">
<!--
<?php echo $uploader->getScript(); ?>
//-->
</script>
</head>
<body>

<?php 
// Display progress uploader dialog box
echo $uploader->toHtml();


if ($uploader->isStarted()) {
// Begin upload

    // declare files to upload    
    $uploader->setFiles(array(
        'splintercell.jpg',
        'd:/Mes Documents/Mes images/black hawk down/00010484.jpg',
        'monitor.html'       // NOTE: invalid file extension, won't be uploaded
        )
    );

    // connect to ftp server
    $logs = $uploader->logon($ftp['user'], $ftp['pass'], $ftp['host']);
    if (PEAR::isError($logs)) {
        die($logs->getMessage());
    }    

    // set timeout as a default ftp connection
    set_time_limit(90);

    $ret = $uploader->moveTo('tmp', false);  // do not replace existing files (default)
    if (PEAR::isError($ret)) {
        die($ret->getMessage());
    }    

    // summary of uploads operation
    if (count($ret) == 0) {
        echo '<i>All files were move on to ' . $ftp['host'] . "</i><br/>\n";
    } else {
        echo '<b>Some files were not move on to ' . $ftp['host'] . "</b><br/>\n";
        print "<pre>";
        var_dump($ret);
        print "</pre>";
    }

    // disconnect from ftp server
    $uploader->logoff();
}

if ($uploader->isCanceled()) {
    $uploader->logoff();     // disconnect from ftp server before a timeout has occured
}
?>

</body>
</html>
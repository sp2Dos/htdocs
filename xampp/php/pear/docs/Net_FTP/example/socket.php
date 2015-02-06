<pre>
<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Net_FTP_Socket example.
 *
 * Example for the usage of Net_FTP's socket implementation of the
 * ext/FTP functions.'
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Networking
 * @package    FTP
 * @author     Tobias Schlitt <toby@php.net>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    CVS: $Id: socket.php,v 1.3 2005/02/23 12:12:23 toby Exp $
 * @link       http://pear.php.net/package/Net_FTP
 * @since      File available since Release 1.3.0
 */

if(isset($_GET['native'])) {
    @dl('ftp.so');
}

// Configuration

# Login info
$host = 'localhost';
$user = 'pub';
$pass = 'public';

# Passive mode on/off
$pasv = false;

# List directory
$dir = 'episodes/';

# Upload files
$Uasci   = basename($_SERVER['PHP_SELF']);
$Ubinary = 'screenshot.jpg';

// End of configuration

list($usec,$sec) = explode(' ', microtime());
$time = (float)$usec + (float)$sec;

   /**
* Function used by the test suit.
* Takes in boolean parameter and returns as string
*/
function BoolToString($bool)
{
    return $bool == true ? 'TRUE' : 'FALSE';
}
/**
* Function used by the test suit.
* Spits out test results in readable way
*/
function dump($action, $result, $msg = false)
{
    if (is_bool($result)) {
        $result = BoolToString($result);
    }

    if (is_array($result)) {
        echo '<strong>' .$action. ':</strong>' ."\n";
        foreach($result as $key => $value) {
            echo ' ' .$key. ': ' .$value. "\n";
        }
    }
    else {
        echo '<strong>' .$action. '</strong>:' ."\n";
        echo $result;
        if ($msg) {
            echo ' ( ' .$msg. ' )';
        }
        echo "\n";
    }

    echo '<hr style="border: 1px solid #000;"/>';# . "\n";
    flush();
}

/**
* Little test suit
*/
$stream = ftp_connect($host);
if (is_resource($stream)) {
    dump ('Logging in', $bool = ftp_login($stream, $user, $pass));
    if ( $bool ) {
        dump('PWD',             ftp_pwd    ($stream));
        dump('Systype',         ftp_systype($stream));
        dump('CHDIR "'.$dir.'"',ftp_chdir  ($stream, $dir));
        dump('PWD',             ftp_pwd    ($stream));
        dump('CDUP',            ftp_cdup   ($stream));
        dump('PASSIVE',         ftp_pasv   ($stream, $pasv));
        dump('RAWLIST "."',     ftp_rawlist($stream, '.'));
        dump('CHMOD',           ftp_chmod  ($stream, 0777, 'sfv3.php'));
        dump('ALLOCATE',        ftp_alloc  ($stream, filesize($Ubinary), $msg), $msg);
        dump('UPLOAD ASCII',    ftp_put    ($stream, $Uasci, $Uasci, FTP_ASCII), $Uasci);
        dump('UPLOAD BINARY',   ftp_put    ($stream, $Ubinary, $Ubinary, FTP_BINARY), $Ubinary);
        dump('RAWLIST "."',     ftp_rawlist($stream, '.'));
        dump('DELETE '.$Uasci,  ftp_delete ($stream, $Uasci));
        dump('DELETE '.$Bbinary,ftp_delete ($stream, $Ubinary));
        dump('RAWLIST "."',     ftp_rawlist($stream, '.'));
    }
    dump('QUIT',                ftp_quit   ($stream));
}

list($usec, $sec) = explode(' ', microtime());
$end = (float)$usec + (float)$sec;
echo $end-$time;
?>

</pre>

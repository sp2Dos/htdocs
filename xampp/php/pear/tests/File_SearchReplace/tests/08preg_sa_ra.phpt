--TEST--
File_SearchReplace Preg mode; s/r - arrays, but replacement is shorter
--SKIPIF--
<?php 
include('./setup.php');
print $status; 
?>
--FILE--
<?php 
require_once('./setup.php');

$search[]  = '!<TD [^>]*>.*?</TD>!is';
$search[]  = '!OSTG!';
$search[]  = '! BGCOLOR=#\w{6}!';
$replace[] = '<cell>';
$replace[] = '__';

$snr = new File_SearchReplace( $search, $replace, $onefilename);
$snr -> setSearchFunction('preg');
$snr -> doSearch() ;

readfile($onefilename);
echo "\n------[Occurences]: " . $snr->getNumOccurences();
echo "\n------[Last Error]: " , ($snr->getLastError() !== '') ? var_dump($snr->getLastError()) : "N/A";

?>
--EXPECT--
</td>
        </tr>
</table>
<!-- end __ navbar -->

<!-- prdownloads supplemental -->
<TABLE width="100%" bgcolor="#FFFFFF" cellpadding="4" cellspacing="0" align="center" border="0">
<TR valign="middle">
 <cell>

</TR>
</TABLE>
<font size=1><br></font>
<!-- prdownloads supplemental --><TABLE align="center" width="90%" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
  <cell>

  <cell>
</tr>
 <TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell><cell><cell></TR><TR><cell><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR><TR><cell></TR>
</table></TD></TR></TABLE></FORM><P class="footer">
<b>Jan 27, 2005 12:40</b><br>
</P></TD>
<cell>
</TR></TABLE>
<br>&nbsp;
<!-- start OSDN Footer -->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#FFFFFF">
<td><img src="http://images.sourceforge.net/prdownloads/blank.gif" width="1" height="1" alt=""></td>
------[Occurences]: 100
------[Last Error]: N/A
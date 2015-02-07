<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Contains the MDB_QueryTool_Result_Row and MDB_QueryTool_Result_Object classes
 *
 * PHP versions 4 and 5
 *
 * LICENSE: Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. The name of the author may not be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR "AS IS" AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE FREEBSD PROJECT OR CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF
 * THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   Database
 * @package    MDB_QueryTool
 * @author     Roman Dostovalov, Com-tec-so S.A.<roman.dostovalov@ctco.lv>
 * @copyright  2004-2006 Roman Dostovalov
 * @license    http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version    CVS: $Id: Object.php,v 1.3 2006/01/26 17:10:17 quipo Exp $
 * @link       http://pear.php.net/package/MDB_QueryTool
 */

/**
 * Include parent class
 */
require_once 'MDB/QueryTool/Result.php';

/**
 * MDB_QueryTool_Result_Row class
 *
 * @category   Database
 * @package    MDB_QueryTool
 * @author     Roman Dostovalov, Com-tec-so S.A.<roman.dostovalov@ctco.lv>
 * @copyright  2004-2006 Roman Dostovalov
 * @license    http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link       http://pear.php.net/package/MDB_QueryTool
 */
class MDB_QueryTool_Result_Row
{
	/**
	 * create object properties from the array
	 * @param array
	 */
	function MDB_QueryTool_Result_Row($arr)
	{
        foreach ($arr as $key => $value) {
		    $this->$key = $value;
        }
	}
}

// -----------------------------------------------------------------------------

/**
 * MDB_QueryTool_Result_Object class
 *
 * @category   Database
 * @package    MDB_QueryTool
 * @author     Roman Dostovalov, Com-tec-so S.A.<roman.dostovalov@ctco.lv>
 * @copyright  2004-2006 Roman Dostovalov
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @link       http://pear.php.net/package/MDB_QueryTool
 */
class MDB_QueryTool_Result_Object extends MDB_QueryTool_Result
{
    // {{{ fetchRow

	/**
	 * This function emulates PEAR::MDB fetchRow() method
	 * With this function MDB_QueryTool can transparently replace PEAR::MDB
	 *
	 * @todo implement fetchmode support?
	 * @access    public
	 * @return    void
	 */
	function fetchRow()
	{
		$arr = $this->getNext();
		if (!PEAR::isError($arr)) {
		    $row = new MDB_QueryTool_Result_Row($arr);
			return $row;
		}
		return false;
	}

	// }}}
}
?>
<?php

/**
 * API Unit tests for PEAR_PackageFileManager package.
 * 
 * @version    $Id: PEAR_PackageFileManager_TestCase_generateNewPackageXML.php,v 1.7 2003/10/16 04:04:27 cellog Exp $
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    PEAR_PackageFileManager
 */

/**
 * @package PEAR_PackageFileManager
 */

class PEAR_PackageFileManager_TestCase_generateNewPackageXML extends PHPUnit_TestCase
{
    /**
     * A PEAR_PackageFileManager object
     * @var        object
     */
    var $packagexml;

    function PEAR_PackageFileManager_TestCase_generateNewPackageXML($name)
    {
        $this->PHPUnit_TestCase($name);
    }

    function setUp()
    {
        error_reporting(E_ALL);
        $this->errorOccured = false;
        set_error_handler(array(&$this, 'errorHandler'));

        $this->packagexml = new PEAR_PackageFileManager;
        PEAR::pushErrorHandling(PEAR_ERROR_CALLBACK, array(&$this, 'PEARerrorHandler'));
        $this->errorThrown = false;
        $this->_expectedMessage = 'NO ERROR TRIGGERED';
        $this->_expectedCode = -1;
        $this->_testMethod = 'unknown';
    }

    function tearDown()
    {
        unset($this->packagexml);
        PEAR::popErrorHandling();
    }

    function errorCodeToString($code)
    {
        $codes = array_flip(array(
            'OOPS' => -1,
            'PEAR_PACKAGEFILEMANAGER_NOSTATE' => PEAR_PACKAGEFILEMANAGER_NOSTATE,
            'PEAR_PACKAGEFILEMANAGER_NOVERSION' => PEAR_PACKAGEFILEMANAGER_NOVERSION,
            'PEAR_PACKAGEFILEMANAGER_NOPKGDIR' => PEAR_PACKAGEFILEMANAGER_NOPKGDIR,
            'PEAR_PACKAGEFILEMANAGER_NOBASEDIR' => PEAR_PACKAGEFILEMANAGER_NOBASEDIR,
            'PEAR_PACKAGEFILEMANAGER_GENERATOR_NOTFOUND' => PEAR_PACKAGEFILEMANAGER_GENERATOR_NOTFOUND,
            'PEAR_PACKAGEFILEMANAGER_GENERATOR_NOTFOUND_ANYWHERE' => PEAR_PACKAGEFILEMANAGER_GENERATOR_NOTFOUND_ANYWHERE,
            'PEAR_PACKAGEFILEMANAGER_CANTWRITE_PKGFILE' => PEAR_PACKAGEFILEMANAGER_CANTWRITE_PKGFILE,
            'PEAR_PACKAGEFILEMANAGER_DEST_UNWRITABLE' => PEAR_PACKAGEFILEMANAGER_DEST_UNWRITABLE,
            'PEAR_PACKAGEFILEMANAGER_CANTCOPY_PKGFILE' => PEAR_PACKAGEFILEMANAGER_CANTCOPY_PKGFILE,
            'PEAR_PACKAGEFILEMANAGER_CANTOPEN_TMPPKGFILE' => PEAR_PACKAGEFILEMANAGER_CANTOPEN_TMPPKGFILE,
            'PEAR_PACKAGEFILEMANAGER_PATH_DOESNT_EXIST' => PEAR_PACKAGEFILEMANAGER_PATH_DOESNT_EXIST,
            'PEAR_PACKAGEFILEMANAGER_NOCVSENTRIES' => PEAR_PACKAGEFILEMANAGER_NOCVSENTRIES,
            'PEAR_PACKAGEFILEMANAGER_DIR_DOESNT_EXIST' => PEAR_PACKAGEFILEMANAGER_DIR_DOESNT_EXIST,
            'PEAR_PACKAGEFILEMANAGER_RUN_SETOPTIONS' => PEAR_PACKAGEFILEMANAGER_RUN_SETOPTIONS,
            'PEAR_PACKAGEFILEMANAGER_NOPACKAGE' => PEAR_PACKAGEFILEMANAGER_NOPACKAGE,
            'PEAR_PACKAGEFILEMANAGER_WRONG_MROLE' => PEAR_PACKAGEFILEMANAGER_WRONG_MROLE,
            'PEAR_PACKAGEFILEMANAGER_NOSUMMARY' => PEAR_PACKAGEFILEMANAGER_NOSUMMARY,
            'PEAR_PACKAGEFILEMANAGER_NODESC' => PEAR_PACKAGEFILEMANAGER_NODESC,
            'PEAR_PACKAGEFILEMANAGER_ADD_MAINTAINERS' => PEAR_PACKAGEFILEMANAGER_ADD_MAINTAINERS,
            'PEAR_PACKAGEFILEMANAGER_NO_FILES' => PEAR_PACKAGEFILEMANAGER_NO_FILES,
            'PEAR_PACKAGEFILEMANAGER_IGNORED_EVERYTHING' => PEAR_PACKAGEFILEMANAGER_IGNORED_EVERYTHING,
            'PEAR_PACKAGEFILEMANAGER_INVALID_PACKAGE' => PEAR_PACKAGEFILEMANAGER_INVALID_PACKAGE,
            'PEAR_PACKAGEFILEMANAGER_INVALID_REPLACETYPE' => PEAR_PACKAGEFILEMANAGER_INVALID_REPLACETYPE,
            'PEAR_PACKAGEFILEMANAGER_INVALID_ROLE' => PEAR_PACKAGEFILEMANAGER_INVALID_ROLE,
            'PEAR_PACKAGEFILEMANAGER_PHP_NOT_PACKAGE' => PEAR_PACKAGEFILEMANAGER_PHP_NOT_PACKAGE
        ));
        return $codes[$code];
    }

    function _stripWhitespace($str)
    {
        return preg_replace('/\\s+/', '', $str);
    }

    function _methodExists($name) 
    {
        if (in_array(strtolower($name), get_class_methods($this->packagexml))) {
            return true;
        }
        $this->assertTrue(false, 'method '. $name . ' not implemented in ' . get_class($this->packagexml));
        return false;
    }

    function errorHandler($errno, $errstr, $errfile, $errline) {
        //die("$errstr in $errfile at line $errline: $errstr");
        $this->errorOccured = true;
        $this->assertTrue(false, "$errstr at line $errline, $errfile");
    }

    function PEARerrorHandler($error) {
        $this->assertEquals($this->_expectedCode, $error->getCode(),
            $this->_testMethod . ' ' . $this->errorCodeToString($this->_expectedCode)
            . ' actual: ' . $this->errorCodeToString($error->getCode()));
        $this->assertEquals($this->_expectedMessage, $error->getMessage(), $this->_testMethod);
        $this->errorThrown = 'true';
    }
    
    function expectPEARError($method, $msg, $code = null)
    {
        $this->_expectedMessage = $msg;
        $this->_expectedCode = $code;
        $this->_testMethod = $method;
    }
    
    function test_invalid_nopackage()
    {
        if (!$this->_methodExists('_generateNewPackageXML')) {
            return;
        }
        $this->expectPEARError('invalid nopackage',
            'PEAR_PackageFileManager Error: Package Name (option \'package\') ' .
            'must by specified in PEAR_PackageFileManager '.
            'setOptions to create a new package.xml', PEAR_PACKAGEFILEMANAGER_NOPACKAGE);
        $this->packagexml->_generateNewPackageXML();
        $this->assertEquals('true', $this->errorThrown, 'no error thrown');
    }
    
    function test_invalid_nosummary()
    {
        if (!$this->_methodExists('_generateNewPackageXML')) {
            return;
        }
        $this->packagexml->_options['package'] = 'test';
        $this->expectPEARError('invalid nosummary',
            'PEAR_PackageFileManager Error: Package Summary (option ' .
            '\'summary\') must by specified in PEAR_PackageFileManager '.
            'setOptions to create a new package.xml', PEAR_PACKAGEFILEMANAGER_NOSUMMARY);
        $this->packagexml->_generateNewPackageXML();
        $this->assertEquals('true', $this->errorThrown, 'no error thrown');
    }
    
    function test_invalid_nodescription()
    {
        if (!$this->_methodExists('_generateNewPackageXML')) {
            return;
        }
        $this->packagexml->_options['package'] = 'test';
        $this->packagexml->_options['summary'] = 'test';
        $this->expectPEARError('invalid nodescription',
            'PEAR_PackageFileManager Error: Detailed Package Description ' .
            '(option \'description\') must be' .
            ' specified in PEAR_PackageFileManager setOptions to ' .
            'create a new package.xml', PEAR_PACKAGEFILEMANAGER_NODESC);
        $this->packagexml->_generateNewPackageXML();
        $this->assertEquals('true', $this->errorThrown, 'no error thrown');
    }
    
    function test_valid_simple()
    {
        if (!$this->_methodExists('_generateNewPackageXML')) {
            return;
        }
        $this->packagexml->_options['package'] = 'test';
        $this->packagexml->_options['summary'] = 'test';
        $this->packagexml->_options['description'] = 'test';
        $ret = $this->packagexml->_generateNewPackageXML();
        $this->assertFalse(is_object($ret), 'did not return true');
        $this->assertEquals(
            array('changelog' => array(),
                  'description' => 'test',
                  'maintainers' => array(),
                  'package' => 'test',
                  'release_deps' => array(),
                  'summary' => 'test', 
                  ),
            $this->packagexml->_packageXml,
            'incorrect package');
    }
    
    function test_valid_withdepsfalse()
    {
        if (!$this->_methodExists('_generateNewPackageXML')) {
            return;
        }
        $this->packagexml->_options['package'] = 'test';
        $this->packagexml->_options['summary'] = 'test';
        $this->packagexml->_options['description'] = 'test';
        $this->packagexml->_options['deps'] = false;
        $ret = $this->packagexml->_generateNewPackageXML();
        $this->assertFalse(is_object($ret), 'did not return true');
        $this->assertEquals(
            array('changelog' => array(),
                  'description' => 'test',
                  'maintainers' => array(),
                  'package' => 'test',
                  'release_deps' => array(),
                  'summary' => 'test', 
                  ),
            $this->packagexml->_packageXml,
            'incorrect package');
    }
    
    function test_valid_withdeps()
    {
        if (!$this->_methodExists('_generateNewPackageXML')) {
            return;
        }
        $this->packagexml->_options['package'] = 'test';
        $this->packagexml->_options['summary'] = 'test';
        $this->packagexml->_options['description'] = 'test';
        $this->packagexml->_options['deps'] =
            array(
                array('name' => 'pork', 'rel' => 'ge', 'version' => '1.0.0',
                      'optional' => 'yes')
            );
        $ret = $this->packagexml->_generateNewPackageXML();
        $this->assertFalse(is_object($ret), 'did not return true');
        $this->assertEquals(
            array('changelog' => array(),
                  'description' => 'test',
                  'maintainers' => array(),
                  'package' => 'test',
                  'release_deps' => array(
                array('name' => 'pork', 'rel' => 'ge', 'version' => '1.0.0',
                      'optional' => 'yes')),
                  'summary' => 'test', 
                  ),
            $this->packagexml->_packageXml,
            'incorrect package');
    }
    
    function test_valid_withmaintainersfalse()
    {
        if (!$this->_methodExists('_generateNewPackageXML')) {
            return;
        }
        $this->packagexml->_options['package'] = 'test';
        $this->packagexml->_options['summary'] = 'test';
        $this->packagexml->_options['description'] = 'test';
        $this->packagexml->_options['maintainers'] = false;
        $ret = $this->packagexml->_generateNewPackageXML();
        $this->assertFalse(is_object($ret), 'did not return true');
        $this->assertEquals(
            array('changelog' => array(),
                  'description' => 'test',
                  'maintainers' => array(),
                  'package' => 'test',
                  'release_deps' => array(),
                  'summary' => 'test', 
                  ),
            $this->packagexml->_packageXml,
            'incorrect package');
    }
    
    function test_valid_withmaintainers()
    {
        if (!$this->_methodExists('_generateNewPackageXML')) {
            return;
        }
        $this->packagexml->_options['package'] = 'test';
        $this->packagexml->_options['summary'] = 'test';
        $this->packagexml->_options['description'] = 'test';
        $this->packagexml->_options['maintainers'] =
            array(
                array('name' => 'Gerg', 'email' => 'foo@example.com',
                      'role' => 'lead',
                      'handle' => 'cellogerg')
            );
        $ret = $this->packagexml->_generateNewPackageXML();
        $this->assertFalse(is_object($ret), 'did not return true');
        $this->assertEquals(
            array('changelog' => array(),
                  'description' => 'test',
                  'maintainers' => array(
                array('name' => 'Gerg', 'email' => 'foo@example.com',
                      'role' => 'lead',
                      'handle' => 'cellogerg')),
                  'package' => 'test',
                  'release_deps' => array(),
                  'summary' => 'test', 
                  ),
            $this->packagexml->_packageXml,
            'incorrect package');
    }
}

?>

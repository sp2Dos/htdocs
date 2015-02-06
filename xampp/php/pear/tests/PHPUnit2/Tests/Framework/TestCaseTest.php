<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * PHP Version 5
 *
 * Copyright (c) 2002-2006, Sebastian Bergmann <sb@sebastian-bergmann.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 * 
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRIC
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   Testing
 * @package    PHPUnit2
 * @author     Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright  2002-2006 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    CVS: $Id: TestCaseTest.php,v 1.16.2.2 2005/12/17 16:04:57 sebastian Exp $
 * @link       http://pear.php.net/package/PHPUnit2
 * @since      File available since Release 2.0.0
 */

require_once 'PHPUnit2/Framework/TestCase.php';

require_once 'Error.php';
require_once 'Failure.php';
require_once 'NoArgTestCaseTest.php';
require_once 'SetupFailure.php';
require_once 'Success.php';
require_once 'TearDownFailure.php';
require_once 'TornDown2.php';
require_once 'TornDown3.php';
require_once 'TornDown4.php';
require_once 'TornDown5.php';
require_once 'WasRun.php';

/**
 * 
 *
 * @category   Testing
 * @package    PHPUnit2
 * @author     Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright  2002-2006 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: 2.3.5
 * @link       http://pear.php.net/package/PHPUnit2
 * @since      Class available since Release 2.0.0
 */
class Framework_TestCaseTest extends PHPUnit2_Framework_TestCase {
    public function testCaseToString() {
        $this->assertEquals(
          'testCaseToString(Framework_TestCaseTest)',
          $this->toString()
        );
    }

    public function testError() {
        $this->verifyError(new Error);
    }

    public function testExceptionRunningAndTearDown() {
        $result = new PHPUnit2_Framework_TestResult();
        $t      = new TornDown5;

        $t->run($result);

        $errors = $result->errors();

        $this->assertEquals(
          'tearDown',
          $errors[0]->thrownException()->getMessage()
        );
    }

    public function testFailure() {
        $this->verifyFailure(new Failure);
    }

    /* PHP does not support anonymous classes
    public function testNamelessTestCase() {
    }
    */

    public function testNoArgTestCasePasses() {
        $result = new PHPUnit2_Framework_TestResult();
        $t      = new PHPUnit2_Framework_TestSuite('NoArgTestCaseTest');

        $t->run($result);

        $this->assertEquals(1, $result->runCount());
        $this->assertEquals(0, $result->failureCount());
        $this->assertEquals(0, $result->errorCount());
    }

    public function testRunAndTearDownFails() {
        $fails = new TornDown3;

		    $this->verifyError($fails);
		    $this->assertTrue($fails->tornDown);
    }

    public function testSetupFails() {
        $this->verifyError(new SetupFailure);
    }

    public function testSuccess() {
        $this->verifySuccess(new Success);
    }

    public function testTearDownAfterError() {
        $fails = new TornDown2;

		    $this->verifyError($fails);
		    $this->assertTrue($fails->tornDown);
    }

    public function testTearDownFails() {
        $this->verifyError(new TearDownFailure);
    }

    public function testTearDownSetupFails() {
        $fails = new TornDown4;

		    $this->verifyError($fails);
		    $this->assertFalse($fails->tornDown);
    }

    public function testWasRun() {
        $test = new WasRun;
        $test->run();

        $this->assertTrue($test->wasRun);
    }

    protected function verifyError(PHPUnit2_Framework_TestCase $test) {
        $result = $test->run();

        $this->assertEquals(1, $result->errorCount());
        $this->assertEquals(0, $result->failureCount());
        $this->assertEquals(1, $result->runCount());
    }

    protected function verifyFailure(PHPUnit2_Framework_TestCase $test) {
        $result = $test->run();

        $this->assertEquals(0, $result->errorCount());
        $this->assertEquals(1, $result->failureCount());
        $this->assertEquals(1, $result->runCount());
    }

    protected function verifySuccess(PHPUnit2_Framework_TestCase $test) {
        $result = $test->run();

        $this->assertEquals(0, $result->errorCount());
        $this->assertEquals(0, $result->failureCount());
        $this->assertEquals(1, $result->runCount());
    }
}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */
?>

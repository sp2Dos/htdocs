<?php
//
// +----------------------------------------------------------------------+
// | PHP version 4.0                                                      |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2001 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Jesus M. Castagnetto <jmcastagnetto@php.net>                |
// +----------------------------------------------------------------------+
// 
// Matrix definition and manipulation package
// 
// $Id: instance_methods.php,v 1.1 2003/05/16 22:28:18 jmcastagnetto Exp $
//

require_once 'PHPUnit.php';
require_once 'Math/Matrix.php';
//require_once '../Matrix.php';

class Math_Matrix_Instance_Methods_Test extends PHPUnit_TestCase {/*{{{*/
    var $m;
    var $data = array(
                    array(1.0,2.0,3.0,4.0),
                    array(5.0,6.0,7.0,8.0),
                    array(1.0,4.0,5.0,7.0),
                    array(2.0,3.0,-3.0,4.0)
                );

    function Math_Matrix_Instance_Methods_Test($name) {
        $this->PHPUnit_TestCase($name);
    }

    function setUp() {
        $this->m = new Math_Matrix($this->data);
    }

    function testIsSquare() {
        $this->assertTrue($this->m->isSquare());
    }

    function testGetSize() {
        $this->assertEquals(array(4,4), $this->m->getSize());
    }

    function testIsEmpty() {
        $this->assertFalse($this->m->isEmpty());
    }

    function testClone() {
        $q = $this->m->clone();
        $this->assertEquals($q, $this->m);
    }

    function testNorm() {
        $this->assertEquals(18.2482875909,$this->m->norm(),'',1E-8);
    }

    function testTrace() {
        $this->assertEquals(16,$this->m->trace(),'',1E-8);
    }

    function testDeterminant() {
        $this->assertEquals(76,$this->m->determinant(),'',1E-8);
    }

    function testNormalizedDeterminant() {
        $this->assertEquals(4.16477434507,$this->m->normalizedDeterminant(),'',1E-8);
    }

    function testGetRow() {
        $row = array(5.0,6.0,7.0,8.0);
        $this->assertEquals($row, $this->m->getRow(1));
    }

    function testGetCol() {
        $col = array(2.0,6.0,4.0,3.0);
        $this->assertEquals($col, $this->m->getCol(1));
    }

    function testGetElement() {
        $this->assertEquals(2.0, $this->m->getElement(0,1));
    }

    function testGetData() {
        $this->assertEquals($this->data, $this->m->getData());
    }

    function testGetMin() {
        $this->assertEquals(-3.0,$this->m->getMin(),'',1E-8);
    }

    function testGetMax() {
        $this->assertEquals(8.0,$this->m->getMax(),'',1E-8);
    }

    function testGetValueIndex() {
        $this->assertEquals(array(1,1),$this->m->getValueIndex(6.0));
    }

    function testGetMinIndex() {
        $this->assertEquals(array(3,2),$this->m->getMinIndex(6.0));
    }

    function testGetMaxIndex() {
        $this->assertEquals(array(1,3),$this->m->getMaxIndex(6.0));
    }

    function testTranspose() {
        $data = array(
                    array(1.0,2.0),
                    array(3.0,4.0)
                );
        $data_transposed = array(
                    array(1.0,3.0),
                    array(2.0,4.0)
                );
        $p = new Math_Matrix($data);
        $p->transpose();
        $this->assertEquals($data_transposed, $p->getData());
    }

    function testInvert() {
        $unit = Math_Matrix::makeUnit(4);
        $q = new Math_Matrix($this->data);
        $p = $q->clone();
        $q->invert();
        $p->multiply($q);
        $this->assertEquals($unit->getData(), $p->getData());
    }

    function testMultiply() {
        $this->testInvert();
    }

    function testGetSubMatrix() {
        $data = array(
                    array(6.0,7.0),
                    array(4.0,5.0),
                );
        $q = $this->m->getSubMatrix(1,1,2,2);
        $this->assertEquals($data, $q->getData()); 
    }

    function testAdd() {
        $data = array(
                    array(2.0,7.0,4.0,6.0),
                    array(7.0,12.0,11.0,11.0),
                    array(4.0,11.0,10.0,4.0),
                    array(6.0,11.0,4.0,8.0)
                );
        $q = $this->m->clone();
        $p = $q->clone();
        $q->transpose();
        $p->add($q);
        $this->assertEquals($data, $p->getData());
    }

    function testSub() {
        $data = array(
                    array(0.0,-3.0,2.0,2.0),
                    array(3.0,0.0,3.0,5.0),
                    array(-2.0,-3.0,0.0,10.0),
                    array(-2.0,-5.0,-10.0,0.0)
                );
        $q = $this->m->clone();
        $p = $q->clone();
        $q->transpose();
        $p->sub($q);
        $this->assertEquals($data, $p->getData());
    }

    function testScale() {
        $data = array(
                    array(2.0,4.0,6.0,8.0),
                    array(10.0,12.0,14.0,16.0),
                    array(2.0,8.0,10.0,14.0),
                    array(4.0,6.0,-6.0,8.0)
                );
        $q = $this->m->clone();
        $q->scale(2.0);
        $this->assertEquals($data, $q->getData());
    }

    function testScaleRow() {
        $data = array(
                    array(1.0,2.0,3.0,4.0),
                    array(10.0,12.0,14.0,16.0),
                    array(1.0,4.0,5.0,7.0),
                    array(2.0,3.0,-3.0,4.0)
                );
        $q = $this->m->clone();
        $q->scaleRow(1,2.0);
        $this->assertEquals($data, $q->getData());
    }

    function testSwapRows() {
        $data = array(
                    array(1.0,2.0,3.0,4.0),
                    array(1.0,4.0,5.0,7.0),
                    array(5.0,6.0,7.0,8.0),
                    array(2.0,3.0,-3.0,4.0)
                );
        $q = $this->m->clone();
        $q->swapRows(1,2);
        $this->assertEquals($data, $q->getData());
    }

    function testSwapCols() {
        $data = array(
                    array(1.0,3.0,2.0,4.0),
                    array(5.0,7.0,6.0,8.0),
                    array(1.0,5.0,4.0,7.0),
                    array(2.0,-3.0,3.0,4.0)
                );
        $q = $this->m->clone();
        $q->swapCols(1,2);
        $this->assertEquals($data, $q->getData());
    }

    function testSwapRowCol() {
        $data = array(
                    array(1.0,5.0,1.0,2.0),
                    array(2.0,6.0,7.0,8.0),
                    array(3.0,4.0,5.0,7.0),
                    array(4.0,3.0,-3.0,4.0)
                );
        $q = $this->m->clone();
        $q->swapRowCol(0,0);
        $this->assertEquals($data, $q->getData());
    }

    function testVectorMultiply() {
        $data = array(53.0,129.0,96.0,13.0);
        $v = new Math_Vector(array(-1,9,8,3));
        $q = $this->m->clone();
        $r = $q->vectorMultiply($v);
        $t = $r->getTuple();
        $this->assertEquals($data, $t->data);
    }

}/*}}}*/

$suite = new PHPUnit_TestSuite('Math_Matrix_Instance_Methods_Test');
$result = PHPUnit::run($suite);
echo $result->toString()."\n";

// vim: ts=4:sw=4:et:
// vim6: fdl=1:
?>

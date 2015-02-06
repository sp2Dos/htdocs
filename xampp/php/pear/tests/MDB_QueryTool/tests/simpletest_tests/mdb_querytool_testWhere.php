<?php
// $Id: mdb_querytool_testWhere.php,v 1.1 2005/02/25 14:15:59 quipo Exp $

require_once dirname(__FILE__).'/mdb_querytool_test_base.php';

class TestOfMDB_QueryTool_Where extends TestOfMDB_QueryTool
{
    function TestOfMDB_QueryTool_Where($name = __CLASS__) {
        $this->UnitTestCase($name);
    }
    function test_setWhere()
    {
        $this->qt =& new MDB_QT(TABLE_USER);
        $whereClause = 'name=' . $this->qt->db->getTextValue('Wolfram');
        $this->qt->setWhere($whereClause);
        $this->assertEqual($whereClause, $this->qt->getWhere());

        $whereClause = 'name=' . $this->qt->db->getTextValue('"test"oli');
        $this->qt->setWhere($whereClause);
        $this->assertEqual($whereClause, $this->qt->getWhere());

        $this->qt =& new MDB_QT(TABLE_USER);
        $whereClause = 'name=' . $this->qt->db->getTextValue('Wolfram');
        $this->qt->setWhere($whereClause);
        $whereClause1 = 'name=' . $this->qt->db->getTextValue('Kriesing');
        $this->qt->addWhere($whereClause1);
        $this->assertEqual("$whereClause AND $whereClause1", $this->qt->getWhere());

        $whereClause = 'name=' . $this->qt->db->getTextValue('"test"oli');
        $this->qt->setWhere($whereClause);
        $whereClause1 = 'name=' . $this->qt->db->getTextValue('"testirt"oli');
        $this->qt->addWhere($whereClause1, 'OR');
        $this->assertEqual("$whereClause OR $whereClause1", $this->qt->getWhere());
    }

    function test_addWhereSearch()
    {
        $this->qt =& new MDB_QT(TABLE_USER);
        
        $newData = $this->_getSampleData(1);

        $newData['name'] = 'Mikey Mouse';
        $this->qt->add($newData);
        $newData['name'] = 'MIKEY Walt DISney MoUSe';
        $this->qt->add($newData);
        $newData['name'] = ' mouse   mikey ';
        $this->qt->add($newData);
        
        $this->qt->setWhere();
        $this->qt->addWhereSearch('name', 'Mikey Mouse');
        $this->assertEqual(2, $this->qt->getCount(), 'getCount(): Did not find the inserted number of user names.');
        
        $newData['name'] = 'Mikey and here goes some string Mouse but it should be found';
        $this->qt->add($newData);
        $newData['name'] = '%Mikey man in the middle :-) Mouse and smthg behind%';
        $this->qt->add($newData);

        $this->assertEqual(4, $this->qt->getCount(), 'getCount(): Did not find the inserted number of user names.');
    }
}

if (!defined('TEST_RUNNING')) {
    define('TEST_RUNNING', true);
    $test = &new TestOfMDB_QueryTool_Where();
    $test->run(new HtmlReporter());
}
?>
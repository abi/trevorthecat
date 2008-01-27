<?php
/* SVN FILE: $Id: i18n.test.php 5811 2007-10-20 06:39:14Z phpnut $ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package			cake.tests
 * @subpackage		cake.tests.cases.libs
 * @since			CakePHP(tm) v 1.2.0.5432
 * @version			$Revision: 5811 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-10-20 01:39:14 -0500 (Sat, 20 Oct 2007) $
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
uses('i18n');
/**
 * Short description for class.
 *
 * @package    cake.tests
 * @subpackage cake.tests.cases.libs
 */
class I18nTest extends UnitTestCase {
	function setUp() {
		$calledFrom = debug_backtrace();
		$this->dir = dirname($calledFrom[0]['file']);
	}

	function tearDown() {
		unset($this->dir);
	}

	function testPlural() {
		$result = I18n::translate('chair', 'chairs', null, 5, 1, $this->dir);
		$this->assertEqual($result, 'chair');

		$result = I18n::translate('chair', 'chairs', null, 5, 2, $this->dir);
		$this->assertEqual($result, 'chairs');

		$data['count'] = 1;
		$result = I18n::translate('chair', 'chairs', null, 5, $data['count'], $this->dir);
		$this->assertEqual($result, 'chair');

		$data['count'] = 8;
		$result = I18n::translate('chair', 'chairs', null, 5, $data['count'], $this->dir);
		$this->assertEqual($result, 'chairs');
	}
}
?>
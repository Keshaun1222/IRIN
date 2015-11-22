<?php

/**
 * Created by PhpStorm.
 * User: Keshaun
 * Date: 11/22/2015
 * Time: 6:06 PM
 */
class AwardsTest extends PHPUnit_Framework_TestCase {
    public function testIsMulti() {
        $this->assertTrue(Award::isMulti(36));
    }
}
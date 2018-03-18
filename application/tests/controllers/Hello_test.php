<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hello_test
 *
 * @author gerard
 */
class Hello_test extends TestCase {

    //put your code here
    public function test_get_hello() {
        $output = $this->request('GET', ['Hello', 'get_hello']);
        $expected = '<h2>Hello!</h2>';
        $this->assertContains($expected, $output);
    }

}

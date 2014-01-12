<?php
class MessageControllerTest extends PHPUnit_Framework_TestCase
{
    public function setRoute($method, $controller, $action){
        $this->obj = new MessageController($method, $controller, $action);
    }
    public function testSend()
    {
    }
}
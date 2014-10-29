<?php
class HelloController extends AppController
{
    /**
    * Test action
    */
    public function index()
    {
        $message = Hello::getMessage();
        $this->set(get_defined_vars());
    }
}

<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class StudentsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('StudentsModel');
    }

    public function get_all()
    {
        var_dump($this->StudentsModel->all());
    }


    function create()
    {
        $data = array(
            'last_name' => 'Kimberly Nicole',
            'first_name' => 'De Leon',
            'email' => 'deleon.kimberlynicole.9@gmail.com'
        );
 
        $this->StudentsModel->insert($data);
    }

    function update()
    {
        $data = array(
            'last_name' => 'De Leonnnn',
            'first_name' => 'Kimmenggggggg Nicollll',
            'email' => 'kimdel0123@gmail.com'
        );
        $this->StudentsModel->update(3, $data);
    }

    function delete()
    {
        $this->StudentsModel->delete(3);
    }
}

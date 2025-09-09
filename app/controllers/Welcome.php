<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Welcome extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->call->view('home');
    }

    public function profile($fname, $lname)
    {
        $data["fname"] = $fname;
        $data["lname"] = $lname;

        $this->call->view('profile', $data);
    }

    public function get_id($id, $name)
    {

        $data["id"] = $id;
        $data["name"] = $name;

        $this->call->view('profile', $data);
    }
}

<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Model: StudentModel
 * 
 * Automatically generated via CLI.
 */
class StudentsModel extends Model
{

    /**
     * Table associated with the model.
     * @var string
     */
    protected $table = 'students';

    /**
     * Primary key of the table.
     * @var string
     */
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($fName, $lName, $email)
    {
        $data = array(
            'first_name' => $fName,
            'last_name' => $lName,
            'email' => $email,
        );

        return $this->UserModel->insert($data);
    }
}

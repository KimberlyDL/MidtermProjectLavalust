<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Model: UserModel
 * 
 * Automatically generated via CLI.
 */
class UserModel extends Model
{

    /**
     * Table associated with the model.
     * @var string
     */
    protected $table = 'users';

    /**
     * Primary key of the table.
     * @var string
     */
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function greet()
    {
        echo "Hello";
    }

    public function seed_users(array $users)
    {
        var_dump($this->db);
        return $this->db->table('user')->bulk_insert($users);
    }

    public function create($fName, $lName, $email, $username)
    {
        $data = array(
            'fname' => $fName,
            'lname' => $lName,
            'email' => $email,
            'username' => $username
        );

        return $this->UserModel->insert($data);
    }

    // public function count_all(string $q = ''): int
    // {
    //     $b = $this->db->table($this->table);

    //     if ($q !== '') {
    //         // group-like: username OR email OR fname OR lname
    //         $b->like('username', $q);
    //         $b->or_like('email', $q);
    //         $b->or_like('fname', $q);
    //         $b->or_like('lname', $q);
    //     }

    //     // Some LavaLust versions don’t have count_* helpers – use get_all() and count.
    //     $rows = $b->get_all();             // array of rows

    //     return is_array($rows) ? count($rows) : 0;
    // }

    public function count_all(string $q = ''): int
    {
        $b = $this->db->table($this->table);

        if ($q !== '') {
            $b->like('username', $q);
            $b->or_like('email', $q);
            $b->or_like('fname', $q);
            $b->or_like('lname', $q);
        }

        // ✅ Use built-in LavaLust count()
        return $b->count();
    }

    public function list_paginated(int $limit, int $offset, string $q = ''): array
    {
        $b = $this->db->table($this->table);

        if ($q !== '') {
            $b->like('username', $q)
                ->or_like('email', $q)
                ->or_like('fname', $q)
                ->or_like('lname', $q);
        }

        $b->order_by('id', 'DESC');
        $b->limit($offset, $limit);   // <-- offset first, then limit

        return $b->get_all();         // array of rows
    }

    // // ----- LIST with limit/offset using builder only -----
    // public function list_paginated(int $limit, int $offset, string $q = ''): array
    // {

    //     // print_r('limit' . $limit);
    //     // print_r('q' . $q);
    //     // print_r('offset' . $offset);

    //     // $b = $this->db->table($this->table);

    //     // if ($q !== '') {
    //     //     $b->like('username', $q);
    //     //     $b->or_like('email', $q);
    //     //     $b->or_like('fname', $q);
    //     //     $b->or_like('lname', $q);
    //     // }

    //     // $b->order_by('id', 'DESC');
    //     // $b->limit($limit, $offset);

    //     // $rows = $b->get_all();

    //     // print_r($rows);

    //     // return $rows;

    //     $b = $this->db->table($this->table);

    //     if ($q !== '') {
    //         $b->like('username', $q);
    //         $b->or_like('email', $q);
    //         $b->or_like('fname', $q);
    //         $b->or_like('lname', $q);
    //     }

    //     $b->order_by('id', 'DESC');

    //     // ✅ Preferred (clear & portable)
    //     if (method_exists($b, 'offset')) {
    //         if ($offset > 0) {
    //             $b->offset($offset);
    //         }
    //         $b->limit($limit);
    //     } else {
    //         // ✅ Fallback: many builders expect (offset, limit), not (limit, offset)
    //         $b->limit($offset, $limit);
    //     }

    //     $rows = $b->get_all();
    //     return is_array($rows) ? $rows : [];

    //     print_r('rows ' . $rows);
    //     // return $b->get_all(); // array of rows
    //     // return $rows;
    // }
}

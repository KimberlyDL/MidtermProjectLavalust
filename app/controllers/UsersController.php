<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UsersController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model("UserModel");
    }

    public function index()
    {

        // $this->call->database(); //$this->db
        var_dump($this->db);

        $this->UserModel->greet();

        var_dump($this->UserModel->all());
        
        // var_dump($this->UsersModel->find(2));
        // filter(['email' => 'matt@gmail.com'])->get();



        // $this->UserModel->insert([
        //     'username' => "kimmenggg",
        //     "email"=> "kimdel@gmail.com",
        // ]);


    }

    public function read()
    {

        // $data['users'] = $this->UserModel->all();
        // $this->call->view('user/index', $data);

        // UsersController::read()

        $this->call->library('pagination');

        $q       = isset($_GET['q'])        ? trim((string) $this->io->get('q'))        : '';
        $per_in  = isset($_GET['per_page']) ? (int) $this->io->get('per_page')          : 10;
        $page_in = isset($_GET['page'])     ? (int) $this->io->get('page')              : 1;

        $allowed   = [5, 10, 20, 50];
        $per_page  = in_array($per_in, $allowed, true) ? $per_in : 10;
        $page      = max(1, $page_in);
        $offset    = ($page - 1) * $per_page;

        $total_rows = $this->UserModel->count_all($q);


        $params = ['per_page' => $per_page];
        if ($q !== '') $params['q'] = $q;

        $base = 'users' . (empty($params) ? '' : ('?' . http_build_query($params)));
        $pageDelimiter = (strpos($base, '?') !== false) ? '&page=' : '?page=';

        $this->pagination->set_theme('custom');

        $this->pagination->set_custom_classes([
            'nav'    => 'flex justify-center mt-6',
            'ul'     => 'tw-pager flex flex-wrap items-center gap-2',
            'li'     => 'group',
            'a'      => 'inline-flex items-center h-9 px-4 rounded-full border border-slate-300 bg-white text-slate-700 ' .
                'hover:bg-slate-50 hover:border-slate-400 transition dark:bg-[#0f172a] dark:border-slate-600 dark:text-slate-200 ' .
                'dark:hover:bg-slate-800',
            'active' => 'is-active'
        ]);

        $this->pagination->set_options([
            'first_link' => 'First',
            'prev_link'  => '← Prev',
            'next_link'  => 'Next →',
            'last_link'  => 'Last',
            'page_delimiter' => $pageDelimiter,
        ]);


        $meta = $this->pagination->initialize($total_rows, $per_page, $page, $base);
        $rows = $this->UserModel->list_paginated($per_page, $offset, $q);

        return $this->call->view('user/index', [
            'users'   => $rows,
            'page'    => $this->pagination->paginate(),
            'info'    => $meta['info'],
            'total'   => $total_rows,
            'perPage' => $per_page,
        ]);
    }



    public function show($id)
    {
        $user = $this->UserModel->filter(['id' => $id])->get();
        if (!$user) {
            set_flash_alert('danger', 'User not found.');
            return redirect('/users');
        }
        return $this->call->view('user/view', ['user' => $user]);
    }

    public function insert()
    {
        if ($this->form_validation->submitted()) {

            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $email_token = bin2hex(random_bytes(50));

            $this->form_validation
                ->name('fName')->required()
                ->custom_pattern('[\p{L}\s\.]+', 'First name may contain letters, spaces, and periods only.')
                ->name('lName')->required()
                ->custom_pattern('[\p{L}\s\.]+', 'Last name may contain letters, spaces, and periods only.')
                ->name('email')
                ->required()
                ->is_unique('users', 'email', $email, 'Email was already taken.')
                ->name('password')
                ->required()
                //->min_length(8, 'Password must not be less than 8 characters.')
                ->name('password_confirmation')
                ->required()
                //->min_length(8, 'Password confirmation name must not be less than 8 characters.')
                ->matches('password', 'Passwords did not match.')
                ->name('username')
                ->required()
                ->is_unique('users', 'username', $username, 'Username was already taken.')
                ->min_length(5, 'Username name must not be less than 5 characters.')
                ->max_length(20, 'Username name must not be more than 20 characters.')
                ->alpha_numeric_dash('Special characters are not allowed in username.');

            if ($this->form_validation->run()) {

                $fName = $this->io->post('fName');
                $lName = $this->io->post('lName');
                $email = $this->io->post('email');
                $username = $this->io->post('username');

                if ($this->lauth->register($username, $email, $this->io->post('password'), $email_token)) {
                    $ok = $this->UserModel->filter(['email' => $email])->update([
                        'fname'    => $fName,
                        'lname'    => $lName,
                    ]);

                    if ($ok) {
                        set_flash_alert('success', 'User created successfully.');
                        return redirect('users/create');
                    } else {
                        set_flash_alert('danger', 'User registration failed. Please try again later.');
                    }
                } else {
                    set_flash_alert('danger', 'User registration failed. Please try again later.');
                }




                // $this->UserModel->insert([
                //     'username' => "kimmenggg",
                //     "email"=> "kimdel@gmail.com",
                // ]);

                // if ($this->UserModel->create($fName, $lName, $email, $username)) {
                //     //success
                //     set_flash_alert('success', 'User created successfully.');
                //     redirect('users/create');
                // }

            } else {
                set_flash_alert('danger', $this->form_validation->errors());

                redirect('users/create');
            }
        }

        $this->call->view('user/create');
    }

    public function seed()
    {
        $sampleUsers = [
            ['fname' => 'Juan',    'lname' => 'Dela Cruz', 'email' => 'juan@example.com',       'username' => 'juan1243'],
            ['fname' => 'Maria',   'lname' => 'Santos',    'email' => 'maria@example.com',      'username' => 'mariaS'],
            ['fname' => 'Pedro',   'lname' => 'Reyes',     'email' => 'pedro@example.com',      'username' => 'pedroR'],
            ['fname' => 'Ana',     'lname' => 'Lopez',     'email' => 'ana.lopez@example.com',  'username' => 'itsMeAna'],
            ['fname' => 'Carlo',   'lname' => 'Gomez',     'email' => 'c.gomez@example.com',    'username' => 'carl_the_g'],
            ['fname' => 'Liza',    'lname' => 'Martinez',  'email' => 'liza.m@example.com',     'username' => 'lizzieM'],
            ['fname' => 'Ramon',   'lname' => 'Torres',    'email' => 'ramon.t@example.com',    'username' => 'ramtorres'],
            ['fname' => 'Jenny',   'lname' => 'Cruz',      'email' => 'jennyC@example.com',     'username' => 'jenzzz'],
            ['fname' => 'Mark',    'lname' => 'Villanueva', 'email' => 'mark.v@example.com',     'username' => 'mvillanueva'],
            ['fname' => 'Katrina', 'lname' => 'Ramos',     'email' => 'katrina.r@example.com',  'username' => 'kat_ramos'],
            ['fname' => 'Leo',     'lname' => 'Navarro',   'email' => 'leo.nav@example.com',    'username' => 'leoN'],
            ['fname' => 'Sofia',   'lname' => 'Gutierrez', 'email' => 'sofia.g@example.com',    'username' => 'sofie99'],
            ['fname' => 'Miguel',  'lname' => 'Aquino',    'email' => 'miguel.a@example.com',   'username' => 'migz_ako'],
            ['fname' => 'Diana',   'lname' => 'Flores',    'email' => 'diana.f@example.com',    'username' => 'dflores'],
            ['fname' => 'Jose',    'lname' => 'Castro',    'email' => 'jose.c@example.com',     'username' => 'castro_boy'],
            ['fname' => 'Elena',   'lname' => 'Delos Reyes', 'email' => 'elena.dr@example.com',  'username' => 'elenita'],
            ['fname' => 'Noel',    'lname' => 'Domingo',   'email' => 'noel.d@example.com',     'username' => 'noelD'],
            ['fname' => 'Grace',   'lname' => 'Pascual',   'email' => 'grace.p@example.com',    'username' => 'gracyy'],
            ['fname' => 'Allan',   'lname' => 'Bautista',  'email' => 'allan.b@example.com',    'username' => 'abauti'],
            ['fname' => 'Ivy',     'lname' => 'Fernandez', 'email' => 'ivy.f@example.com',      'username' => 'ivy_fern'],
            ['fname' => 'Roland',  'lname' => 'Mendoza',   'email' => 'roland.m@example.com',   'username' => 'rollyman'],
            ['fname' => 'Trisha',  'lname' => 'Garcia',    'email' => 'trish.g@example.com',    'username' => 'trishh'],
            ['fname' => 'Victor',  'lname' => 'Santiago',  'email' => 'victor.s@example.com',   'username' => 'vsanti'],
            ['fname' => 'Paula',   'lname' => 'Aguilar',   'email' => 'paula.a@example.com',    'username' => 'paula_rocks'],
            ['fname' => 'Chris',   'lname' => 'Rivera',    'email' => 'chris.r@example.com',    'username' => 'riverboy'],
            ['fname' => 'Olivia',  'lname' => 'Morales',   'email' => 'olivia.m@example.com',   'username' => 'livvy'],
            ['fname' => 'Danilo',  'lname' => 'Villamor',  'email' => 'danilo.v@example.com',   'username' => 'danvs'],
            ['fname' => 'Andrea',  'lname' => 'Dominguez', 'email' => 'andrea.d@example.com',   'username' => 'dreaaa'],
            ['fname' => 'Felix',   'lname' => 'Hernandez', 'email' => 'felix.h@example.com',    'username' => 'fhelix_'],
            ['fname' => 'Nina',    'lname' => 'Rosario',   'email' => 'nina.r@example.com',     'username' => 'ninaboo'],
        ];

        $ok = $this->UserModel->seed_users($sampleUsers);

        if ($ok) {
            set_flash_alert('success', 'Sample users seeded successfully!');
        } else {
            set_flash_alert('danger', 'Failed to seed users.');
        }

        return redirect('users'); // go back to list
    }

    public function edit($id)
    {
        // $user = $this->UserModel->find($id);
        $user = $this->UserModel->filter(['id' => $id])->get();
        if (!$user) {
            set_flash_alert('danger', 'User not found.');
            return redirect('/users');
        }

        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('fName')->required()
                ->custom_pattern('[\p{L}\s\.]+', 'First name may contain letters, spaces, and periods only.')
                ->name('lName')->required()
                ->custom_pattern('[\p{L}\s\.]+', 'Last name may contain letters, spaces, and periods only.')
                ->name('email')->required()->max_length(50)->valid_email()
                ->name('username')->required()->max_length(50);

            if ($this->form_validation->run()) {
                $data = [
                    'fname'    => $this->io->post('fName'),
                    'lname'    => $this->io->post('lName'),
                    'email'    => $this->io->post('email'),
                    'username' => $this->io->post('username'),
                ];

                $ok = $this->UserModel->filter(['id' => $id])->update($data);

                if ($ok) {
                    set_flash_alert('success', 'User updated successfully.');
                    return redirect('/users/' . $id . '/edit');
                } else {
                    set_flash_alert('danger', 'Update failed. Please try again.');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
            }
        }

        return $this->call->view('user/edit', ['user' => $user]);
    }

    public function delete($id)
    {
        $user = $this->UserModel->filter(['id' => $id])->get();
        if (!$user) {
            set_flash_alert('danger', 'User not found.');
            return redirect('/users');
        }

        $ok = $this->UserModel->filter(['id' => $id])->delete();
        if ($ok) {
            set_flash_alert('success', 'User deleted.');
        } else {
            set_flash_alert('danger', 'Delete failed.');
        }
        return redirect('/users');
    }
}

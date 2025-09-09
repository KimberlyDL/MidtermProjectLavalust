<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

// SYNTAX
// php console/cli.php make:model UserModel
// php console/cli.php make:view View

// $router->get('/', 'Welcome::index');
// $router->get('/about-us', 'Welcome::showpage');
// $router->get('/about-us', 'Welcome@showpage');
// $router->get('/about-us', 'Welcome->showpage');




// ROUTES ACTIVITY
// $router->get('/', 'Welcome::index');
// $router->get('/get-id/{id}/{name}', 'Welcome->get_id');
// $router->get('/profile/{fname}/{lname}', 'Welcome->profile');


//CRUD ACTIVITY
// $router->get('students/get-all', 'StudentsController::get_all');
// $router->get('students/create', 'StudentsController::create');
// $router->get('students/update', 'StudentsController::update');
// $router->get('students/delete', 'StudentsController::delete');


$router->get('/', 'Auth');
$router->get('/home', 'Home');
$router->group('/auth', function () use ($router) {
    $router->match('/register', 'Auth::register', ['POST', 'GET']);
    $router->match('/login', 'Auth::login', ['POST', 'GET']);
    $router->get('/logout', 'Auth::logout');
    $router->match('/password-reset', 'Auth::password_reset', ['POST', 'GET']);
    $router->match('/set-new-password', 'Auth::set_new_password', ['POST', 'GET']);
    $router->get('/verify/{token}', 'Auth::verify');
    $router->get('/not-verified', 'Auth::not_verified');
    $router->post('/resend-verification', 'Auth::resend_verification');
});

//seeder
$router->get('/users/seed', 'UsersController->seed');

$router->get('/users', 'UsersController->read');
$router->match('/users/create', 'UsersController->insert', 'GET|POST');
$router->match('/users/{id}/edit', 'UsersController->edit', 'GET|POST');
$router->get('/users/{id}', 'UsersController->show');
$router->post('/users/{id}/delete', 'UsersController->delete');

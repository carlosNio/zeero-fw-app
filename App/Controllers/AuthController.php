<?php

namespace App\Controllers;

use App\Controllers\Requests\AuthRequest;
use App\Controllers\Requests\LoginRequest;

use App\Models\User;

use Zeero\facades\{Flash, Session};
use Zeero\Core\Crypto\Hashing;
use Zeero\Core\Timer;


/**
 * Authentication Controller
 * 
 * used to make user registration, login and logout and retrieve current user informations
 * 
 * @author zeero
 */
class AuthController
{
    protected $afterLogin = "/";
    protected $afterRegister = "/login";

    /**
     * Make User Login
     *
     * @param LoginRequest $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        // validate the data
        if ($request->validator->fail()) {
            return $request->redirectWithError();
        }
        // get the form data
        $data = $request->form;

        // check if exists a user with the name given
        if (User::has('name = ?', [$data->get('name')])) {
            // find the user by name
            $user = User::findOne('name = ?', [$data->get('name')]);
            $id = $user->uuid;
            // verify the hash with password
            if (Hashing::verify_hash($data->get('password'), $user->password) == false) {
                Flash::set('_form_error', ['Wrong Password']);
                return redirect('/login');
            }
            // update the user state
            User::UpdateWhere(
                ['online' => 1, 'login_at' => Timer::now()],
                'uuid = ?',
                [$id]
            );
            // set the user id
            Session::set('user_id', $id);
            // redirect to next page
            return redirect($this->afterLogin);
        } else {
            Flash::set('_form_error', ['User Not Exists']);
            return redirect('/login');
        }
    }

    /**
     * Make the User Register
     *
     * @param AuthRequest $request
     * @return void
     */
    public function register(AuthRequest $request)
    {
        if ($request->validator->fail()) {
            return $request->redirectWithError();
        }

        $name = $request->form->get('name');
        $email = $request->form->get('email');
        $password = $request->form->get('password');

        $data = [
            'uuid' => Hashing::random_id(),
            'name' => $name,
            'email' => $email,
            'password' => Hashing::hash($password),
            'online' => 1,
            'login_at' => Timer::now(),
            'created_at' => Timer::now()
        ];

        if (User::create($data)) {
            return redirect($this->afterRegister);
        } else {
            Flash::set("_form_error", ['failed to register user']);
            redirect('/register');
        }
    }

}

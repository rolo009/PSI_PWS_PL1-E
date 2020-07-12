<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Session;

class UserController extends BaseController implements ResourceControllerInterface
{

    public function store()
    {

        \Tracy\Debugger::barDump(Post::get('datanasc'));
        $user = new User();

        $user->username = Post::get('username');
        $user->nome = Post::get('nome');
        $user->email = Post::get('email');
        $user->password = md5(Post::get('password'));
        $confirm_password = md5(Post::get('confirm-password'));
        $user->dtanascimento = Post::get('datanasc');

        Tracy\Debugger::barDump($user);

        if (strlen($user->password) > 5) {

            if ($user->password == $confirm_password) {

                if (User::exists(array('email' => $user->email, 'password' => $user->password))) {

                    Redirect::flashToRoute('jogo/registar', ['registo' => "repetido"]);

                } else {
                    if ($user->is_valid()) {

                        $user->save(false);
                        Redirect::toRoute('jogo/login');

                    } else {
                        Redirect::flashToRoute('jogo/register', ['user' => $user]);
                    }
                }

            } else {
                Redirect::flashToRoute('jogo/registar', ['registo' => "passwords_dif"]);
            }
        } else {
            Redirect::flashToRoute('jogo/registar', ['registo' => "password_curta"]);
        }

    }

    /**
     * @return Returns
     */
    public function index()
    {
        // TODO: Implement index() method.
    }

    /**
     * @return Returns
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // TODO: Implement show() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (is_null($user)) {

        } else {
            View::make('jogo_stb.update_register', ['user' => $user]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $user = User::find($id);

        $password = md5(Post::get("password"));
        $confirmpassword = md5(Post::get("confirm-password"));

        if ($password == "") {
            $user->nome = Post::get("nome");
            $user->email = Post::get("email");
            $user->dtanascimento = Post::get("dtanascimento");
        } else if ($password != "") {
            if ($password == $confirmpassword) {
                $user->nome = Post::get("nome");
                $user->email = Post::get("email");
                $user->password = md5(Post::get("password"));
                $user->dtanascimento = Post::get("dtanascimento");
            }
        }

        if ($user->is_valid()) {
            $user->save();
            Redirect::toRoute('jogo/index');
        } else {
            // return form with data and errors
            Redirect::flashToRoute('user/edit', ['user' => $user], $id);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function login()
    {
        $email = Post::get("email");
        $password = md5(Post::get("password"));

        if (User::exists(array('email' => $email, 'password' => $password))) {

            $user = User::find(array('email' => Post::get('email')));

            if ($user->estadoconta == 0) {

                Session::set('email', $user->email);
                Session::set('id_user', $user->id_user);
                Session::set('tipo_utilizador', $user->tipouser);

                Redirect::toRoute('jogo/instrucoes');
            } else {
                Redirect::flashToRoute('jogo/login', ['estado' => "bloqueado"]);
            }
        } else {
            Redirect::flashToRoute('jogo/login', ['estado' => "erro"]);
        }
    }

    public function logout()
    {
        Session::destroy();
        Redirect::toRoute('jogo/index');
    }

    public function topten()
    {
        $scores = Score::find_by_sql("Select u.username, s.pontos FROM users u JOIN scores s ON (u.id_user = s.users_id_user) ORDER BY pontos DESC LIMIT 10");
        \Tracy\Debugger::barDump($scores);
        View::make('jogo_stb.top10', ['scores' => $scores]);
    }

    public function privatearea()
    {
        $id = Session::get("id_user");
        $scores = Score::find('all', array('conditions' => "users_id_user = $id", 'order' => 'pontos desc', 'limit' => 10));

        \Tracy\Debugger::barDump($scores, "score");

        View::make('jogo_stb.private_area', ['scoresuser' => $scores]);
    }

    public function adminuser()
    {
        if (Post::has("search")) {
            $search = Post::get("search");

            $user = User::find('all', array('conditions' => "username LIKE '$search%'"));
            \Tracy\Debugger::barDump($user, "user");
            View::make('jogo_stb.admin_users', ['users' => $user]);

        } else {
            $users = User::all();
            View::make('jogo_stb.admin_users', ['users' => $users]);
        }
    }

    public function banuser($id)
    {
        $user = User::find(array('id_user' => $id));

        $user->estadoconta = 1;
        if ($user->is_valid()) {
            $user->save();
            Redirect::toRoute('user/adminuser');
        }
    }

    public function tirarban($id)
    {
        $user = User::find(array('id_user' => $id));

        $user->estadoconta = 0;
        if ($user->is_valid()) {
            $user->save();
            Redirect::toRoute('user/adminuser');
        }
    }

    public function tornaradmin($id)
    {
        $user = User::find(array('id_user' => $id));

        $user->tipouser = 1;
        if ($user->is_valid()) {
            $user->save();
            Redirect::toRoute('user/adminuser');
        }
    }

    public function removeradmin($id)
    {
        $user = User::find(array('id_user' => $id));

        $user->tipouser = 0;
        if ($user->is_valid()) {
            $user->save();
            Redirect::toRoute('user/adminuser');
        }
    }

    public function searchuser()
    {
        $search = Post::get("search");

        $user = User::find(array('username' => $search));

        Redirect::toRoute('jogo/admin', ['users-search' => $user]);
    }

    public function storepontos()
    {
        $score = new Score();

        $score->pontos = Session::get("pontos-p1");
        $score->users_id_user = Session::get("id_user");

        if ($score->is_valid()) {
            $score->save(false);
            Redirect::toRoute('jogo/game');

        } else {
            Redirect::flashToRoute('jogo/index');
        }

    }
}
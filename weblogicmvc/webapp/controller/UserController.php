<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Session;

class UserController extends BaseController
{
    public function conexao()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shutthebox";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

        }
    }

    public function index()
    {
        /* $user = User::all();
         View::make('jogo_stb.index', ['user' => $user]);*/
    }

    public function store()
    {
        $servername = "localhost:3308";
        $username = "root";
        $password = "";
        $dbname = "shutthebox";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $username = Post::get("username");
            $nome = Post::get("nome");
            $email = Post::get("email");
            $password = Post::get("password");
            $confirmPassword = Post::get("confirm-password");
            $dtaNascimento = Post::get("dtaNascimento");

            if ($password == $confirmPassword) {
                $sql = "INSERT INTO users (id_user, username, nome, email, password, dtaNascimento, tipoUser, estadoConta) 
                VALUES (NULL, '$username', '$nome', '$email', '$password', '$dtaNascimento', DEFAULT, DEFAULT)";

                $conn->exec($sql);
            }

            return View::make('jogo_stb.login');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;

    }

    public function create()
    {
        return View::make('jogo_stb.register');
    }

    public function login()
    {
        $servername = "localhost:3308";
        $username = "root";
        $password = "";
        $dbname = "shutthebox";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


            $email = Post::get("email");
            $password = Post::get("password");

            $stmt = $conn->prepare("SELECT * FROM users WHERE email='$email' and password='$password'");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                \Tracy\Debugger::barDump($row['estadoConta']);
                echo "10";
                if ($row['estadoConta'] == 0) {
                    $result = $stmt->fetch();
                    if ($stmt->execute() == 1) {

                        session::set($row['username'], 'username');
                        session::set($row['id_user'], 'id_user');


                        return View::make('jogo_stb.instructions');
                    } else {
                        echo "11";
                        return View::make('jogo_stb.login');
                    }
                } else {
                    echo "Foste banido!";
                }
            }


        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function editar_reg()
    {
        /*$servername = "localhost:3308";
        $username = "root";
        $password = "";
        $dbname = "shutthebox";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $username = Session::get("username");

            $stmt = $conn->prepare("SELECT * FROM users WHERE username='$username'");
            $stmt->execute();
            while ($row = $stmt->fetch()) {

                session::set($row['username'], 'username');
                session::set($row['nome'], 'nome');
                session::set($row['email'], 'email');
                session::set($row['password'], 'password');
                session::set($row['dtaNascimento'], 'dtaNascimento');

            }*/
        \Tracy\Debugger::barDump(session::get('nome'), 'nome');
        return View::make('jogo_stb.update_register');
        /*
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $conn = null;
        */
    }


    public function proc_editar_reg()
    {
        $servername = "localhost:3308";
        $username = "root";
        $password = "";
        $dbname = "shutthebox";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $username = Post::get("username");
            $nome = Post::get("nome");
            $email = Post::get("email");
            $password = Post::get("password");
            $confirmPassword = Post::get("confirm-password");
            $dtaNascimento = Post::get("dtaNascimento");

            $sql = "UPDATE users SET username='$username', nome = '$nome', email = '$email', password = '$password',
            dtaNascimento = '$dtaNascimento' WHERE id=2";

            // Prepare statement
            $stmt = $conn->prepare($sql);

            // execute the query
            $stmt->execute();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }


    }
}
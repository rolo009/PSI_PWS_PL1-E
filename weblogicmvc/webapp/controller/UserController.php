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


                $check_duplicates = $conn->prepare("SELECT * FROM users WHERE email='$email' or username='$username'");
                $check_duplicates->execute();

                $row = $check_duplicates->rowCount();

                if ($row == 0) {
                    $sql = "INSERT INTO users (id_user, username, nome, email, password, dtaNascimento, tipoUser, estadoConta) 
                VALUES (NULL, '$username', '$nome', '$email', '$password', '$dtaNascimento', DEFAULT, DEFAULT)";

                    $conn->exec($sql);
                } else {
                    echo "Utilizador já registado!";
                    return View::make('jogo_stb.register');
                }

            }
            echo "Utilizador registado com sucesso!!";
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

            $row = $stmt->rowCount();
            if ($row == 1) {
                while($lista = $stmt -> fetch(PDO::FETCH_ASSOC)):
                $id = $lista['id_user'];
                $tipoUser = $lista['tipoUser'];

                Session::set('email', $email);
                Session::set('id_user', $id);
                Session::set('tipo_utilizador', $tipoUser);

                    return View::make('jogo_stb.instructions');


                endwhile;

            } else {
                return View::make('jogo_stb.login');
            }

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function editar_reg()
    {
        $servername = "localhost:3308";
        $username = "root";
        $password = "";
        $dbname = "shutthebox";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $idUser = Session::get("id_user");

            $stmt = $conn->prepare("SELECT * FROM users WHERE id_user='$idUser'");
            $stmt->execute();
            while ($lista = $stmt -> fetch(PDO::FETCH_ASSOC)) {

                session::set('nome', $lista['nome']);
                session::set('email', $lista['email']);
                session::set('dtaNascimento', $lista['dtaNascimento']);

            }
        \Tracy\Debugger::barDump(session::get('nome'), 'nome');
        return View::make('jogo_stb.update_register');

                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $conn = null;

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
            //\Tracy\Debugger::barDump($nome, nopme);
            $idUser = Session::get("id_user");
            $nome = Post::get("nome");
            $email = Post::get("email");
            $password = Post::get("password");
            $confirmPassword = Post::get("confirm-password");
            $dtaNascimento = Post::get("dtaNascimento");

            if($password == ""){
                $sql = "UPDATE users SET nome = '$nome', email = '$email', dtaNascimento = '$dtaNascimento' WHERE id_user ='$idUser'";

                // Prepare statement
                $stmt = $conn->prepare($sql);

                // execute the query
                $stmt->execute();
            }

            else if ($password != ""){

                if($password == $confirmPassword){
                    $sql = "UPDATE users SET nome = '$nome', email = '$email', password = '$password',
            dtaNascimento = '$dtaNascimento' WHERE id_user ='$idUser'";

                    // Prepare statement
                    $stmt = $conn->prepare($sql);

                    // execute the query
                    $stmt->execute();
                }
            }

            return View::make('jogo_stb.private_area');

        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    public function logout()
    {
        Session::destroy();
        Redirect::toRoute('jogo/index');
    }

}
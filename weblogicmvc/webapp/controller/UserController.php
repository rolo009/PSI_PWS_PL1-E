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

            if($password == $confirmPassword){
                $sql = "INSERT INTO users (id_user, username, nome, email, password, dtaNascimento) 
                VALUES (NULL, '$username', '$nome', '$email', '$password', '$dtaNascimento')";

                $conn -> exec($sql);
            }

            return View::make('jogo_stb.login');
        } catch(PDOException $e) {
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
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $email = Post::get("email");
            $password = Post::get("password");

            $stmt = $conn->prepare("SELECT * FROM users WHERE email='$email' and password='$password'");
            $stmt->execute();

            if ($stmt->execute()  == 1){
                session::set($username, 'username');


                return View::make('jogo_stb.instructions');
            }

            // set the resulting array to associative
            /*$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                echo $v;
            }*/
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    public function editar_reg()
    {

    }



}
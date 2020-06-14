<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;
use ArmoredCore\Interfaces\ResourceControllerInterface;

class UserController extends BaseController implements ResourceControllerInterface
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
        $servername = "localhost";
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
                $sql = "INSERT INTO users (username, nome, email, pasword, dtaNascimento)
            VALUES ($username, $nome, $email, $password, $confirmPassword, $dtaNascimento)";

                $conn -> exec($sql);
            }

            echo "New record created successfully";
        } catch(PDOException $e) {
            echo "<br>" . $e->getMessage();
        }

        $conn = null;



    }

    public function create()
    {
        return View::make('jogo_stb.register');
    }

    public function show($id)
    {
        $user = User::find($id);

        \Tracy\Debugger::barDump($user);

        if (is_null($user)) {
            // redirect to standard error page
        } else {
            View::make('user.show', ['user' => $user]);
        }
    }

    public function edit($id)
    {
        /*$book = Book::find($id);

        if (is_null($book)) {
            // redirect to standard error page
        } else {
            View::make('book.edit', ['book' => $book]);
        }*/
    }

    public function update($id)
    {
        /*$book = Book::find($id);
        $book->update_attributes(Post::getAll());

        if($book->is_valid()){
            $book->save();
            Redirect::toRoute('book/index');
        } else {
            // return form with data and errors
            Redirect::flashToRoute('book/edit', ['book' => $book], $id);
        }*/
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Redirect::toRoute('jogo_stb/index');
    }

}
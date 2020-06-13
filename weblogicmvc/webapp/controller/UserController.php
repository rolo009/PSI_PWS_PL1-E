<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;
use ArmoredCore\Interfaces\ResourceControllerInterface;

class UserController extends BaseController implements ResourceControllerInterface
{
    public function index()
    {
        $user = User::all();
        View::make('jogo_stb.index', ['user' => $user]);
    }

    public function store()
    {
        // create new resource (activerecord/model) instance
        // your form name fields must match the ones of the table fields
        $user = new User(Post::getAll());

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('user/index');
        } else {
            // return form with data and errors
            Redirect::flashToRoute('user/create', ['user' => $user]);
        }
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
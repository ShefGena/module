<?php

class RegistrationController extends Controller
{

    public function __construct($data=array())
    {
        parent::__construct($data);
        $this->model = new Registrate();
    }

    public function index()
    {
        if ($_POST) {
            if ( !$_POST['login'] OR !$_POST['email'] OR !$_POST['password'] ) {
                Session::setFlash('Заполните пожалуйста все поля');
            }elseif ($this->model->save($_POST)) {
                Session::set('login', $_POST['login']);
                Session::set('role', '');
                Router::redirect('/pages/index');
            }
        }
    }

    public function admin_index(){
        //  $this->data = $this->model->getList();

    }
}
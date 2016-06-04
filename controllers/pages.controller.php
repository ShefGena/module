<?php

 class PagesController extends Controller
 {

     public function __construct($data = array())
     {
         parent::__construct($data);
         $this->model = new Page();

     }

     public function index(){
         $this->data['sport'] = $this->model->getLastNewsByCategory(1);
         $this->data['cars'] = $this->model->getLastNewsByCategory(2);
         $this->data['science'] = $this->model->getLastNewsByCategory(3);
         $this->data['slide'] = $this->model->getLastNews();
     }



     public function sport()
     {
        $this->data['sport'] = $this->model->getLastNewsByCategory(1);
         $this->data['count']= $this->model->getNumberOfPages(1);
         $this->data['news'] = $this->model->getPaginationNews($_GET['page'],1);
         $this->data['params'] = $this->params[0];
         $this->data['some_news'] = $this->model->getSomeNews($this->params[0]);
     }

     public function cars()
     {
         $this->data['cars'] = $this->model->getLastNewsByCategory(2);
         $this->data['count']= $this->model->getNumberOfPages(2);
         $this->data['news'] = $this->model->getPaginationNews($_GET['page'],2);
         $this->data['params'] = $this->params[0];
         $this->data['some_news'] = $this->model->getSomeNews($this->params[0]);
     }

     public function science()
     {
         $this->data['science'] = $this->model->getLastNewsByCategory(3);
         $this->data['count']= $this->model->getNumberOfPages(3);
         $this->data['news'] = $this->model->getPaginationNews($_GET['page'],3);
         $this->data['params'] = $this->params[0];
         $this->data['some_news'] = $this->model->getSomeNews($this->params[0]);
     }

     public function view() {
         $params = App::getRouter()->getParams();

         if (isset($params[0])){
             $alias = strtolower($params[0]);
             $this->data['page'] = $this->model->getByAlias($alias);
         }
     }

     public function admin_index()
     {
        $this->data['pages'] = $this->model->getList();
     }

     public function admin_add()
     {
         if ($_POST) {

             $result = $this->model->save($_POST);
             if ($result) {
                 Session::setFlash('Page was saved');
             } else {
                 Session::setFlash('Error.');
             }
             Router::redirect('/admin/pages/');
         }
     }

     public function admin_edit()
     {

         if ($_POST) {
             $id = $_POST['id'];
             $this->model->save($_POST, $id);

             Router::redirect('/admin/pages/');
         }

         if(isset($this->params[0])) {
             $this->data['page'] = $this->model->getById($this->params[0]);
         } else {
             Session::setFlash('Wrong page id.');
             Router::redirect('/admin/pages/');
         }

     }

     public function admin_delete(){
         if (isset($this->params[0])) {
             $result = $this->model->delete($this->params[0]);
             if ($result) {
                 Session::setFlash('Page was saved');
             } else {
                 Session::setFlash('Error.');
             }
             Router::redirect('/admin/pages/');

         }
     }
 }
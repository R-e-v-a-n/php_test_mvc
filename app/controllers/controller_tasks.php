<?php

namespace test_mvc\controllers;
use test_mvc\core\AppController;
use test_mvc\core\AppView;
use test_mvc\models\Model_Tasks;
use test_mvc\classes\Image_Loader;

    class Controller_Tasks extends AppController
    {
        function __construct()
        {
            $this->model = new Model_Tasks();
            $this->view  = new AppView();
        }

        function action_show()
        {
            $this->model->setPage($this->param1 - 1);
            $data = $this->model->get_data();
            $this->view->generate('tasks_view.php', 'template_view.php', $data); //
        }

        function action_default()
        {
            header('Location:/Tasks/Show');
        }

        function action_sort()
        {
            if(!empty($_POST['order_fld']) and !empty($_POST['order_dir']))
                $this->model->set_order($_POST['order_fld'],$_POST['order_dir']);
                
            header('Location:/Tasks/Show');
        }

        function action_edit()
        {
            if(!$this->check_post_data(['id']) or !is_numeric($_POST['id']))
            {
                header('Location:/Tasks/Show');
                return;                
            }
            $id = intval($_POST['id']);
            $task = $this->model->get_task_by_id($id);
            if(empty($task))
            {
                header('Location:/Tasks/Show');
                return;
            }

            $data = [
                'action'        => 'edit',
                'error'         => '',
                'action_status' => ''
            ];
            $data += $task;
            
            if($this->check_post_data(['status','description'])) 
            {
                $data['description']    = trim(htmlspecialchars($_POST['description'],ENT_QUOTES));
                if(($_POST['status'] == 0) or ($_POST['status'] == 1)) $data['status'] = $_POST['status'];

                $this->model->do_edit_task($data['id'],$data['description'],$data['status']);
                
                header('Location:/Tasks/Show');
                return;
            }
            $this->view->generate('task_view.php', 'template_view.php',$data);         
        }

        function action_add()
        {
            $data = [
                'action'        => 'add',
                'error'         => '',
                'action_status' => '',

                'username'      => '',
                'e-mail'        => '',
                'description'   => ''
            ];

            if ($this->check_post_data(['username','e-mail','description']) 
                and !empty($_FILES['img']))
            {
                $data['username']       = trim($_POST['username']);

                $template = '/^[a-z][a-z\d]*(_[a-z\d]+)?$/i';
                if(!preg_match($template,$data['username'])) $data['error'] = 'Некорректное имя';

                $data['e-mail']         = trim(htmlspecialchars($_POST['e-mail'], ENT_QUOTES));
                $data['description']    = trim(htmlspecialchars($_POST['description'],ENT_QUOTES));

                if(empty($data['error']))
                {
                    $img = Image_Loader::load_image($_FILES['img']);
                    if($img)
                    {
                        if(empty($data['error']))
                        {
                            $this->model->do_add_task($data['username'], $data['e-mail'], $data['description'],$img);
                        }
                    }
                    else $data['error'] = 'Ошибка загрузки файла';
                }
                $data['action_status'] = ($data['error'] != '' ? 'error' : 'success');
            }
            $this->view->generate('task_view.php', 'template_view.php',$data);
        }
    }

<?php

namespace test_mvc\models;

use test_mvc\core\AppModel;
use test_mvc\classes\DB;

    class Model_Tasks extends AppModel
    {
        private $page;
        private $items_count;
        private $pages_count;

        public function get_task_by_id($id)
        {
            $sql = "SELECT * FROM tb_tasks WHERE `id`=$id";
            return DB::query($sql)[0];
        }

        public function do_add_task($username, $email, $description, $img)
        {
            $username       = DB::escape_string($username);
            $email          = DB::escape_string($email);
            $description    = DB::escape_string($description);

            $sql  = "INSERT INTO tb_tasks (`username`,`e-mail`,`description`,`img`)".
                    " VALUES ('$username','$email','$description','$img')";
            DB::query($sql);   
        }

        public function do_edit_task($id,$description,$status)
        {
            $description    = DB::escape_string($description);

            $sql  = "UPDATE tb_tasks SET `description`= '$description', `status`=$status WHERE `id`=$id";
            DB::query($sql);
        }

        public function setPage($page)
        {
            if(empty($page)) $page = 0;
            if(!is_numeric($page)) $page = 0;

            $res = DB::query('SELECT COUNT(*) AS count FROM tb_tasks');

            $this->items_count = $res[0]['count'];
            $this->pages_count = ceil($this->items_count / 3);

            if(($page < 0) or ($page > $this->pages_count)) $page = 0;

            $this->page = $page;
        }

        public function set_order($order_fld, $order_dir)
        {
            $fld_array = array('id','username','e-mail','status');
            $dir_array = array('ASC','DESC');

            if(in_array($order_fld,$fld_array)) $_SESSION['order_fld'] = $order_fld;
            if(in_array($order_dir,$dir_array)) $_SESSION['order_dir'] = $order_dir;
        }

        public function get_data()
        {
            if(empty($_SESSION['order_fld'])) $_SESSION['order_fld'] = 'id';
            if(empty($_SESSION['order_dir'])) $_SESSION['order_dir'] = 'ASC';

            $start = $this->page*3;
            $end   = $start + 3;

            $sql  = 'SELECT * FROM tb_tasks';
            $sql .= ' ORDER BY `'.$_SESSION['order_fld'].'` '.$_SESSION['order_dir'];
            $sql .= ' LIMIT '.$start.','.$end;

            $result = DB::query($sql);

            return array(
                'pages_info' => array(
                    'count' => $this->pages_count,
                    'current_page' => $this->page
                ),
                'items_info' => array(
                    'count' => $this->items_count,
                ),
                'items' => $result,
            );
        }

    }

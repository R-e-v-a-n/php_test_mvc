<?php

namespace test_mvc\classes;
use mysqli;

    class DB
    {
        protected static $_instance;

        public static function getInstance()
        {
            if (self::$_instance === null) self::$_instance = new self;
            return self::$_instance;
        }

        private function __construct()
        {
            $this->mysqli = new mysqli(Config::get('MYSQL_HOST'), Config::get('MYSQL_USERNAME'), Config::get('MYSQL_PASSWORD'));
            $this->mysqli->select_db(Config::get('MYSQL_DATABASE'));
            $this->connect = !$this->mysqli->connect_error;
            if ($this->mysqli->connect_error)
            {
                die('Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
            }
        }

        private function __clone() {}

        private function __wakeup() {}

        public static function escape_string($escape_str)
        {
            $obj = self::$_instance;
            return $obj->mysqli->escape_string($escape_str);
        }

        public static function query($sql)
        {
            $obj = self::$_instance;

            if (isset($obj->connect)) {
                if($obj->mysqli->real_query($sql))
                {
                    $result = $obj->mysqli->store_result();
                    if(is_object($result))
                    {
                        return $result->fetch_all(MYSQLI_ASSOC);
                    }
                    else
                    {
                        return $result;
                    }
                }
                else
                {
                    return false;
                }
            }
            return false;
        }

        public static function getMysqli()
        {
            return $obj = self::$_instance->mysqli;
        }
    }
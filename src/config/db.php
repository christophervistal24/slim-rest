<?php
    class DB
    {
        //properties
        //in my server I don't set a password that's why I did not include it on the configs variable
        //but in your localmachine you used include password
        private $configs = [
            'dbhost' => 'localhost',
            'dbuser' => 'root',
            'dbname' => 'slim_app',
        ];

        public function connect()
        {
            $con = new PDO('mysql:hostname='.$this->configs['dbhost'].';dbname='.$this->configs['dbname'].'',$this->configs['dbuser'],'');
            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $con;
        }
    }
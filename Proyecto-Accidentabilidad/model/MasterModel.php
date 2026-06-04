<?php 

    include_once "../lib/conf/connection.php";

    class MasterModel extends connection{


        public function insert($sql){
            $query = pg_query($this->getConnect(), $sql);

            return $query;
        }

        public function select($sql){
            $query = pg_query($this->getConnect(), $sql);
            return $query;
        }
        public function update ($sql){
            $query = pg_query($this->getConnect(), $sql);
            return $query;
        }
        public function delete($sql){
            $query = pg_query($this->getConnect(), $sql);
            return $query;
        }



    }



?>
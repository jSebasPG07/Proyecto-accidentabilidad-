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
        public function autoincrement($table, $field)
        {
        $sql = "SELECT COALESCE(MAX($field), 0) AS max FROM $table";
        $result = pg_query($this->getConnect(), $sql);
        $row = pg_fetch_assoc($result);
        return $row['max'] + 1;
        }



    }



?>
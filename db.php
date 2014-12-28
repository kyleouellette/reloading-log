<?php
/**
 * create a config.php file and define DB_USERNAME and DB_PASSWORD
 * this will be used during the connection. It's ignored from the 
 * git repo for security reasons
 */
require('config.php');

class Database{
   private $DB_HOST = '127.0.0.1';
   private $DB_NAME = 'reloading_log';
   private $DB_USERNAME = DB_USERNAME;
   private $DB_PASSWORD = DB_PASSWORD;
   private $conn;

   function __construct(){
      $this->conn = new mysqli('127.0.0.1', $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);
      /* check connection */
      if ($this->conn->connect_errno) {
          printf("Connect failed: %s\n", $mysqli->connect_error);
          exit();
      }
      // $this->create_table();
      return $this;
   }

   private function create_table(){
      $query = "CREATE TABLE if not exists`log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `caliber` varchar(255) NOT NULL DEFAULT '',
  `bullet` varchar(255) NOT NULL DEFAULT '',
  `charge` varchar(255) NOT NULL DEFAULT '',
  `CC` varchar(255) DEFAULT NULL,
  `COL` float DEFAULT NULL,
  `report` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";

      if($this->conn->query($query) === true){
         return $this;
      }
      echo "BAD CONNECTION";
      return false;
   }

   public function get(){
      $query = "select * from log order by caliber";
      $res = $this->conn->query("SELECT * FROM log");
      return $res;
   }

   public function get_by_id($id){
      $query = "select * from log where `id`=? limit 1";
      $results = $this->conn->prepare($query);
      $results->bind_param('s', $id);
      $results->execute();
      return $results->get_result();
   }

   public function update_property($id, $name, $value){
      /**
       * GOOD GOD! USE MYSQLI RIGHT!!!
       * This is not how mysqli should be doing update statements. Update this code
       * to use prepared statements like the rest of it!
       */
      $query = "UPDATE log SET `$name`='$value' where `id`=$id";
      $res = $this->conn->query($query) || die($this->conn->error);
      
      return null;
   }

   public function delete_by_id($id){
      $query = "delete from log where id=?";
      $res = $this->conn->prepare($query);
      $res->bind_param('s', $id);
      $res->execute();
      return null;
   }

   public function create_load($cal, $bullet, $charge, $cc, $col, $report){
      $query = "insert into log set `caliber`=?,`bullet`=?, `charge`=?, `cc`=?, `col`=?, `report`=?";
      $res = $this->conn->prepare($query);
      $res->bind_param('ssssss', $cal, $bullet, $charge, $cc, $col, $report);
      $res->execute();
   }

}
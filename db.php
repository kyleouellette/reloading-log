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
      $this->create_table();
   }

   private function create_table(){
      $query = "CREATE TABLE if not exists `log` (
         `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
         `caliber` varchar(255) NOT NULL DEFAULT '',
         `charge` float NOT NULL,
         `CC` float DEFAULT NULL,
         `COL` float DEFAULT NULL,
         `report` text,
         PRIMARY KEY (`id`)
         ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;";

      if($this->conn->query($query) === true){
         return this;
      }
      echo "BAD CONNECTION";
      return false;
   }

   public function get(){
      $query = "select * from log";
      $res = $this->conn->query("SELECT * FROM log");
      return $res;
   }

   public function update_property($id, $name, $value){
      /**
       * THIS IS NOT THE WAY THE QUERY SHOULD BE DONE
       * YOU HAVE PREPARED STATEMENTS FOR A REASON, YOU DOUCHE
       * THIS CODE SHOULD BE UPDATED
       */
      $query = "UPDATE `log` SET $name = '$value' where id='$id'";
      $res = $this->conn->query($query);
      return null;
   }

   public function delete_by_id($id){
      $query = "delete from log where id=?";
      $res = $this->conn->prepare($query);
      $res->bind_param('s', $id);
      $res->execute();
      return null;
   }

   public function create_load($cal, $charge, $cc, $col, $report){
      $query = "insert into log set `caliber`=?, `charge`=?, `cc`=?, `col`=?, `report`=?";
      $res = $this->conn->prepare($query);
      $res->bind_param('sssss', $cal, $charge, $cc, $col, $report);
      $res->execute();
   }

}
<?php

class StudentsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_escuela; charset=utf8', 'root', '');
        
    }


    public function getAll($column, $filtervalue, $orderBy, $order, $limit, $page){
       
        $params = []; 

        $querySentence = "SELECT * FROM estudiantes ";
        
        if($column != null){
            //aca tengo que ver si el $filter
            $querySentence .= " WHERE  $column = ?";
            array_push($params, $filtervalue);
        }

        if($orderBy != null){
            $querySentence .= "ORDER BY $orderBy";
        }
        if($order != null){
            $querySentence .= " $order";
        }
       //Si no indico el page, es cero. Si lo indico continuo para obtener eloffset
        if($page == null){
            $page=0;
        }

        if($limit != null){
            $offset = $page * $limit - $limit;
            $querySentence .= " LIMIT  $limit OFFSET $offset";
        }

        $query = $this->db->prepare($querySentence);
        $query->execute($params);
        $students = $query->fetchAll(PDO::FETCH_OBJ); 
        return $students;
    }


























    public function get($id){
        $query = $this->db->prepare('SELECT * FROM estudiantes WHERE NDNI = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }


    public function removeStudent($id) {
        $query = $this->db->prepare('DELETE FROM estudiantes WHERE NDNI = ?');
        $query->execute([$id]);
    }

   
  


    public function insert($NDNI,$Nombre,$Direccion,$Telefono,$Curso,$Division){
       
        $query=$this->db->prepare('INSERT INTO `estudiantes` (`NDNI`,`Nombre`,`Direccion`,`Telefono`,`Curso`, `Division`) VALUES (?,?,?,?,?,?)');
        $query->execute([$NDNI , $Nombre, $Direccion, $Telefono ,$Curso ,$Division]);
 
        return $this->db->lastInsertId();  
    }
    

}
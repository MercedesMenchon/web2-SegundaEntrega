<?php

class StudentsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_escuela; charset=utf8', 'root', '');
        
    }


    public function getAll($column, $filtervalue, $orderBy, $order, $limit, $page){
       
        $params = []; 

        
        $offset = $page * $limit - $limit;
        
        $querySentence = "SELECT * FROM estudiantes ";

        if($column != null){
            //aca tengo que ver si el $filter
            $querySentence .= " WHERE  $column LIKE ? ";
            array_push($params, "$filtervalue%");
        }

        $querySentence .= "ORDER BY $orderBy $order LIMIT $limit OFFSET $offset";


        $query = $this->db->prepare($querySentence);
        $query->execute($params);
        $students = $query->fetchAll(PDO::FETCH_OBJ); 
        return $students;
    }

    public function get($id){
        $query = $this->db->prepare('SELECT * FROM estudiantes WHERE ndni = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function removeStudent($id) {
        $query = $this->db->prepare('DELETE FROM estudiantes WHERE ndni = ?');
        $query->execute([$id]);
    }

       public function insert($ndni,$nombre,$direccion,$telefono,$curso,$division){
       
        $query=$this->db->prepare('INSERT INTO `estudiantes` (`ndni`,`nombre`,`direccion`,`telefono`,`curso`, `division`) VALUES (?,?,?,?,?,?)');
        $query->execute([$ndni , $nombre, $direccion, $telefono ,$curso ,$division]);
 
        return $this->db->lastInsertId();  
    }
    
    public function editar($NDNIEditar,$NDNI,$Nombre,$Direccion,$Telefono,$Curso,$Division){
        $query=$this->db->prepare('UPDATE estudiantes SET `ndni`=?, `nombre`=? ,`direccion`=? ,`telefono`=? ,`curso`=?, `division`=? WHERE `ndni` = ?');
        $query->execute([$NDNI,$Nombre,$Direccion,$Telefono,$Curso,$Division,$NDNIEditar]);
            
        }
}
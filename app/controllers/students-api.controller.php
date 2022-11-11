<?php
require_once './app/models/students.model.php';
require_once './app/views/api.view.php';

class StudentsApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new StudentsModel();
        $this->view = new ApiView();
        
        //lee el body del request
        $this->data = file_get_contents("php://input");
    }

    //Convertir en Json

    private function getData() {
      return json_decode($this->data);
   }

   private function validate($column, $orderBy, $order, $limit, $page){
    $columns = ["ndni","nombre","direccion","telefono","curso" ];

    if(isset($column) & !in_array(strtolower($column), $columns)){
     $this->view->response("No se encontraron la columna indicada para la condición", 400);
       die();
    }
    
    if(isset($orderBy) & !in_array(strtolower($orderBy), $columns)){
      $this->view->response("No se encontraron la columna indicada para orderBy", 400);
      die();
    }
 
    $orders=["asc","desc"];
    if(isset($order) & !in_array(strtolower($order), $orders)){
      $this->view->response("No se puede ordenar de laforma indicada", 400);
      die();
    }
    if ((isset($page)) & is_numeric($page) & $page >= 0){
      return $this->view->response("No se puede mostrar la página indicada", 400);
      die();
    }
    if ((isset($limit)) & is_numeric($limit) & $limit >= 0){
      return $this->view->response("No se puede mostrar el limite indicado", 400);
      die();
    }

   }

    public function getAll($params = null)
    {
      try{
      $column =  $_GET["column"]?? null;  
      $filtervalue = $_GET["filtervalue"] ?? null;
      $orderBy = $_GET["orderBy"] ?? "ndni";
      $order = $_GET["order"] ?? "desc";
      $limit = $_GET["limit"] ?? null;
      $page =  $_GET["page"] ?? null;
      
     $this->validate($column, $orderBy, $order, $limit, $page);
     

    $students = $this->model->getAll($column, $filtervalue, $orderBy, $order, $limit, $page);

if($students)
    return $this->view->response($students, 200);
else
    $this->view->response("No se encontraron estudiantes", 404);
}
    catch(Exception $e){
      var_dump($e);

    }

  }
    public function get($params = null)
    {
      $id = $params[':ID'];
      $students = $this->model->get($id);

      if ($students)
          $this->view->response($students);
      else 
          $this->view->response("El estudiante solicitado con el DNI=$id no existe", 404);
  }


  public function removeStudent($params = null){
    $id = $params[':ID'];
    $student =$this->model->get($id);

    if (!(empty($student))){
    $this->model->removeStudent($id);
    $this->view->response("El estudiante con el DNI=$id ha sido eliminado");
    }
else 
    $this->view->response("El estudiante solicitado con el DNI=$id no existe", 404);
  }



  public function insertStudent($params = null){
 $student=$this->getData();

 if (empty($student->NDNI) || empty($student->Nombre) || empty($student->Direccion)|| empty($student->Telefono)|| empty($student->Curso)|| empty($student->Division)) {
  $this->view->response("Los datos no se encuentran completos", 400);
} else {
if(empty($this->model->get($student->NDNI))){
  $this->model->insert($student->NDNI, $student->Nombre, $student->Direccion,$student->Telefono,$student->Curso,$student->Division);
  $added = $this->model->get($student->NDNI);

  $this->view->response($added, 201);
}
else{
  $this->view->response("Ya se encuentra ingresado un estudiante con el NDNI", 400);
}
}


}
}

<?php
require_once './app/models/students.model.php';
require_once './app/views/api.view.php';


class StudentsApiController
{
  private $model;
  private $view;


  private $data;

  public function __construct()
  {
    $this->model = new StudentsModel();
    $this->view = new ApiView();


    //lee el body del request
    $this->data = file_get_contents("php://input");
  }

  //Convertir en Json

  private function getData()
  {
    return json_decode($this->data);
  }

  private function validate($column, $filtervalue, $orderBy, $order, $limit, $page)
  {

    $columns = ["ndni", "nombre", "direccion", "telefono", "curso"];

    if (isset($column) && !in_array(strtolower($column), $columns)) {

      $this->view->response("No se encontro la columna indicada para la condición", 400);
      die();
    } else {
      if (isset($column)  && empty($filtervalue)) {
        $this->view->response("Debe definir un valor para el filtervalue", 400);
        die();
      }
    }


    if (isset($orderBy) && !in_array(strtolower($orderBy), $columns)) {
      $this->view->response("No se encontro la columna indicada para orderBy", 400);
      die();
    }

    $orders = ["asc", "desc"];
    if (isset($order) && !in_array(strtolower($order), $orders)) {
      $this->view->response("No se puede ordenar de la forma indicada", 400);
      die();
    }
    if ((isset($page)) && (!is_numeric($page) || $page <= 0)) {
      $this->view->response("No se puede mostrar la página indicada", 400);
      die();
    }
    if ((isset($limit)) && (!is_numeric($limit) || $limit <= 0)) {
      $this->view->response("No se puede mostrar el limite indicado", 400);
      die();
    }
  }

  public function getAll($params = null)
  {

    try {
      $column =  $_GET["column"] ?? null;
      $filtervalue = $_GET["filtervalue"] ?? null;
      $orderBy = $_GET["orderBy"] ?? "ndni";
      $order = $_GET["order"] ?? "desc";
      $limit = $_GET["limit"] ?? 20;
      $page =  $_GET["page"] ?? 1;

      $this->validate($column, $filtervalue, $orderBy, $order, $limit, $page);

      $students = $this->model->getAll($column, $filtervalue, $orderBy, $order, $limit, $page);


      if ($students) {
        $this->view->response($students, 200);
      } else {
        $this->view->response("No se encontraron estudiantes", 204);
      }
    } catch (Exception $e) {
      $this->view->response($e->getMessage(), 500);
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


  public function removeStudent($params = null)
  {
    $id = $params[':ID'];


    $student = $this->model->get($id);

    if (!(empty($student))) {
      $this->model->removeStudent($id);
      $this->view->response("El estudiante con el DNI=$id ha sido eliminado");
    } else
      $this->view->response("El estudiante solicitado con el DNI=$id no existe", 404);
  }



  public function insertStudent($params = null)
  {
    $student = $this->getData();


    if (empty($student->ndni) || empty($student->nombre) || empty($student->direccion) || empty($student->telefono) || empty($student->curso) || empty($student->division)) {
      $this->view->response("Los datos no se encuentran completos", 400);
    } else {

      if (is_numeric($student->ndni) && is_numeric($student->telefono) & is_numeric($student->curso)) {

        if (empty($this->model->get($student->ndni))) {
          $this->model->insert($student->ndni, $student->nombre, $student->direccion, $student->telefono, $student->curso, $student->division);
          $added = $this->model->get($student->ndni);
          $this->view->response($added, 201);
        } else {
          $this->view->response("Ya se encuentra ingresado un estudiante con el NDNI indicado", 400);
        }
      } else {
        $this->view->response("El número de DNI, telefono y curso deben ser datos numéricos", 400);
      }
    }
  }


  public function editStudent($params = null)
  {
    $id = $params[':ID'];
    $student = $this->getData();

    if ($this->model->get($id)) {
      if (empty($student->ndni) || empty($student->nombre) || empty($student->direccion) || empty($student->telefono) || empty($student->curso) || empty($student->division)) {
        $this->view->response("Los datos no se encuentran completos", 400);
      } else {
        if (is_numeric($student->ndni) && is_numeric($student->telefono) & is_numeric($student->curso)) {
          if (($student->ndni) == $id || empty($this->model->get($student->ndni))) {
            $this->model->editar($id, $student->ndni, $student->nombre, $student->direccion, $student->telefono, $student->curso, $student->division);
            $edit = $this->model->get($student->ndni);
            $this->view->response($edit, 201);
          } else {
            $this->view->response("Ya se encuentra ingresado un estudiante con el NDNI indicado", 400);
          }
        } else {
          $this->view->response("El número de DNI, telefono y curso deben ser datos numéricos", 400);
        }
      }
    } else {
      $this->view->response("No se encuentra un estudiante con el ndni indicado para editar", 400);
    }
  }
}

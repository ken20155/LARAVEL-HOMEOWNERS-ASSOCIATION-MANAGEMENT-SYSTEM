<?php 
namespace App\Http\Controllers\Components\Clients;
use App\Models\MainModel;
use App\Http\Controllers\Helpers\Helpers;
class Clients 
{
    function __construct() {
        $this->model = new MainModel();
        $this->module = Helpers::last_segment();
        Helpers::getView('Clients');
    }
    public static function js(){
        return [
            'js/sample'
        ];
    }
    public function defaultPage($params){
        $data = [];
        return [
            'test' => 'ken'
        ];
    }
    public function listClients(){
        $post = Helpers::post();
        $sql = "SELECT * FROM tbl_clients WHERE deleted = 0";
        $result =  $this->model->getResults($sql, []);  
        $data = [];
        $x = 1;
        if ($result) {
            foreach ($result as $key => $R) {
                $crdentials = '
                                 data-id = "'.$R->client_id.'"
                             ';
                $data[] = [
                 '#' => $x++,
                 'full_name' => $R->first_name.' '.$R->middle_name.' '.$R->last_name,
                 'email' => $R->email,
                 'phone_number' => $R->contact_no,
                 'action' => '
                         <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Action
                         </button>
                         <div class="dropdown-menu dropdown-menu-right">
                         <a class="dropdown-item" href="javascript:void(0);" '.$crdentials.' id = "viewData"><span class="fe fe-16 fe-edit"></span> Edit</a>
                         <a class="dropdown-item" href="javascript:void(0);" '.$crdentials.' id = "deleteData"><span class="fe fe-16 fe-trash-2"></span>  Delete</a>
                         </div>
                 ',
                ];
             }
        }
        return Helpers::generateDataTable($data);
    }
    public function viewData(){
        $post = Helpers::post();
        extract($post);
        $sql = 'SELECT * FROM tbl_clients WHERE client_id = ?';
        $param = [$id];
        $row =  $this->model->getRow($sql, $param);
        $d['data'] = $row;
        return [
            'action' => 'Edit',
            'body' =>  view('modal-content.view', $d)->render(),
            'footer' =>  '<button type="submit" class="btn btn-primary btn-sm">Save</button>',
        ];
    }
    public function addNew(){
        $post = Helpers::post();
        extract($post);
        $d['data'] = false;
        return [
            'action' => 'Add New',
            'body' =>  view('modal-content.view', $d)->render(),
            'footer' =>  '<button type="submit" class="btn btn-primary btn-sm">Save</button>',
        ];
    }
    public function crudAction(){
        $post = Helpers::post();
        if ($post['action'] == 'add') {
            return $this->createData($post);
        }else{
            return $this->updateData($post);
        }
    }
    public function createData($post){
        extract($post);
        $data['first_name'] = $first_name;
        $data['middle_name'] = $middle_name;
        $data['last_name'] = $last_name;
        $data['email'] = $email;
        $data['contact_no'] = $phone_number;
        $data['address'] = $address;
        $res = $this->model->insert('tbl_clients', $data);
        if ($res) {
            $response['success'] = true;
            $response['msg'] = 'Successfully Added!';
        }
        return $response;
    }
    public function updateData($post){
        extract($post);
        $data['first_name'] = $first_name;
        $data['middle_name'] = $middle_name;
        $data['last_name'] = $last_name;
        $data['email'] = $email;
        $data['contact_no'] = $phone_number;
        $data['address'] = $address;
        $where = [
            ['field' => 'client_id','value'=> $client_id]
        ];
        $res = $this->model->updateWhere('tbl_clients', $where, $data);
        if ($res) {
            $response['success'] = true;
            $response['exist'] = false;
            $response['msg'] = 'Successfully Updated!';
        }
        return $response;
    }
    public function deleteData(){
        $post = Helpers::post();
        $data['deleted'] = 1;
        $where = [
            ['field' => 'client_id','value'=> $post['id']]
        ];
        $res = $this->model->updateWhere('tbl_clients', $where, $data);
        if ($res) {
            $response['success'] = true;
            $response['msg'] = 'Deleted Successfully';
        }else{
            $response['success'] = false;
            $response['msg'] = 'Error';
        }
        return response()->json($response);
    }
}
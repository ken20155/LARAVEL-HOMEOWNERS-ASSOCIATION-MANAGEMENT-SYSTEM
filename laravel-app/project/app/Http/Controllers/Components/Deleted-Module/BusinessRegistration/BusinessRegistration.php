<?php 
namespace App\Http\Controllers\Components\BusinessRegistration;
use App\Models\MainModel;
use App\Http\Controllers\Helpers\Helpers;
class BusinessRegistration 
{

    function __construct() {
        $this->model = new MainModel();
        $this->module = Helpers::last_segment();
        Helpers::getView('BusinessRegistration');
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
    public function sampleDataTable(){
        $post = Helpers::post();
        $sql = "SELECT * FROM test_table";
        $result =  $this->model->getResults($sql, []);  
        $data = [];
        foreach ($result as $key => $R) {
           $data[] = [
            'status' => $R->status,
            'batch' => $R->batch.'awd',
            'created_at' => $R->created_at,
           ];
        }
        return Helpers::generateDataTable($data);
    }
    public function openModalAdd(){
        $post = Helpers::post();
        $data['test'] = 'test';

        return [
            'data' =>  view('modal-views.modal-add', $data)->render()
        ];
    }

}
<?php 
namespace App\Http\Controllers\Components\TestModule;
use App\Http\Controllers\Controller;
use App\Models\MainModel;
use App\Http\Controllers\Helpers\Helpers;

class TestModule extends Controller
{
    function __construct() {
        $this->model = new MainModel();
    }
    public static function myPlugins(){
        return [];
    }
    public function defaultPage($params){
        return [
            'test' => $params
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
}
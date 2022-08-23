<?php
    
class BaseController {
  
    /**
     * Description: 
     * + path name: folder.fileName
     * + Lấy từ sau thư mục view
     */
    public function view($viewpath, array $data = []) {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        return require  BASE_PATH.'/views'.'/'. str_replace('.', '/', $viewpath).'.php';
    }
    
    protected function load_model($model_name){
        $modelpath = BASE_PATH.'/models'.'/'.$model_name.'.php';        
        require_once $modelpath;
        return new $model_name;
    }

    protected function load_model_public($model_name){
        $modelpath = BASE_PATH.'/frontModel'.'/'.$model_name.'.php';        
        require_once $modelpath;
        return new $model_name;
    }

    protected function load_library($lib_name){        
        $libpath = BASE_PATH.'/system/library'.'/'.$lib_name.'.php';
        require_once $libpath;
        return new $lib_name;
    }
 
}

?>

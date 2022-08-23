<?php

class Upload_img {

    var $upload_path = '';
    var $max_size  = 0;
    var $file_size = 0;
    var $file_temp = '';
    var $file_name = '';
    var $file_ext  = '';
    var $error = '';

    /**
     * Used
     * $upload_path = UPLOAD_PATH.'animal';
     * @var Xét_biến_upload_path
     * $upl->set_upload_path($upload_path);
     * @var có_thể_sét_max_size 
     * $upl->set_max_filesize(2048);
     * @var Kiểm_tra_và_đồng_thời_upload_và_trả_về_REALPATH_nếu_đúng
     * @var Nếu_sai_thì_báo_lỗi
     * if($upl->do_upload('post_img')){
     *    echo $upl->get_path_dir(DEFAULT_IMG_DIR.'animal/');
     * }else {
     *    echo $upl->get_error();
     * }   
     */

    public function do_upload($field = 'user_img', $upload_now = 'yes') {
        // var_dump($_FILES);
        // Is $_FILES[$field] set? If not, no reason to continue.
        if (!isset($_FILES[$field])) {
            $this->set_error('upload no file selected');
            return FALSE;
        }
        $this->file_temp = $_FILES[$field]['tmp_name'];
        $this->file_size = $_FILES[$field]['size'];
        $this->file_name = rand(100, 999).'-'.substr(time(), -3, 3).'-'.$_FILES[$field]['name'];
        $this->file_ext  = strtolower(pathinfo($this->file_name, PATHINFO_EXTENSION));

        // check xem file có phải là ảnh k
        if(!($this->isImg($this->file_temp))){
            return false;
        }
        // check đuôi có phải là ảnh k?
        if(!($this->checkExt($this->file_ext))){
            return false;
        }
        // Convert the file size to kilobytes
        if ($this->file_size > 0) {
            $this->file_size = round($this->file_size / 1024, 2);
        }
        // check dung lượng upload < max_size
        if( $this->max_size > 0 && $this->file_size > $this->max_size){
            $msg = "File size must be smaller ".$this->max_size.'kb';
            $this->set_error($msg);
            return false;
        }
        if($upload_now == 'yes'){
            if($this->validate_upload_path()){
                $folder_path = $this->upload_path.$this->file_name;
                move_uploaded_file($_FILES[$field]['tmp_name'], $folder_path);
            }else{
                return false;
            }
        }
        return true;
    }
 

    public function isImg($file) {
        $check = getimagesize($file);
        if($check === false) {
            $msg = "File is not an image.";
            $this->set_error($msg);
            return false;
        }
        return true;
    }

    public function checkExt($ext) {
        $extension = array('jpg', 'png', 'jpeg', 'gif');
        if(!in_array($ext, $extension)){
            $msg = "The file extension is not of the image";
            $this->set_error($msg);
            return false;
        }
        return true;
    }

    public function validate_upload_path() {
        if ($this->upload_path == '') {
            $this->set_error('upload no filepath');
            return FALSE;
        }
        if (strpos($this->upload_path, '\\') != 0) {
            $this->upload_path = str_replace("\\", "/", $this->upload_path);
        }
        return true;
    }

    public function set_upload_path($path) {
        // Make sure it has a trailing slash
        $this->upload_path = rtrim($path, '/') . '/';
    }

    public function set_max_filesize($n) {
        $this->max_size = ((int)$n < 0) ? 0 : (int)$n;
    }

    public function set_error($msg = '') {
        $this->error =  $msg;
    }

    public function get_error() {
        return $this->error;
    }

    public function get_path_dir($dir) {
        return rtrim($dir, '/') . '/'.$this->file_name;
    }


}
 
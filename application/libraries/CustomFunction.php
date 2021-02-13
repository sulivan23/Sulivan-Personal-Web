<?php 
@(session_start());
date_default_timezone_set('Asia/Jakarta');

class CustomFunction{

    public $pages;

    public function getSize($size) 
    {
        if($size < 1000000){
            $ukuran_file = $size / 1024;
            if(strlen($size) == 6){
                return substr($ukuran_file,0,6). " KB";
            }
            elseif(strlen($size) == 5){
                return substr($ukuran_file,0,5). " KB";
            }
            elseif(strlen($size) == 4){
                return substr($ukuran_file,0,4). " KB";
            }
            elseif(strlen($size) == 3){
                return substr($ukuran_file,0,3). " KB";
            }
            elseif(strlen($size) == 2){
                return substr($ukuran_file,0,2). " KB";
            }
            elseif(strlen($size) == 1){
                return substr($ukuran_file,0,1). " KB";
            }
        }
        elseif($size > 999999){
            $ukuran_file = $size / 1048576;
            if(strlen($size) == 7){
                return substr($ukuran_file,0,4). " MB";
            }
            elseif(strlen($size) == 8){
                return substr($ukuran_file,0,4). " MB";
            }
        }
    }

    public function post($p, $is_special = FALSE){
        if(!$is_special){
            $post =  htmlspecialchars($_POST[$p]);
        }else{
            $post =  isset($_POST[$p]);
        }
        return $post;
    }

    public function get($g, $is_special = FALSE){
        if(!$is_special){
            $get =  htmlspecialchars($_GET[$g]);
        }else{
            $get =  isset($_GET[$g]);
        }
        return $get;
    }

    public function alert($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public function showAlertHtml($name)
    {   
        if(isset($_SESSION[$name])){
            if($name == "success"){
                echo '<div class="alert alert-success">'.$_SESSION[$name].'</div>';
            }
            elseif($name == "warning"){
                echo'<div class="alert alert-warning">'.$_SESSION[$name].'</div>';
            }
            elseif($name == "danger"){
                echo'<div class="alert alert-danger">'.$_SESSION[$name].'</div>';
            }
        }
        unset($_SESSION[$name]);
    }

    public function today()
    {
        return date('Y-m-d H:i:s');
    }

    public function showAlert(){
        if($this->showAlertHtml("success") !== "") {
            echo $this->showAlertHtml("success");
        }
        if($this->showAlertHtml("warning") !== ""){
            echo $this->showAlertHtml("warning");
        }
        if($this->showAlertHtml("danger") !== ""){
            echo $this->showAlertHtml("danger");
        }
    }

    public function upload_file_allowed()
	{
		return array('xlsx','xls');
    }
    
    public function upload_img_allowed()
    {
        return array('jpg','jpeg','png');
    }

    public function ext($ext)
	{
		$ekstension = explode('.',$ext);
		$x = strtolower(end($ekstension));
		return $x;
	}

	public function filesRequired($ext, $max_size, $val)
	{	
        switch($val){
            case 'FILES':
            $required = $this->upload_file_allowed();
            break;

            case 'IMG':
            $required = $this->upload_img_allowed();
            break;
        }
		if(in_array($this->ext($ext), $required) == true){
			if($max_size <= 10480000 || $max_size == ""){
				return 1;
			}else{
				return 2;
			}
		}else{
			return 3;
		}
    }

    public function imagerequire($ext, $max_size)
	{	
		if(in_array($this->ext($ext), $this->base_image()) == true){
			if($max_size <= 1024 || $max_size == ""){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

    public function historyBack()
    {
        echo '<script> history.back(); </script>';
    }

    public function redirect($path)
    {
        header("location:$path");
    }

    public function parsingTime($type, $times)
    {
        if($type = "d F Y"){
            $date = date('d F Y', strtotime($times));
        }
        if($type = "d M Y"){
            $date = date('d M Y', strtotime($times));
        }
    }

}

?>
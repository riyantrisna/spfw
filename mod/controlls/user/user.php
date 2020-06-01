<?php
class user extends Cores{

	public function __construct()
    {   
    	$this->ObjUser = $this->models('user/user_model');
    }

    public function index(){

    	$data = $this->ObjUser->getUser();
    	$this->views('user/user_list', $data);
    
    }

    public function detail($id,$name){

    	$data = array($id,$name);
    	$this->views('user/user_list', $data);
    
    }

}

?>
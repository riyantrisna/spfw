<?php
class user_model extends Database{

	public function __construct($conection_number = 0)
    {   
    	parent::__construct($conection_number);
    }

	public function getUser()
	{
		$data = array('riyan','trisna','wibowo');

		return $data;
	}

}
?>
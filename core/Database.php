<?php

class Database
{	

	public function __construct($conection_number = 0)
    {   
    	include('./config/application_conf.php');

    	$this->host = $application['db_connect'][$conection_number]['db_host'];
		$this->username = $application['db_connect'][$conection_number]['db_username'];
		$this->password = $application['db_connect'][$conection_number]['db_password'];
		$this->db_name = $application['db_connect'][$conection_number]['db_name'];
		$this->db_port = $application['db_connect'][$conection_number]['db_port'];

        $this->conn = $this->connect_db();
    }

	public function connect_db()
	{
		$connect = @mysqli_connect($this->host,$this->username,$this->password,$this->db_name,$this->db_port);	
		if(mysqli_connect_errno())
		{
			echo "Failed to connect to Server and MySQL: " . mysqli_connect_error();
			die();
		}else{
			return $connect;
		}
	}

	public function startTrans()
	{
		mysqli_autocommit($this->conn,FALSE);
	}

	public function endTrans($condition)
	{
		if($condition == true){
			return mysqli_commit($this->conn);
		}else{
			return mysqli_rollback($this->conn);
		}
	}

	public function getLastId()
	{
		return mysqli_insert_id($this->conn);
	}

	public function closeTrans()
	{
		return mysqli_close($this->conn);
	}

	public function execQuery($query)
	{
		return mysqli_query($this->conn,$query);
	}

	public function openQuery($query)
	{
		$sql = mysqli_query($this->conn,$query);
		while($data= mysqli_fetch_assoc($sql))
		{
			$employee[] = $data;
		}
		if(!empty($employee)){
			return $employee;
		}
		
	}

}
<?php

class Cores
{	

    private $uri = array();
    private $class = array();

	public function getUri($base)
	{
		$uri = $_SERVER['REQUEST_URI'];
		$uri = str_replace($base,'',$uri);
		
		return $uri;
	}

	public function getRouteParametersName($url)
	{
		preg_match_all('/\{(.*?)\}/', $url, $matches);
		return array_map(function ($m) {
			return trim($m, '?');
		}, $matches[1]);
	}

	public function cekRouteParameters($route,$uri)
	{
		$route = explode('/', $route);
		$uri = explode('/', $uri);
		
		$routeNew = '';
		
		if(count($route) == count($uri))
		{
			foreach($route as $key => $value)
			{
				if(!preg_match("#^$value$#", $uri[$key]) AND preg_match('/\{(.*?)\}/', $route[$key]))
				{
					$route[$key] = $uri[$key];
				}
				elseif(!preg_match("#^$value$#", $uri[$key]) AND !preg_match('/\{(.*?)\}/', $route[$key]))
				{
					include('./core/Forbidden.php');
					die();
				}
				
				$routeNew.= $route[$key].'/';
			}
			
			$routeNew = substr($routeNew, 0, -1);
		}
		
		return $routeNew;

	}	

	public function getRouteParameters($route,$uri)
	{
		$route = explode('/', $route);
		$uri = explode('/', $uri);
		
		$routeNew = array();
		
		if(count($route) == count($uri))
		{
			foreach($route as $key => $value)
			{
				if(!preg_match("#^$value$#", $uri[$key]))
				{
					$routeNew[] = $uri[$key];
				}
			}
		}
		
		return $routeNew;

	}	

	public function addRoute($uri,$class = null)
	{
		array_push($this->uri, $uri);

		if($class != null)
		{
			array_push($this->class, $class);
		}
		
	}

	public function runRoute($base)
	{

		$result = true;

		$uriParams = '/'.$this->getUri($base);		

		foreach ($this->uri as $key => $value) 
		{
			$parametersName = $this->getRouteParametersName($value);
			if(!empty($parametersName))
			{
				$parameters = $this->getRouteParameters($value,$uriParams);
				$value = $this->cekRouteParameters($value,$uriParams);
			}
			else
			{
				$parameters = '';
			}

			if(preg_match("#^$value$#", $uriParams))
			{
					
				$method = explode('@', $this->class[$key]);
				require_once('./mod/controlls/'.$method[0].'.php');
				
				$class = explode('/', $method[0]);
				$method = end($method);
				
				if(!empty($method) AND preg_match('/@/', $this->class[$key]))
				{
					$class = end($class);
					$class = new $class();
					if(method_exists($class,$method))
					{
						if(!empty($parameters))
						{
							call_user_func_array(array($class,$method),$parameters);
						}
						else
						{
							$class->$method();
						}
					}
					else
					{
						include('./core/Forbidden.php');
						die();
					}
				}
				else
				{
					$class = end($class);
					$class = new $class();
					$class->index();
				}

				die();
			}
			else
			{
				$result = $result && false;
			}

		}

		if(!$result){
			include('./core/Forbidden.php');
		}
	}

	public function models($module, $connection = 0)
	{
		require_once("./mod/models/".$module.".php");

		$class = explode('/', $module);
		$class = end($class);
		$class = new $class($connection);

		return $class;
	}

	public function views($views,$data)
	{
		if(file_exists('./mod/views/'.$views.'.php')){
			return include("./mod/views/".$views.".php");
		}else{
			return 'view not found!';
		}
	}

}

$Cores = new Cores();
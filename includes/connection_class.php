<?php
	class config
	{
		public $hostname;
		public $username;
		public $password;
		public $database;
		public $prefix;
		public $connector;
		
		function __construct($hostname = NULL, $username = NULL, $password = NULL, 
		$database = NULL, $prefix = NULL, $connector = NULL)
		{
			$this->hostname = !empty($hostname) ? $hostname : "";
			$this->username = !empty($username) ? $username : "";
			$this->password = !empty($password) ? $password : "";
			$this->database = !empty($database) ? $database : "";
			$this->prefix = !empty($prefix) ? $prefix : "";
			$this->connector = !empty($connector) ? $connector : "";
		}	
		function __destruct()
		{
			
		}
	}
	class ConnectionDB
	{
		
		private $connection;
		private $selectdb;
		private $lastQuery;
		private $config;

		function __construct($config)
		{
			$this->config = $config;
		}
	
		function __destruct()
		{
			
		}
		////////////////////////////////////////////////////////////
				/* Open Connection*/
		////////////////////////////////////////////////////////////
		public function openConnection()
		{
			try
			{
				if($this->config->connector == "mysql")
				{
					$this->connection = @mysql_connect($this->config->hostname, 
					$this->config->username, $this->config->password);
					
					$this->selectdb = @mysql_select_db($this->config->database,$this->connection);
					if(!$this->selectdb)
					{
						$this->errorConnection('Selected Database attemted Failed');
					}
							
				}
				
				elseif($this->config->connector == "mysqli")
				{
					$this->connection = @mysqli_connect($this->config->hostname, 
					$this->config->username, $this->config->password);
										
					$this->selectdb = @mysqli_select_db($this->connection, $this->config->database);
					if(!$this->selectdb)
					{
						$this->errorConnection('Selected Database attemted Failed');
					}
					
				}
			}
			catch(exception $e)
			{
				return $e;
			}
		}
		
		////////////////////////////////////////////////////////////
				/* Close connection*/
		////////////////////////////////////////////////////////////

		public function closeConnection()
		{
			try
			{
				if($this->config->connector == "mysql")
				{
					@mysql_close($this->connection);
				}
				elseif($this->config->connector == "mysqli")
				{
					@mysqli_close($this->connection);
				}
			}
			catch(exception $e)
			{
				return $e;
			}
		}
		
		////////////////////////////////////////////////////////////
				/* Ping Server*/
		////////////////////////////////////////////////////////////

		public function pingServer()
		{
			try
			{
				if($this->config->connector == "mysql")
				{
					if(!mysql_ping($this->connection))
					{
						$this->errorConnection('Connection attemted Failured');
						return false;
					}
					else
					{
						return true;
					}
				}
				elseif($this->config->connector == "mysqli")
				{
					if(!mysqli_ping($this->connection))
					{
						$this->errorConnection('Connection attemted Failured');
						return false;
					}
					else
					{
						return true;
					}
				}
			}
			catch(exception $e)
			{
				return $e;
			}
		}
		////////////////////////////////////////////////////////////
				/* Error Text */
		////////////////////////////////////////////////////////////
		public function errorConnection($text)
		{
			try
			{
				if($this->config->connector == "mysql")
				{
                    $no = @mysql_errno();
                    $msg = @mysql_error();

                    $html = "";
                    $html .= "<html>";
                    $html .= "<head><title>Error Generate</title></head>";
                    $html .= "<body style='background:#22a7f0;'>";
                    $html .= "<hr>";
                    $html .= "<p style='font-family:Verdana, Geneva, sans-serif; font-size:16px; color:#000; '>";
                    $html .= "<b>Custom Message :</b> $text<br><br>";
                    $html .= "<b>Error Number :</b> $no<br><br>";
                    $html .= "<b>Error Message	:</b> $msg<br><br>";
                    $html .= "</p>";
                    $html .= "<hr>";
                    $html .= "</body>";
                    $html .= "</html>";
                    echo $html;

                    $this->closeConnection();
                    exit;
				}
				
				elseif($this->config->connector == "mysqli")
				{
					$no = @mysqli_errno();
					$msg = @mysqli_error();

                    $html = "";
                    $html .= "<html>";
                    $html .= "<head><title>Error Generate</title></head>";
                    $html .= "<body style='background:#22a7f0;'>";
                    $html .= "<hr>";
                    $html .= "<p style='font-family:Verdana, Geneva, sans-serif; font-size:16px; color:#000; '>";
                    $html .= "<b>Custom Message :</b> $text<br><br>";
                    $html .= "<b>Error Number :</b> $no<br><br>";
                    $html .= "<b>Error Message	:</b> $msg<br><br>";
                    $html .= "</p>";
                    $html .= "<hr>";
                    $html .= "</body>";
                    $html .= "</html>";
                    echo $html;
						
					$this->closeConnection();	
					exit;
				}
			}
			catch(exception $e)
			{
				return $e;
			}
		}
			
		////////////////////////////////////////////////////////////
				/* SELECT Query */
		////////////////////////////////////////////////////////////	
		public function select($query)
		{
			if(!empty($query))
			{
				$query = $query;
				try
				{
					if(empty($this->connection))
					{
						$this->openConnection();
						
						if($this->config->connector == "mysql")
						{
							$result = @mysql_query($query,$this->connection);
							$count =0;
							$data = array();
							if(!empty($result) || ($result != 0))
							{
								while($row = @mysql_fetch_array($result))
								{
									$data[$count] = $row;
									$count++;
								}
								@mysql_free_result($result);
								return $data;
							}
							else
							{
								$this->errorConnection("Please check Selection Option..Sorry");
								return false;
							}
						}
						elseif($this->config->connector == "mysqli")
						{
							$result = @mysqli_query($this->connection, $query);
							$count =0;
							$data = array();
							if(!empty($result) || ($result != 0))
							{
								while($row = @mysqli_fetch_array($result))
								{
									$data[$count] = $row;
									$count++;
								}
								@mysqli_free_result($result);
								return $data;
							}
							else
							{
								$this->errorConnection("Please check Selection Option..Sorry");
								return false;
							}
						}
					}
					else
					{
						if($this->config->connector == "mysql")
						{
							$result = @mysql_query($query,$this->connection);
							$count =0;
							$data = array();
							if(!empty($result) || ($result != 0))
							{
								while($row = @mysql_fetch_array($result))
								{
									$data[$count] = $row;
									$count++;
								}
								@mysql_free_result($result);
								return $data;
							}
							else
							{
								$this->errorConnection("Please check Selection Option..Sorry");
								return false;
							}
						}
						elseif($this->config->connector == "mysqli")
						{
							$result = @mysqli_query($this->connection, $query);
							$count =0;
							$data = array();
							if(!empty($result) || ($result != 0))
							{
								while($row = @mysqli_fetch_array($result))
								{
									$data[$count] = $row;
									$count++;
								}
								@mysqli_free_result($result);
								return $data;
							}
							else
							{
								$this->errorConnection("Please check Selection Option..Sorry");
								return false;
							}
						}
					}
				}
				catch(exception $e)
				{
					return $e;
				}	
			}
			else
			{
				return false;
			}
		}
		
		////////////////////////////////////////////////////////////
				/* Insert Database */
		////////////////////////////////////////////////////////////
		public function insert($query='')
		{
			if(empty($query)) { return false; }
			try
			{
				if(empty($this->connection))
				{
					$this->openConnection();
					
					if($this->config->connector == "mysql")
					{
						$result = @mysql_query($query,$this->connection);
						if(!$result)
						{
							$this->errorConnection("Insert Operation are Failed..Sorry");
							return false;
						}
						else
						{
							$id  = @mysql_insert_id($this->connection);
							return $id;
						}
					}
					elseif($this->config->connector == "mysqli")
					{
						$result = @mysqli_query($this->connection, $query);
						if(!$result)
						{
							$this->errorConnection("Insert Operation are Failed..Sorry");
							return false;
						}
						else
						{
							$id  = @mysqli_insert_id($this->connection);
							return $id;
						}
					}
				}
				else
				{
					if($this->config->connector == "mysql")
					{
						$result = @mysql_query($query,$this->connection);
						if(!$result)
						{
							$this->errorConnection("Insert Operation are Failed..Sorry");
							return false;
						}
						else
						{
							$id  = @mysql_insert_id($this->connection);
							return $id;
						}
					}
					elseif($this->config->connector == "mysqli")
					{
						$result = @mysqli_query($this->connection, $query);
						if(!$result)
						{
							$this->errorConnection("Insert Operation are Failed..Sorry");
							return false;
						}
						else
						{
							$id  = @mysqli_insert_id($this->connection);
							return $id;
						}
					}
				}
			}
			catch(exception $e)
			{
				return $e;
			}	
		}
		
		////////////////////////////////////////////////////////////
				/* Edit Operation */
		////////////////////////////////////////////////////////////
		public function edit($query='')
		{
			if(empty($query)) { return false; }
			try
			{
				if(empty($this->connection))
				{
					$this->openConnection();
					
					if($this->config->connector == "mysql")
					{
						$result = @mysql_query($query,$this->connection);
						if(!$result)
						{
							$this->errorConnection("Edit Operation are Failed..Sorry");
							return false;
						}
						else
						{
							$id  = @mysql_affected_rows($this->connection);
							return $id;
						}
					}
					elseif($this->config->connector == "mysqli")
					{
						$result = @mysqli_query($this->connection, $query);
						if(!$result)
						{
							$this->errorConnection("Edit Operation are Failed..Sorry");
							return false;
						}
						else
						{
							$id  = @mysqli_affected_rows($this->connection);
							return $id;
						}
					}
				}
				else
				{
					if($this->config->connector == "mysql")
					{
						$result = @mysql_query($query,$this->connection);
						if(!$result)
						{
							$this->errorConnection("Edit Operation are Failed..Sorry");
							return false;
						}
						else
						{
							$id  = @mysql_affected_rows($this->connection);
							return $id;
						}
					}
					elseif($this->config->connector == "mysqli")
					{
						$result = @mysqli_query($this->connection, $query);
						if(!$result)
						{
							$this->errorConnection("Edit Operation are Failed..Sorry");
							return false;
						}
						else
						{
							$id  = @mysqli_affected_rows($this->connection);
							return $id;
						}
					}
				}
			}
			catch(exception $e)
			{
				return $e;
			}	
		}
		
		////////////////////////////////////////////////////////////
				/* Delete Operation */
		////////////////////////////////////////////////////////////
		public function delete($query='')
		{
			if(empty($query)) { return false; }
			try
			{
				if(empty($this->connection))
				{
					$this->openConnection();
					
					if($this->config->connector == "mysql")
					{
						$result = @mysql_query($query,$this->connection);
						if(!$result)
						{
							$this->errorConnection("Delete Operation are Failed..Sorry");
							return false;
						}
						else
						{
							return $result;
						}
					}
					elseif($this->config->connector == "mysqli")
					{
						$result = @mysqli_query($this->connection, $query);
						if(!$result)
						{
							$this->errorConnection("Delete Operation are Failed..Sorry");
							return false;
						}
						else
						{
							return $result;
						}
					}
				}
				else
				{
					if($this->config->connector == "mysql")
					{
						$result = @mysql_query($query,$this->connection);
						if(!$result)
						{
							$this->errorConnection("Delete Operation are Failed..Sorry");
							return false;
						}
						else
						{
							return $result;
						}
					}
					elseif($this->config->connector == "mysqli")
					{
						$result = @mysqli_query($this->connection, $query);
						if(!$result)
						{
							$this->errorConnection("Delete Operation are Failed..Sorry");
							return false;
						}
						else
						{
							return $result;
						}
					}
				}
			}
			catch(exception $e)
			{
				return $e;
			}	
		}
		
		
		////////////////////////////////////////////////////////////
				/* ANY SINGLE SELECT Query */
		////////////////////////////////////////////////////////////	
		public function single($table,$field,$search)
		{
			$query  = "SELECT ".$field." FROM ".$table." WHERE ".$search."  LIMIT 1";
			if(!empty($query))
			{
				$query = $query;
				try
				{
					if(empty($this->connection))
					{
						$this->openConnection();
						
						if($this->config->connector == "mysql")
						{
							$result = @mysql_query($query,$this->connection);
							$count =0;
							$data = array();
							if(!empty($result) || ($result != 0))
							{
								while($row = @mysql_fetch_array($result))
								{
									$data[$count] = $row;
									$count++;
								}
								@mysql_free_result($result);
								return $data;
							}
							else
							{
								//$this->errorConnection("Please check Selection Option..Sorry");
								return 0;
							}
						}
						elseif($this->config->connector == "mysqli")
						{
							$result = @mysqli_query($this->connection, $query);
							$count =0;
							$data = array();
							if(!empty($result) || ($result != 0))
							{
								while($row = @mysqli_fetch_array($result))
								{
									$data[$count] = $row;
									$count++;
								}
								@mysqli_free_result($result);
								return $data;
							}
							else
							{
								//$this->errorConnection("Please check Selection Option..Sorry");
								return 0;
							}
						}
					}
					else
					{
						if($this->config->connector == "mysql")
						{
							$result = @mysql_query($query,$this->connection);
							$count =0;
							$data = array();
							if(!empty($result) || ($result != 0))
							{
								while($row = @mysql_fetch_array($result))
								{
									$data[$count] = $row;
									$count++;
								}
								@mysql_free_result($result);
								return $data;
							}
							else
							{
								//$this->errorConnection("Please check Selection Option..Sorry");
								return 0;
							}
						}
						elseif($this->config->connector == "mysqli")
						{
							$result = @mysqli_query($this->connection, $query);
							$count =0;
							$data = array();
							if(!empty($result) || ($result != 0))
							{
								while($row = @mysqli_fetch_array($result))
								{
									$data[$count] = $row;
									$count++;
								}
								@mysqli_free_result($result);
								return $data;
							}
							else
							{
								//$this->errorConnection("Please check Selection Option..Sorry");
								return 0;
							}
						}
					}
				}
				catch(exception $e)
				{
					return $e;
				}	
			}
			else
			{
				return false;
			}
		}
	
	}
?>
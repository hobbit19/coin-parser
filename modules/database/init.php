<?php
class Database
{
    public function __construct()
    {
      $this->Connect();
    }
   
	public static function Connect()
    {
        $confPath = 'db_conf.php';
        $conf=include($confPath);
        $dsn = "mysql:host={$conf['host']};dbname={$conf['dbName']}";
        $db = new PDO($dsn, $conf['user'], $conf['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
    return $db;
    }
	
	
	
	public function SaveToBase($line)
	{
		$db = Database::Connect();
		 $sql = 'INSERT INTO result (success)'
                .' VALUES (:entries)';
		$db->query("SET NAMES 'UTF8'");
		$result = $db->prepare($sql);
		$result->bindParam(':entries', $line, PDO::PARAM_INT);
		$result->execute();
	}

	public function ShowFromDb()
	{
		$db = Database::Connect();
		$outputs = [];
	
		$sql = "SELECT * FROM result";
		$db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		for($i=0; $row = $result->fetch(); $i++)
			{	
				$outputs[$i] = $row['success'];
			
			}
		return $outputs;
	}
	
}
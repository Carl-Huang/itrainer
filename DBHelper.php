<?php
/**
 *数据库连接类
 */
class DBHelper
{
	public static function connect()
	{
		include_once('config.php');

		//构建dsn
		$dsn = "{$db_config['type']}:host={$db_config['host']};dbname={$db_config['dbname']}";
	
		$pdo = null;	//用于存放数据库连接句柄
	
		try
		{	
			//使用pdo连接数据库
			$opt = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL);
			$pdo = new PDO($dsn,$db_config['username'],$db_config['password'],$opt);
		
		}
		catch(PDOException $e)
		{
			exit('error:'.$e->getMessage()."<br/>");
		}
		
		return $pdo;
	}
	
	
	
	
	
}

//DBHelper::connect();

?>
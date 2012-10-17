<?php
/**
 *���ݿ�������
 */
class DBHelper
{
	public static function connect()
	{
		include_once('config.php');

		//����dsn
		$dsn = "{$db_config['type']}:host={$db_config['host']};dbname={$db_config['dbname']}";
	
		$pdo = null;	//���ڴ�����ݿ����Ӿ��
	
		try
		{	
			//ʹ��pdo�������ݿ�
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
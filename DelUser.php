<?php
/**
 *删除用户信息接口
 */
class DelUser
{
	private $uid;
	public function __construct($uid)
	{
		if(empty($uid))
		{
			echo 0;
			exit;
		}
		
		$this->uid = $uid;
	}
	
	
	
	//构造删除用户信息SQL
	private function delUserInfoSQL()
	{
		return "delete from user where uid=".$this->uid;
	}
	//构造删除用户球包SQL
	private function delUserSetsSQL()
	{
		return "delete from sets where uid=".$this->uid;
	}
	//构造删除用户球杆信息SQL
	private function delUserClubsSQL()
	{
		return "delete from clubs where sid in (select sid from sets where uid=".$this->uid.")";
	}
	//构造删除用户历史记录SQL
	private function delUserSwingHistorySQL()
	{
		return "delete from swing where cid in (select cid from clubs where sid in (select sid from sets where uid=".$this->uid."))";
	}
	
	
	/**
	 *删除用户信息方法
	 *1表示删除成功，0表示失败
	 */
	public function doDel()
	{
		include 'DBHelper.php';		//包含数据库连接类
		$pdo = DBHelper::connect();	//连接数据库
		$pdo->beginTransaction();	//开启事务处理
		
		
		try
		{
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$pdo->exec($this->delUserSwingHistorySQL());
			$pdo->exec($this->delUserClubsSQL());
			$pdo->exec($this->delUserSetsSQL());
			$pdo->exec($this->delUserInfoSQL());
			
			$pdo->commit();
			
			echo 1;		//操作成功
		}
		catch(PDOException $e)
		{
			$pdo->rollback();
			echo 0;		//操作失败
			exit;
		}
		
		
		
	}
	
	
	
	
}

$del = new DelUser($_POST['uid']);
$del->doDel();

?>
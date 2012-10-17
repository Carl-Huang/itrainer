<?php
/**
 *更新用户信息接口
 */

class SetUserInfo
{
	private $userInfo;
	public function __construct($userInfo)
	{
		$this->userInfo = $userInfo;
	}
	
	
	//构造更新用户信息的SQL语句
	private function constructSQL()
	{
		//先判断是否存在uid
		if(empty($this->userInfo['uid']))
		{
			//更新失败输出0
			echo 0;
			exit;
		}
		
		
		return "update user set age=".$this->userInfo['age'].",gender=".$this->userInfo['gender'].
				",height=".$this->userInfo['height'].",weight=".$this->userInfo['weight'].",dominanthand=".$this->userInfo['dominanthand'].
				",unit=".$this->userInfo['unit'].",lasttime=now() where uid=".$this->userInfo['uid'];
		
	}
	
	/**
	 *更新用户信息方法
	 *1表示更新成功，0表示失败
	 */
	public function doSet()
	{
		include 'DBHelper.php';		//包含数据库连接类
		$pdo = DBHelper::connect();
		//echo $this->constructSQL();
		if($pdo->exec($this->constructSQL()) >= 0)
		{
			//更新成功，输出1
			echo 1;
			exit;
		}
		else
		{
			//更新失败，输出0
			echo 0;
			exit;
		}		
	
	}
	
	

}


//$_POST = array('uid'=>4,'age'=>23,'gender'=>1,'height'=>123,'weight'=>231,'dominanthand'=>1,'unit'=>1);
$set = new SetUserInfo($_POST);
$set->doSet();


?>
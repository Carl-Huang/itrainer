<?php
/**
 *�����û���Ϣ�ӿ�
 */

class SetUserInfo
{
	private $userInfo;
	public function __construct($userInfo)
	{
		$this->userInfo = $userInfo;
	}
	
	
	//��������û���Ϣ��SQL���
	private function constructSQL()
	{
		//���ж��Ƿ����uid
		if(empty($this->userInfo['uid']))
		{
			//����ʧ�����0
			echo 0;
			exit;
		}
		
		
		return "update user set age=".$this->userInfo['age'].",gender=".$this->userInfo['gender'].
				",height=".$this->userInfo['height'].",weight=".$this->userInfo['weight'].",dominanthand=".$this->userInfo['dominanthand'].
				",unit=".$this->userInfo['unit'].",lasttime=now() where uid=".$this->userInfo['uid'];
		
	}
	
	/**
	 *�����û���Ϣ����
	 *1��ʾ���³ɹ���0��ʾʧ��
	 */
	public function doSet()
	{
		include 'DBHelper.php';		//�������ݿ�������
		$pdo = DBHelper::connect();
		//echo $this->constructSQL();
		if($pdo->exec($this->constructSQL()) >= 0)
		{
			//���³ɹ������1
			echo 1;
			exit;
		}
		else
		{
			//����ʧ�ܣ����0
			echo 0;
			exit;
		}		
	
	}
	
	

}


//$_POST = array('uid'=>4,'age'=>23,'gender'=>1,'height'=>123,'weight'=>231,'dominanthand'=>1,'unit'=>1);
$set = new SetUserInfo($_POST);
$set->doSet();


?>
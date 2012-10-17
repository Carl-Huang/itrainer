<?php
/**
 *ɾ���û���Ϣ�ӿ�
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
	
	
	
	//����ɾ���û���ϢSQL
	private function delUserInfoSQL()
	{
		return "delete from user where uid=".$this->uid;
	}
	//����ɾ���û����SQL
	private function delUserSetsSQL()
	{
		return "delete from sets where uid=".$this->uid;
	}
	//����ɾ���û������ϢSQL
	private function delUserClubsSQL()
	{
		return "delete from clubs where sid in (select sid from sets where uid=".$this->uid.")";
	}
	//����ɾ���û���ʷ��¼SQL
	private function delUserSwingHistorySQL()
	{
		return "delete from swing where cid in (select cid from clubs where sid in (select sid from sets where uid=".$this->uid."))";
	}
	
	
	/**
	 *ɾ���û���Ϣ����
	 *1��ʾɾ���ɹ���0��ʾʧ��
	 */
	public function doDel()
	{
		include 'DBHelper.php';		//�������ݿ�������
		$pdo = DBHelper::connect();	//�������ݿ�
		$pdo->beginTransaction();	//����������
		
		
		try
		{
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$pdo->exec($this->delUserSwingHistorySQL());
			$pdo->exec($this->delUserClubsSQL());
			$pdo->exec($this->delUserSetsSQL());
			$pdo->exec($this->delUserInfoSQL());
			
			$pdo->commit();
			
			echo 1;		//�����ɹ�
		}
		catch(PDOException $e)
		{
			$pdo->rollback();
			echo 0;		//����ʧ��
			exit;
		}
		
		
		
	}
	
	
	
	
}

$del = new DelUser($_POST['uid']);
$del->doDel();

?>
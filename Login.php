<?php
/**
 *�û���¼�ӿ�
 */
class Login
{

	private $email = null;
	private $password = null;
	
	
	public function __construct($email="",$password="")
	{
		$this->email = $email;
		$this->password = $password;
	}
	
	
	
	private function constructSQL($fields="*")
	{
		return "select ".$fields." from user where email='".$this->email."' and password='".md5($this->password)."'";
	}
	
	public function doLogin()
	{
		include 'DBHelper.php';		//�������ݿ�������
		$pdo = DBHelper::connect();
		//echo $this->constructSQL();
		if($rs = $pdo->query($this->constructSQL('uid,username,email')))
		{
			if($rs->rowCount() >= 1)	//��½�ɹ�������uid
			{
				$rs->setFetchMode(PDO::FETCH_ASSOC);
				$userInfo = $rs->fetch();
				echo($userInfo['uid']);
				exit;
			}
			else
			{
				echo 0;	//��½ʧ�ܣ�������������
				exit;	
			}
		}
		else
		{
			echo 0;
			exit;
		}
		
	}
	
	

}

//$_POST['email'] = '787887347@qq.com';
//$_POST['password'] = '123456';
$login = new Login($_POST['email'],$_POST['password']);
$login->doLogin();

?>
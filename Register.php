<?php
/**
 *�û�ע��ӿ�
 */
class Register{

	private $email;			//ע������
	private $password;		//ע������
	
	public function __construct($email="",$password="")
	{
		$this->email = $email;
		$this->password = $password;
	}


	//�����û�ע���SQL���
	private function constructSQL()
	{
		return "insert into user(uid,username,email,password,age,gender,height,weight,unit,dominanthand,lasttime)".
				" values(null,'','".$this->email."','".md5($this->password)."',null,null,null,null,null,null,now());";
	}
	
	//�������û�����SQL
	private function checkEmailExistSQL()
	{
		return "select uid from user where email='".$this->email."'";
	}
	
	/**
	 *ע�᷽��
	 *return uid,0,-1
	 *0��ʾע��ʧ��,-1��ʾ�û����䱻ע��
	 */
	public function doRegister()
	{
		include 'DBHelper.php';		//�������ݿ�������
		$pdo = DBHelper::connect();
		//echo $this->constructSQL();
		//ע��֮ǰ���ж��û������Ƿ�ע���
		if($rs = $pdo->query($this->checkEmailExistSQL()))
		{
			if($rs->rowCount() >= 1)
			{
				//�û����䱻ע��������-1
				echo -1;
				exit;
			}
		}
		else
		{
			echo 0;
			exit;
		}
		
		
		
		//�ж�ע���Ƿ�ɹ�
		if($pdo->exec($this->constructSQL()) > 0)
		{
			echo $pdo->lastInsertId();	//ע��ɹ������uid
			exit;
		}
		else
		{
			//ע��ʧ�ܣ����0
			echo '0';
			exit;
		}
		
		
		
	}
	

}

//$_POST['email'] = '787887347@qq.com';
//$_POST['password'] = '123456';

$re = new Register($_POST['email'],$_POST['password']);
$re->doRegister();


?>
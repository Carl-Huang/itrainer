<?php
/**
 *用户注册接口
 */
class Register{

	private $email;			//注册邮箱
	private $password;		//注册密码
	
	public function __construct($email="",$password="")
	{
		$this->email = $email;
		$this->password = $password;
	}


	//构造用户注册的SQL语句
	private function constructSQL()
	{
		return "insert into user(uid,username,email,password,age,gender,height,weight,unit,dominanthand,lasttime)".
				" values(null,'','".$this->email."','".md5($this->password)."',null,null,null,null,null,null,now());";
	}
	
	//构造检查用户邮箱SQL
	private function checkEmailExistSQL()
	{
		return "select uid from user where email='".$this->email."'";
	}
	
	/**
	 *注册方法
	 *return uid,0,-1
	 *0表示注册失败,-1表示用户邮箱被注册
	 */
	public function doRegister()
	{
		include 'DBHelper.php';		//包含数据库连接类
		$pdo = DBHelper::connect();
		//echo $this->constructSQL();
		//注册之前先判断用户邮箱是否被注册过
		if($rs = $pdo->query($this->checkEmailExistSQL()))
		{
			if($rs->rowCount() >= 1)
			{
				//用户邮箱被注册过，输出-1
				echo -1;
				exit;
			}
		}
		else
		{
			echo 0;
			exit;
		}
		
		
		
		//判断注册是否成功
		if($pdo->exec($this->constructSQL()) > 0)
		{
			echo $pdo->lastInsertId();	//注册成功，输出uid
			exit;
		}
		else
		{
			//注册失败，输出0
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
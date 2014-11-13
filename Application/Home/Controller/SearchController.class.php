<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {
    public function index(){
    	$this->display();
    }

    public function testdb(){
    	error_reporting(E_ALL ^ E_DEPRECATED);

		$db_host = "localhost"; //连接服务器地址
		$db_user = "root";      //连接数据库的用户名
		$db_psw = "wubin";       //连接数据库的密码
  		$db_name = "pytest";	//连接的数据库表名称
		$con = mysql_connect("$db_host","$db_user","$db_psw");
			if (!$con)
				{
					die('Could not connect: ' . mysql_error());
				}
			else echo "数据库连接成功<br> ";
		mysql_select_db($db_name,$con);
			if (mysql_select_db($db_name,$con))
				{ 
					echo "选择数据库成功<br>";
				}
			else  die("数据库选择失败");
		//$query = "SELECT * FROM user";
		$result = mysql_query($query);
			if ($result)
				{
					echo "查询成功!<br>";
				}
			else die("查询失败<br>");
    }

    public function listresult(){
    	//列出查询到的结果，并显示出来，点击可以查看细节
    	$city=M('biosequence');
	    $arr=$city->select();
	    //dump($arr);
		$this->assign('list',$arr);
    	$this->display();
    }

    public function detail (){
    	//调用并执行py脚本，声成结果文件并显示
    	$this->display();
    }
}
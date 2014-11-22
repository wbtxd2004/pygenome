<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
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
    	//$Seq=M('biosequence');
    	//$Seqdb=M('biosequence');
    	$Entry=M('bioentry');
    	$sequence=I('post.sequence','');
    	if ($sequence != '') {
    		# code...
    		//echo $sequence;
	    	$map['biosequence.seq']=array('like',"%$sequence%");
	    	$list=$Entry->join('biosequence ON bioentry.bioentry_id = biosequence.bioentry_id' )->where($map)->select();
	    	//dump($list);
	    	//$list=$Entry->where($map)->select();
	    	//dump($seq);

		    //$arr=$Entry->select();
		    //dump($arr);
		    //dump($arr);
			$this->assign('list',$list);
	    	$this->display();
    	}
    	else{
    		#$this->display('error');
    		$this->success('操作失败,请输入序列内容','index',3);
    	}
    }

    public function temp (){
    	error_reporting(E_ALL ^ E_DEPRECATED);

		$db_host = "localhost"; //连接服务器地址
		$db_user = "root";      //连接数据库的用户名
		$db_psw = "wubin";       //连接数据库的密码
  		$db_name = "pytest";	//连接的数据库表名称
		$con = mysql_connect("$db_host","$db_user","$db_psw");
		mysql_select_db($db_name,$con);
		$seq=$_POST['sequence'];
		echo "您输入的序列为:"."<br/>";//.$seq."<br/>";
		//echo "<table><tr><td width='200'><nobr style='width:200px;'>$seq</nobr></td></tr></table>";
		print $seq;
		echo "<br/>";
		$query_biosequence="SELECT * FROM biosequence WHERE seq LIKE '%$seq%'";
		$result_biosequence = mysql_query($query_biosequence);
		$row = mysql_fetch_array($result_biosequence);
		//while ($row = mysql_fetch_array($result_biosequence)){
			//dump($row);
			//echo "The alphabet is:";
			//echo $row['alphabet']."<br>";
			//echo $row['bioentry_id']."<br>";
			//$id=$row['bioentry_id'];
			//echo $id;
		//}
		$this->assign('list',$row);
    	$this->display();
    }

    public function detail ($name="0"){
    	//调用并执行py脚本，声成结果文件并显示
       	//$this->assign('id',$id);
       	//echo exec("whoami")."<br>";
		//echo system("python -V 2>&1")."<br>";
		$date=date("Y-m-d-H-i-m");
		$target=$name;
		//$publicpath="/Users/wubin/Sites/pygenome/Public";
		$filepath="Public/Uploads/tmp/";
		//$execpath=$publicpath."/Public/exec/test.py";
		//echo $date."<br/>";
		//echo $target."<br/>";
		//echo $filepath."<br/>";
		//echo $execpath."<br/>";
       	exec ("/opt/local/bin/python Public/exec/db_to_gb_sys.py $date $filepath $target");
       	$resultpath=$filepath.$date.".gb";
       	//$result=readfile($resultpath);
       	session('result',$resultpath);
       	$this->display();
    }

    public function downfile (){
    	$url=session('result');
 		//echo $url;
 		download($url);

 	}

 	public function error (){
 		$this->display();
 	}
    
}
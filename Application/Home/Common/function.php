<?php 
/*
//echo $testname;
function downfile()
{
 $filename=realpath("Uploads/test.gb"); //文件名
 $date=date("Ymd-H:i:m");
 Header( "Content-type:  application/octet-stream "); 
 Header( "Accept-Ranges:  bytes "); 
Header( "Accept-Length: " .filesize($filename));
 header( "Content-Disposition:  attachment;  filename= {$date}.gb"); 
 //echo file_get_contents($filename);
 readfile($filename); 
}
downfile();
*/

/*
function download($file)
{
 	//ob_start(); 
 	$filename=$file;
 	$date=date("Ymd-H:i:m");
 	header( "Content-type:  application/octet-stream "); 
 	header( "Accept-Ranges:  bytes "); 
 	header( "Content-Disposition:  attachment;  filename= {$date}.gb"); 
 	readfile($filename); 
}
*/
/*
 * 下载文件
 * @param string $file
 *               被下载文件的路径
 * @param string $name
 *               用户看到的文件名
 */
function download($file,$name=''){
    $fileName = $name ? $name : date("Ymd-H:i:m");
    $filePath = realpath($file);
    
    $fp = fopen($filePath,'rb');
    
    if(!$filePath || !$fp){
        header('HTTP/1.1 404 Not Found');
        echo "Error: 404 Not Found.(server file path error)<!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding -->";
        exit;
    }
    
    $fileName = $fileName .'.'. pathinfo($filePath,PATHINFO_EXTENSION);
    $encoded_filename = urlencode($fileName);
    $encoded_filename = str_replace("+", "%20", $encoded_filename);
    
    header('HTTP/1.1 200 OK');
    header( "Pragma: public" );
    header( "Expires: 0" );
    header("Content-type: application/octet-stream");
    header("Content-Length: ".filesize($filePath));
    header("Accept-Ranges: bytes");
    header("Accept-Length: ".filesize($filePath));
    
    $ua = $_SERVER["HTTP_USER_AGENT"];
    if (preg_match("/MSIE/", $ua)) {
        header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
    } else if (preg_match("/Firefox/", $ua)) {
        header('Content-Disposition: attachment; filename*="utf8\'\'' . $fileName . '"');
    } else {
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
    }
    
    // ob_end_clean(); <--有些情况可能需要调用此函数
    // 输出文件内容
    fpassthru($fp);
    exit;
}

?>

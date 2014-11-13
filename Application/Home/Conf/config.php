<?php
return array(
	//'配置项'=>'配置值'

	'TMPL_PARSE_STRING' => array( //修改自己的目录配置项
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/Images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/Css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/Js',
		'__RESULT__' => __ROOT__ . '/Public/Uploads/Result',
    ),

    //'DEFAULT_MODULE'     => 'Index', //默认模块
    //'URL_MODEL'          => '2', //URL模式
    'SESSION_AUTO_START' => true, //是否开启session

    'SHOW_PAGE_TRACE'=>true,//开启页面Trace
);
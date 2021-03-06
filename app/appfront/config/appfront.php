<?php
# 本文件在app/web/index.php 处引入。
# 
# fecshop - appfront 的核心模块
$modules = [];
foreach (glob(__DIR__ . '/modules/*.php') as $filename){
	$modules = array_merge($modules,require($filename));
}
# 此处也可以重写fecshop的组件。供调用。
return [
	'modules'=>$modules,
	/* only config in front web */
	'bootstrap' => ['store'],
	'params'	=> [
		/* appfront base theme dir   */
		'appfrontBaseTheme' 	=> '@fecshop/app/appfront/theme/base/front',
		'appfrontBaseLayoutName'=> 'main.php',
	],
];

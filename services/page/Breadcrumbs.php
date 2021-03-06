<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecshop\services\page;
use Yii;
use yii\base\InvalidValueException;
use yii\base\InvalidConfigException;
use fec\helpers\CSession;
use fec\helpers\CUrl;
use fecshop\services\ChildService;
/**
 * Breadcrumbs services
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Breadcrumbs extends ChildService
{
	public 		$homeName = 'Home';
	public 		$ifAddHomeUrl = true;
	public 		$intervalSymbol = ' > ';
	protected 	$_items;
	
	/**
	 * property $items|Array. add $items to $this->_items.
	 * $items format example.
	 * $items = ['name'=>'fashion handbag','url'=>'http://www.xxx.com'];
	 */
	public function addItems($items){
		$this->_items[] = $items;
	}
	
	public function init(){
		if($this->homeName){
			$items['name'] = $this->homeName;
			if($this->ifAddHomeUrl)
				$items['url'] = CUrl::getHomeUrl();
			$this->addItems($items);
		}
	}
	
	/**
	 * generate Breadcrumbs html ,before generate , you should use addItems function to add breadcrumbs items.
	 */
	public function generateHtml(){
		$arr = [];
		if($this->_items){
			foreach($this->_items as $item){
				$name = isset($item['name']) ? $item['name'] : '';
				$url = isset($item['url']) ? $item['url'] : '';
				if($name){
					if($url){
						$arr[] = '<a href="'.$url.'">'.$name.'</a>';
					}else{
						$arr[] = '<span>'.$name.'</span>';
					}
				}
			}
		}
		if(!empty($arr))
			return implode($this->intervalSymbol,$arr);
	}
	
	
}
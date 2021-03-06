<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecshop\services\helper;
use Yii;
use yii\base\InvalidValueException;
use yii\base\InvalidConfigException;
use fec\helpers\CSession;
use fec\helpers\CUrl;
use fecshop\services\ChildService;
/**
 * Helper Errors services
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Errors extends ChildService
{
	protected $_errors ;
	public $status = true;
	
	public function add($str){
		if($str){
			$this->_errors[] = $str;
			if($this->status){
				$this->status = false;
			}
		}
	}
	
	public function get(){
		return $this->_errors;
	}
	
	
}
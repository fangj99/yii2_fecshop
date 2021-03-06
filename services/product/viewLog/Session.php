<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecshop\services\product\viewLog;
use Yii;
use yii\base\InvalidConfigException;
use fecshop\services\ChildService;
use fec\helpers\CDate;
use fec\helpers\CSession;
use fec\helpers\CUser;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Session extends ChildService
{
	public $type;
	public $_defaultType = 'session';
	public $_sessionKey = 'services_product_viewlog_history';
	public $_maxProductCount = 10;
	
	
	/**
	 *	get product history log.
	 */
	public function getHistory()
	{
		$history = CSession::get($this->_sessionKey);
		return $history ? $history : '';
	}
	
	/**
	 *	save product  history log.
	 */
	public function setHistory($productOb){
		
		$logArr = [
			'date_time' => CDate::getCurrentDateTime(),
			'product_id'=> $productOb['id'],
			'sku'		=> $productOb['sku'],
			'image'		=> $productOb['image'],
			'name'		=> is_array($productOb['name']) ? serialize($productOb['name']) : $productOb['name'],
		];
		if(isset($productOb['user_id']) && $productOb['user_id']){
			$logArr['user_id'] = $productOb['user_id'];
		}else{
			$logArr['user_id'] = CUser::getCurrentUserId();
		}
		
		
		if(!($session_history = CSession::get($this->_sessionKey))){
			$session_history = [];
		}else if(($count = count($session_history)) >= $this->_maxProductCount){
			$unsetMaxKey = $count - $this->_maxProductCount ;
			for($i=0;$i<=$unsetMaxKey;$i++){
				array_shift($session_history);
			}
		}
		$session_history[] = $logArr;
		CSession::set($this->_sessionKey,$session_history);
	
	}
	
	
	
 
}
<?php

declare(strict_types=1);

namespace Sessionpreinscription\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this
 
 


class PlaningsessionpayementTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'planingsessionpayement';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	public function getpayement($idsession="",$idfacturesess=""){
     	
		/*$selector=$this->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
		
		$selector->setIntegrityCheck(false);
		
		
		$selector->joinLeft("planingfacturepay","planingfacturepay.idplaningsessionpayement=planingsessionpayement.idplaningsessionpayement");
		$selector->joinLeft("modelfacture","planingfacturepay.idmodelfacture=modelfacture.idmodelfacture");
		$selector->joinLeft("sessionpreinscription","sessionpreinscription.idsessionpreinscription=planingsessionpayement.idsessionpreinscription");
		
		
		if(!empty($idsession)){
			$selector->where("planingsessionpayement.idsessionpreinscription=".$idsession);
		}
		
		if(!empty($idfacturesess)){
			$selector->where("planingsessionpayement.idplaningsessionpayement=".$idfacturesess);
		}
		//echo $selector->__toString();
		
		$rec= $this->fetchAll($selector);
		if($rec){
			$res_row=$rec->toArray();
			
			$planing=array();
			foreach ($res_row as $row){
				if(!isset($planing[$row['idplaningsessionpayement']])){
					$planing[$row['idplaningsessionpayement']]['datedebut']=$row['dateouverture'];
					$planing[$row['idplaningsessionpayement']]['datefin']=$row['datefermetude'];
					$planing[$row['idplaningsessionpayement']]['remarqueplanpay']=$row['remarqueplanpay'];
					$planing[$row['idplaningsessionpayement']]['idsess']=$row['idsessionpreinscription'];
				}
				
				$planing[$row['idplaningsessionpayement']]['facture'][$row['idmodelfacture']]["totalapays"]=$row['totalapays'];
				$planing[$row['idplaningsessionpayement']]['facture'][$row['idmodelfacture']]["ordredefacture"]=$row['ordredefacture'];
				$planing[$row['idplaningsessionpayement']]['facture'][$row['idmodelfacture']]["label"]=$row['labelfacture']; 
		 
				
			}
			return $planing;
		}else{
			return array();
		}*/
		return array();
	}
}
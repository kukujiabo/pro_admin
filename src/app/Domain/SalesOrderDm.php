<?php
namespace App\Domain;

class SalesOrderDm {
	
	public function getList($data) {

		return \App\request('App.SalesOrder.GetList', $data);

	}

	public function getDetail($data) {

		return \App\request('App.SalesOrder.GetDetail', $data);

	}

	public function updateOrder($data) {

		return \App\request('App.SalesOrder.UpdateOrder', $data);

	}

}
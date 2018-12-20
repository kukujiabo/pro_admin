<?php
namespace App\Domain;

class InvoiceDm {
	
	public function getList($data) {

		return \App\request('App.Invoice.GetList', $data);

	}

	public function getDetail($data) {

		return \App\request('App.Invoice.GetDetail', $data);

	}

}
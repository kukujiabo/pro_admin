<?php
namespace App\Domain;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

	public function download($data) {

		$result = \App\request('App.SalesOrder.GetList', $data);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Type:application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="订单数据.xlsx"');
    header('Cache-Control: max-age=0');
      
    $spreadsheet = new Spreadsheet();

    $titles = array(
    
      'cPOID' => '订单编号', 
      'dPODate' => '订单日期', 
      'cInvCode' => '存货编码', 
      'cInvName' => '存货名称', 
      'iQuantity' => '订购数量', 
      'cVenCode' => '供应商编号', 
      'cVenName' => '供应商名称', 
      'cPersonCode' => '业务员编码', 
      'cPersonName' => '业务员名称', 
      'dArriveDate' => '计划到货日期', 
      'cexch_name' => '货币币种', 
      'iTaxPrice' => '原币含税单价', 
      'iPerTaxRate' => '税率', 
      'iNatUnitPrice' => '本币无税单价', 
      'iMoney' => '本币金额', 
      'iNatTax' => '本币税额', 
      'iNatSum' => '本币价税合计'
    
    );

    $fields = explode(',', $data['fields']);

    $sheet = $spreadsheet->getActiveSheet();

    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    foreach($fields as $key => $field) {

	    foreach($titles as  $title) {

	      $sheet->setCellValue("{$characters[$key]}1", $titles[$field]);
	    
	    }

    }

    $sheet->getColumnDimension('A')->setWidth(30);

    $row = 2;

    foreach($result['PO_POMain'] as $index => $order) {

      $column = 0;

      $valueOrder = [];

      foreach($fields as $field) {

      	$valueOrder[$field] = $order[$field];

      }

      foreach($valueOrder as $value) {

        $cell = "{$characters[$column]}{$row}";

        $sheet->setCellValue($cell, $value);

        $column++;

      }

      $row++;

    }

    $writer = new Xlsx($spreadsheet);

    $writer->save("php://output");

    exit;

	}

}
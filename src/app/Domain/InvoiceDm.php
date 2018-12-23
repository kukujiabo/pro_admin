<?php
namespace App\Domain;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class InvoiceDm {
	
	public function getList($data) {

		return \App\request('App.Invoice.GetList', $data);

	}

	public function getDetail($data) {

		return \App\request('App.Invoice.GetDetail', $data);

	}

	public function download($data) {

		$result = \App\request('App.Invoice.GetList', $data);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Type:application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="结算单数据.xlsx"');
    header('Cache-Control: max-age=0');
      
    $spreadsheet = new Spreadsheet();

    $titles = array(
    
      'cPBVCode' => '结算单编号', 
      'dPBVDate' => '结算单日期', 
      'cInvCode' => '存货编码', 
      'cInvName' => '存货名称', 
      'iPBVQuantity' => '数量', 
      'cPBVBillType' => '发票类型', 
      'cVenCode' => '供应商编号', 
      'cVenName' => '供应商名称', 
      'cDepCode' => '部门编号', 
      'cDepName' => '部门名称', 
      'cPersonCode' => '业务员编码', 
      'cPersonName' => '业务员名称', 
      'cexch_name' => '货币币种', 
      'iOriSum' => '原币价税合计', 
      'iTaxRate' => '税率', 
      'iOriTaxPrice' => '原币税额', 
      'iOriCost' => '原币单价',
      'iOriMoney' => '原币金额', 
      'cPOID' => '源订单编号'    
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

    foreach($result['PurBillVouch'] as $index => $order) {

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
<?php
namespace App\Domain;

class RoleDm {
	
	public function create($data) {

		return \App\request('App.Role.Create', $data);

	}

	public function getList($data) {

		return \App\request('App.Role.getList', $data);

	}

	public function getDetail($data) {

		return \App\request('App.Role.GetDetail', $data);

	}

	public function edit($data) {

		return \App\request('App.Role.Edit', $data);

	}

	public function getAll($data) {

		return \App\request('App.Role.GetAll', $data);

	}

}
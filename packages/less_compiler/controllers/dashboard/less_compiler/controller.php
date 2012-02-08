<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardLessCompilerController extends Controller {

	public function on_start() {
		$this->redirect('/dashboard/less_compiler/less_files');
	}

}
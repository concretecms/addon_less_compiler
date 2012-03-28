<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardLessCompilerLessFilesController extends DashboardBaseController {
	public $helpers = array('text','form','concrete/interface', 'validation/form');

	public function view() {
		Loader::model('less_compiler','less_compiler');
		Loader::model('page_theme');
		$theme = PageTheme::getSiteTheme();
		$frpath = LESSDIR;
		if (!file_exists(LESSDIR)) {
			$this->set('warning','You need to create your LESS directory at <pre style="color:#111;text-transform:none">'.LESSDIR.'</pre>');
			return;
		} else if (!is_dir(LESSDIR)) {
			$this->set('warning','Your configured LESSDIR is not a directory!');
			return;
		}
		$topath = CSSDIR;
		$lc = new LessCompiler();

		$this->set('frpath', str_replace(DIR_BASE,'',$frpath));
		$this->set('topath', str_replace(DIR_BASE,'',$topath));
		$this->set('files', $lc->getFlatFilesArray($frpath));
		$this->set('compileurl', View::url('/dashboard/less_compiler/less_files/compile'));
	}

	public function compile() {
		Loader::model('job');
		$jobObj = Job::getJobObjByHandle('LessCompile');
		$this->view();
		$this->set("message",$jobObj->executeJob());
	}

}

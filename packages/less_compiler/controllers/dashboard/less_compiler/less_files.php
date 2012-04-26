<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardLessCompilerLessFilesController extends DashboardBaseController {
	public $helpers = array('text','form','concrete/interface', 'validation/form');

	public function view() {
		Loader::model('less_compiler','less_compiler');
		Loader::model('page_theme');

		if (!defined('LESS_LESSDIR')) {
			$less = Loader::helper('less','less_compiler');
			$less->defineLess();
		}

		$theme = PageTheme::getSiteTheme();
		if (!file_exists(LESS_LESSDIR) && !file_exists(LESS_LESSDIR_OVERRIDE)) {
			$this->set('warning',t('You need to create your LESS directory at').' <pre style="color:#111;text-transform:none">'.LESS_LESSDIR.'</pre>');
			return;
		} else if (!is_dir(LESS_LESSDIR) && !is_dir(LESS_LESSDIR_OVERRIDE)) {
			$this->set('warning',t('Your configured LESS_LESSDIR is not a directory!'));
			return;
		}
		$frpath = LESS_LESSDIR;
		if (file_exists(LESS_LESSDIR_OVERRIDE) && is_dir(LESS_LESSDIR_OVERRIDE)) {
			$frpath = LESS_LESSDIR_OVERRIDE;
		}
		$topath = LESS_CSSDIR;
		$lc = new LessCompiler();

		$this->set('frpath', str_replace(DIR_BASE,'',$frpath));
		$this->set('topath', str_replace(DIR_BASE,'',$topath));
		$this->set('files', $lc->getFlatFilesArray($frpath));
		$this->set('compileurl', View::url('/dashboard/less_compiler/less_files/compile'));
	}

	public function compile() {
		Loader::model('job');
		$jobObj = Job::getJobObjByHandle('less_compile');
		$this->view();
		$output = $jobObj->executeJob();
		if ($output == 'Successfully compiled!') {
			$this->set("message",$output);
		} else {
			$error = Loader::helper('validation/error');
			$error->add($output);
			$this->set("error",$error);
		}
	}

}

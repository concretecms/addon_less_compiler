<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardLessCompilerLessFilesController extends Controller {
	public $helpers = array('text','form','concrete/interface', 'validation/form');
	
	public function view() {
		Loader::model('less_compiler','less_compiler');
		Loader::model('/models/page_theme');
		$theme = PageTheme::getSiteTheme();
		$path = $theme->getThemeDirectory();
		$frpath = $path.'/less';
		$topath = $path.'/';
		$lc = new LessCompiler();
		
		if (is_dir($path)) {
			$this->set('path', $path);
			$this->set('frpath', $frpath);
			$this->set('topath', $topath);
			$this->set('files', $lc->getFlatFilesArray($frpath));
		}
	}
	
}
?>
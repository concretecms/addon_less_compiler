<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardLessCompilerLessFilesController extends Controller {
	public $helpers = array('text','form','concrete/interface', 'validation/form');
	
	public function view() {
		Loader::model('less_compiler','less_compiler');
		Loader::model('/models/page_theme');
		$theme = PageTheme::getSiteTheme();
		$frpath = LESSDIR;
		$topath = CSSDIR;
		$lc = new LessCompiler();
		
		$this->set('frpath', str_replace(DIR_BASE,'',$frpath));
		$this->set('topath', str_replace(DIR_BASE,'',$topath));
		$this->set('files', $lc->getFlatFilesArray($frpath));
	}
	
}
?>
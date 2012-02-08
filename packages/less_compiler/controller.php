<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class LessCompilerPackage extends Package {

	protected $pkgHandle = 'less_compiler';
	protected $appVersionRequired = '5.5';
	protected $pkgVersion = '0.9';
	
	public function getPackageDescription() {
		return t('Compile your Less with a job.');
	}
	
	public function getPackageName() {
		return t('Less Compiler');
	}
	
	public function install() {
		$pkg = parent::install();
		
		Loader::model('single_page');
		Loader::model('job');
		
		$dm = SinglePage::add('/dashboard/less_compiler', $pkg);
		$dm->update(array('cName'=>t("LESS Compiler"), 'cDescription'=>t("Manage Your LESS Association")));
		
		$dm = SinglePage::add('/dashboard/less_compiler/less_files', $pkg);
		$dm->update(array('cName'=>t("Manage LESS Files"), 'cDescription'=>t("Manage Your LESS Association")));
		
		// install geocode job
		$jb = Job::installByPackage('LessCompile', $pkg);
	}
	
}

?>

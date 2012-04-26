<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class LessCompilerPackage extends Package {

	protected $pkgHandle = 'less_compiler';
	protected $appVersionRequired = '5.5';
	protected $pkgVersion = '0.9.3';

	public function getPackageDescription() {
		return t('Compile your Less with a job.');
	}

	public function getPackageName() {
		return t('Less Compiler');
	}

	public function on_start() {
	}

	public function install() {

		$pkg = parent::install();

		self::on_start();
		
		$less = loader::helper('less','less_compiler');
		$less->defineLess();
		
		$csspath = '/';
		foreach(explode('/',LESS_CSSDIR) as $node) {
			$csspath .= "/".$node;
			if (!is_dir($csspath)) mkdir($csspath);
		}

		Loader::model('single_page');
		Loader::model('job');

		$dm = SinglePage::add('/dashboard/less_compiler', $pkg);
		$dm->update(array('cName'=>t("LESS Compiler"), 'cDescription'=>t("Manage Your LESS Association")));

		$dm = SinglePage::add('/dashboard/less_compiler/less_files', $pkg);
		$dm->update(array('cName'=>t("Manage LESS Files"), 'cDescription'=>t("Manage Your LESS Association")));

		$jb = Job::installByPackage('less_compile', $pkg);
	}

}

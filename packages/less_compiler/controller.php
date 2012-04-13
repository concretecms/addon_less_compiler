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

	public function on_start() {
		if (!defined(LESS_CSSDIR)) define(LESS_CSSDIR,  DIR_FILES_UPLOADED.'/css/');
	}

	public function install() {

		$pkg = parent::install();

		self::on_start();

		if (!is_dir(LESS_CSSDIR))  mkdir(LESS_CSSDIR);

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

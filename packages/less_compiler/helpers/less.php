<?php defined('C5_EXECUTE') or die(_("Access Denied."));
class lessHelper {
	public $queue = array();

	public function __invoke() { echo $this->renderCache(); }
	public function __toString() { return $this->renderCache(); }

	public function renderCache() {
		$output = '';
		foreach(array_unique(array_filter($this->queue)) as $file) {
			$output .= '<link rel="stylesheet" type="text/css" href="';
			$output .= $file;
			$output .= '">'."\n";
		}
		return $output;
	}
	
	public function defineLess() {
		Loader::model('page_theme');
		$theme = PageTheme::getSiteTheme();
		if (!defined('LESS_LESSDIR')) {
			$path = $theme->getThemeDirectory();
			define(LESS_LESSDIR,realpath($path).'/less');
		}
		if (!defined('LESS_CSSDIR')) {
			$handle = $theme->getThemeHandle();
			define('LESS_CSSDIR',  DIR_FILES_UPLOADED.'/css/'.$handle);
		}
		if (!defined('LESS_LESSDIR_OVERRIDE')) {
			$path = 
			$handle = $theme->getThemeHandle();
			define('LESS_LESSDIR_OVERRIDE',DIR_BASE.'/themes/'.$handle."/less");
		}
	}
	
	public function add() {
		$files = func_get_args();
		foreach ($files as $file) {
			$this->queue[] = $this->getUrl($file);
		}
	}

	public function resetQueue() {
		$this->queue = array();
	}

	public function link() {
		$oldQueue = $this->queue;
		$this->queue = array();

		foreach(array_filter(func_get_args()) as $file) {
			$this->queue[] = $this->getUrl($file);
		}
		$rendered = $this->renderCache();
		$this->queue = $oldQueue;
		return $rendered;
	}

	public function getUrl($file) {
		$file = trim($file);
		$this->defineLess();
		$dir = realpath(LESS_CSSDIR);
		if (substr($dir,0,strlen(realpath(DIR_BASE))) != realpath(DIR_BASE)) {
			return;
		}
		$dir = substr($dir,strlen(realpath(DIR_BASE)));
		if (substr($file,-5) == '.less') {
			return BASE_URL.$dir.'/'.substr($file, 0, strlen($file) - 5).'.css';
		} else {
			return BASE_URL.$dir.'/'.$file;
		}
	}
}
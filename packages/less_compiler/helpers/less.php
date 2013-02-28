<?php
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
		$dir = realpath(CSSDIR);
		if (substr($dir,0,strlen(realpath(DIR_BASE))) != realpath(DIR_BASE)) {
			return;
		}
		$dir = substr($dir,strlen(realpath(DIR_BASE)));
		if (substr($file,-5) == '.less') {
                    $cssFile = BASE_URL.DIR_REL.$dir.'/'.substr($file, 0, strlen($file) - 5).'.css';
		} else {
                    $cssFile = BASE_URL.DIR_REL.$dir.'/'.$file;
		}
                return str_replace(DIRECTORY_SEPARATOR,'/',$cssFile);
	}
}
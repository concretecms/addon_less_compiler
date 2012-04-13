<?php defined('C5_EXECUTE') or die(_("Access Denied."));
class LessCompiler {

	public function getFilesArray($dir=null) {
		$less = Loader::helper('less','less_compiler');
		$less->defineLess();

		if($dir === null) $dir = LESS_LESSDIR;
		if (file_exists($dir)){
			$d = opendir($dir);
			$out = array();
			while($f = readdir($d)) {
				if ($f == '..' || $f == '.')continue;
				if (is_dir($dir."/".$f)) {
					$fs = $this->getFilesArray($dir."/".$f);
					if ($fs) $out[$dir."/".$f] = $this->getFilesArray($dir."/".$f);
				}
				else if (substr($f,-5) == '.less') array_push($out,$dir."/".$f);
			}
			return $out;
		}
		return array();
	}

	public function getFlatFilesArray($dir=null,$rem=null) {
		$less = Loader::helper('less','less_compiler');
		$less->defineLess();

		if($dir === null) $dir = LESS_LESSDIR;
		$files = $this->getFilesArray($dir);
		return $this->flatten($files,$dir);
	}

	private function flatten(array $arr, $rem=null) {
		$o = array();
		foreach($arr as $a) {
			if (is_array($a))
				$o = array_merge($this->flatten($a,$rem),$o);
			else
				array_push($o,($rem?str_replace($rem,'',$a):$a));
		}
		return $o;
	}

}
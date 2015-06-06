<?php

namespace Forge\Cache;

class File {

	protected $file;

	protected $content;

	public function __construct($file) {
		$this->file = $file;

		if (file_exists($file) && is_readable($file)) {
			$obj = file_get_contents($file);
			$this->content = unserialize($obj);
		}
	}

	public function save($content) {
		
		echo dirname($this->file);
		if (!is_writable(dirname($this->file))) {
			throw new \Exception('Unable to write to cache directory');
		}

		if (file_exists($this->file) && !is_writable($this->file)) {
			throw new \Exception('Unable to write to cache file');
		}

		$fp = fopen($this->file, 'w');
		fwrite($fp, serialize($content));
		fclose($fp);

		$this->content = $content;
	}

	public function read() {
		return $this->content;
	}
}
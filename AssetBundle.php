<?php

namespace appmake\yii2\bootstrap;

/**
 * Base asset bundle for all widgets
 *
 * @author Sergey Safronov <safronov.ser@icloud.com>
 * @since 1.0
 */
class AssetBundle extends \yii\web\AssetBundle
{
	const EMPTY_ASSET = 'N0/@$$3T$';
	const EMPTY_PATH = 'N0/P@T#';
	const APPMAKE_ASSET = 'A3/@$$3T$';
	const APPMAKE_PATH = 'A3/P@T#';

	public $js = self::APPMAKE_ASSET;
	public $css = self::APPMAKE_ASSET;
	public $sourcePath = self::APPMAKE_PATH;
	public $depends = [
		'yii\web\JqueryAsset',
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];

	/**
	 * @inheritdoc
	 */
	public function init() {
		parent::init();
		if ($this->js === self::APPMAKE_ASSET) {
			$this->js = [];
		}
		if ($this->css === self::APPMAKE_ASSET) {
			$this->css = [];
		}
		if ($this->sourcePath === self::APPMAKE_PATH) {
			$this->sourcePath = null;
		}
	}

	/**
	 * Adds a language JS locale file
	 *
	 * @param string $lang the ISO language code
	 * @param string $prefix the language locale file name prefix
	 * @param string $dir the language file directory relative to source path
	 * @param bool $min whether to auto use minified version
	 *
	 * @return AssetBundle instance
	 */
	public function addLanguage($lang = '', $prefix = '', $dir = null, $min = false) {
		if (empty($lang) || substr($lang, 0, 2) == 'en') {
			return $this;
		}
		$ext = $min ? (YII_DEBUG ? ".min.js" : ".js") : ".js";
		$file = "{$prefix}{$lang}{$ext}";
		if ($dir === null) {
			$dir = 'js';
		}
		elseif ($dir === "/") {
			$dir = '';
		}
		$path = $this->sourcePath.'/'.$dir;
		if (!Config::fileExists("{$path}/{$file}")) {
			$lang = Config::getLang($lang);
			$file = "{$prefix}{$lang}{$ext}";
		}
		if (Config::fileExists("{$path}/{$file}")) {
			$this->js[] = empty($dir) ? $file : "{$dir}/{$file}";
		}
		return $this;
	}

	/**
	 * Set up CSS and JS asset arrays based on the base-file names
	 *
	 * @param string $type whether 'css' or 'js'
	 * @param array  $files the list of 'css' or 'js' basefile names
	 */
	protected function setupAssets($type, $files = []) {
		if ($this->$type === self::APPMAKE_ASSET) {
			$srcFiles = [];
			$minFiles = [];
			foreach ($files as $file) {
				$srcFiles[] = "{$file}.{$type}";
				$minFiles[] = "{$file}.min.{$type}";
			}
			$this->$type = YII_DEBUG ? $srcFiles : $minFiles;
		}
		elseif ($this->$type === self::EMPTY_ASSET) {
			$this->$type = [];
		}
	}

	/**
	 * Sets the source path if empty
	 *
	 * @param string $path the path to be set
	 */
	protected function setSourcePath($path) {
		if ($this->sourcePath === self::APPMAKE_PATH) {
			$this->sourcePath = $path;
		}
		elseif ($this->sourcePath === self::EMPTY_PATH) {
			$this->sourcePath = null;
		}
	}

}

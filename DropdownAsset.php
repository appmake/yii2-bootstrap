<?php

namespace appmake\yii2\bootstrap;

/**
 * Dropdown bundle for appmake\yii2\Dropdown
 *
 * @author Sergey Safronov <safronov.ser@icloud.com>
 * @since 1.0
 */
class DropdownAsset extends AssetBundle
{
	public function init() {
		$this->setSourcePath(__DIR__.'/assets');
		$this->setupAssets('css', ['css/dropdown']);
		$this->setupAssets('js', ['js/dropdown']);
		parent::init();
	}
}

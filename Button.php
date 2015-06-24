<?php

namespace appmake\yii2\bootstrap;

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @author Sergey Safronov <safronov.ser@icloud.com>
 */
class Button extends Widget
{
	public $type = 'default';
	public $size = 'default';
	public $tagName = 'button';
	public $label = '';
	public $encodeLabel = true;
	public $icon;
	public $url;
	public $block = false;

	public function init() {
		parent::init();
		Html::addCssClass($this->options, 'btn');
	}

	public function run() {
		if (!$this->visible)
			return false;

		if (($class = self::sizeToClass($this->size)) !== false)
			Html::addCssClass($this->options, $class);
		Html::addCssClass($this->options, "btn-{$this->type}");

		$label = $this->encodeLabel ? Html::encode($this->label) : $this->label;
		if (isset($this->icon))
			$label = "<i class='glyphicon glyphicon-{$this->icon}'></i> ".$label;

		if (isset($this->url)) {
			$this->tagName = 'a';
			$this->options['role'] = 'button';
			$this->options['href'] = Url::to($this->url);
			if ($this->disabled)
				Html::addCssClass($this->options, 'disabled');
		} else {
			if ($this->disabled)
				$this->options['disabled'] = 'disabled';
		}

		if ($this->block)
			Html::addCssClass($this->options, 'btn-block');

		$html = Html::tag($this->tagName, $label, $this->options);

		echo $html;
		$this->registerPlugin('button');
	}

	public static function sizeToClass($size) {
		switch ($size) {
			case self::SIZE_LARGE:
				return 'btn-lg';
			case self::SIZE_SMALL:
				return 'btn-sm';
			case self::SIZE_EXTRA_SMALL;
				return 'btn-xs';
			default:
				return false;
		}
	}

}

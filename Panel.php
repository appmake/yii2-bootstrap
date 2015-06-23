<?php

namespace appmake\bootstrap;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\VarDumper;

/**
 * @author Sergey Safronov <safronov.ser@icloud.com>
 */
class Panel extends Widget
{
	public $header;
	public $content;
	public $footer;
	public $type = 'default';
	public $hasBody = true;
	
	public $bodyOptions = ['class' => 'panel-body'];
	public $headerOptions = ['class' => 'panel-heading'];
	public $footerOptions = ['class' => 'panel-footer'];

	public function init() {
		parent::init();

		if (!in_array($this->type, [
			self::TYPE_DEFAULT,
			self::TYPE_PRIMARY,
			self::TYPE_SUCCESS,
			self::TYPE_INFO,
			self::TYPE_WARNING,
			self::TYPE_DANGER
		]))
			throw new InvalidConfigException('Invalid panel type: '.VarDumper::dumpAsString($this->type));

		if (!isset($this->options['id']))
			$this->options['id'] = $this->getId();

		Html::addCssClass($this->options, 'panel');
		Html::addCssClass($this->options, 'panel-'.$this->type);
		
		echo Html::beginTag('div', $this->options);
		if (isset($this->header))
			echo Html::tag('div', $this->header, $this->headerOptions);
		if ($this->hasBody)
			echo Html::beginTag('div', $this->bodyOptions);
	}

	public function run() {
		echo $this->content;
		if ($this->hasBody) {
			echo Html::endTag('div');
		}
		if (isset($this->footer))
			echo Html::tag('div', $this->footer, $this->footerOptions);
		echo Html::endTag('div');
	}

}

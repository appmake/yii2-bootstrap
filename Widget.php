<?php
<<<<<<< HEAD

namespace appmake\yii2\bootstrap;
=======
namespace appmake\bootstrap;
>>>>>>> FETCH_HEAD

/**
 * @author Sergey Safronov <safronov.ser@icloud.com>
 */
class Widget extends \yii\bootstrap\Widget
{	
	const TYPE_DEFAULT		= 'default';
	const TYPE_PRIMARY		= 'primary';
	const TYPE_SUCCESS		= 'success';
	const TYPE_INFO			= 'info';
	const TYPE_WARNING		= 'warning';
	const TYPE_DANGER		= 'danger';
	const TYPE_LINK			= 'link';
	
	const SIZE_DEFAULT		= 'default';
    const SIZE_LARGE		= 'large';
    const SIZE_SMALL			= 'small';
    const SIZE_EXTRA_SMALL	= 'extra_small';
	
	public $visible = true;
	public $disabled = false;
}

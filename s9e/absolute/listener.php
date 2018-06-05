<?php

/**
* @package   s9e\absolute
* @copyright Copyright (c) 2018 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\absolute;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return ['core.text_formatter_s9e_configure_after' => 'onConfigure'];
	}

	public function onConfigure($event)
	{
		$event['configurator']->tags['URL']->attributes['url']->filterChain->prepend('preg_replace')
			->resetParameters()
			->addParameterByValue('(^\\w+\\.\\w)')
			->addParameterByValue('//$0')
			->addParameterByName('attrValue');
	}
}
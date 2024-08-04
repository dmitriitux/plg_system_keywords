<?php namespace Joomla\Plugin\System\Keywords\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;

/**
 * Revars plugin.
 *
 * @package   revars
 * @since     1.1
 */
class Plugin extends CMSPlugin implements SubscriberInterface
{

	/**
	 * Application object
	 *
	 * @var    CMSApplication
	 * @since  1.0.0
	 */
	protected $app;

	/**
	 * Affects constructor behavior. If true, language files will be loaded automatically.
	 *
	 * @var    boolean
	 * @since  1.0.0
	 */
	protected $autoloadLanguage = true;

	public static function getSubscribedEvents(): array
	{
		return [
			'onBeforeRender'       => 'onBeforeRender',
			'onContentPrepareForm' => 'onContentPrepareForm',
		];
	}

	public function onBeforeRender()
	{
		if (!$this->app->isClient('site'))
		{
			return;
		}

		$menu     = $this->app->getMenu()->getActive();
		$keywords = $menu->getParams()->get('menu-meta_keywords', '');

		$this->app->getDocument()->setMetaData('keywords', htmlentities($keywords));

	}

	public function onContentPrepareForm(Event $event)
	{
		/** @var Form $form */
		$form = $event->getArgument('form');

		if ($form->getName() !== 'com_menus.item')
		{
			return;
		}

		$file = JPATH_PLUGINS . '/system/keywords/forms/keywords.xml';

		if (!file_exists($file))
		{
			return;
		}

		$form->loadFile($file);
	}

}
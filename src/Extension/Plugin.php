<?php namespace Joomla\Plugin\System\Keywords\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Language\Text;
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
			'onAfterRender'        => 'onAfterRender',
			'onContentPrepareForm' => 'onContentPrepareForm',
		];
	}


	public function onAfterRender()
	{
		$body = $this->app->getBody();
		$this->app->setBody($body);
	}

	public function onContentPrepareForm(Form $form, $data)
	{
		$form_name    = str_replace('.', '/', $form->getName());
var_dump($form_name);
	}

}

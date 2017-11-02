<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.11.17
 * Time: 16:58
 */

namespace frontend\widgets\auth;

use yii\authclient\widgets\AuthChoice;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\authclient\ClientInterface;
use yii\authclient\widgets\AuthChoiceItem;
use yii\base\Widget;

/**
 * extends in AuthChoice auth widget, and redefine method that
 * render html code to view
 * Class AuthWidget
 * @package frontend\widgets\auth
 */
class AuthWidget extends AuthChoice
{

    /**
     * Outputs client auth link.
     * @param ClientInterface $client external auth client instance.
     * @param string $text link text, if not set - default value will be generated.
     * @param array $htmlOptions link HTML options.
     * @return string generated HTML.
     * @throws InvalidConfigException on wrong configuration.
     */
    public function clientLink($client, $text = null, array $htmlOptions = [])
    {
        $viewOptions = $client->getViewOptions();

        if (empty($viewOptions['widget'])) {
            if ($text === null) {
                if ($client->getName() == 'google'){
                    $text = Html::tag('i', '',[
                            'class' => 'fa fa-google-plus-square ' . $client->getName(),
                            'aria-hidden' => true
                        ]) . $client->getName();
                } elseif ($client->getName() == 'facebook') {
                    $text = Html::tag('i', '',[
                            'class' => 'fa fa-facebook-official ' . $client->getName(),
                            'aria-hidden' => true]
                        ) . $client->getName();
                } else {
                    $text = Html::tag('span', '', ['class' => 'auth-icon ' . $client->getName()]);
                }
            }
            if (!isset($htmlOptions['class'])) {
                $htmlOptions['class'] = $client->getName();
            }
            if (!isset($htmlOptions['title'])) {
                $htmlOptions['title'] = $client->getTitle();
            }
            Html::addCssClass($htmlOptions, ['widget' => 'auth-link']);

            if ($this->popupMode) {
                if (isset($viewOptions['popupWidth'])) {
                    $htmlOptions['data-popup-width'] = $viewOptions['popupWidth'];
                }
                if (isset($viewOptions['popupHeight'])) {
                    $htmlOptions['data-popup-height'] = $viewOptions['popupHeight'];
                }
            }
            return Html::a($text, $this->createClientUrl($client), $htmlOptions);
        }

        $widgetConfig = $viewOptions['widget'];
        if (!isset($widgetConfig['class'])) {
            throw new InvalidConfigException('Widget config "class" parameter is missing');
        }
        /* @var $widgetClass Widget */
        $widgetClass = $widgetConfig['class'];
        if (!(is_subclass_of($widgetClass, AuthChoiceItem::className()))) {
            throw new InvalidConfigException('Item widget class must be subclass of "' . AuthChoiceItem::className() . '"');
        }
        unset($widgetConfig['class']);
        $widgetConfig['client'] = $client;
        $widgetConfig['authChoice'] = $this;
        return $widgetClass::widget($widgetConfig);
    }

    /**
     * Renders the main content, which includes all external services links.
     * @return string generated HTML.
     */
    protected function renderMainContent()
    {
        $items = [];
        foreach ($this->getClients() as $externalService) {
            $items[] = Html::tag('li', $this->clientLink($externalService));
        }
        return Html::tag('ul', implode('', $items), ['class' => 'auth-clients soc-reg']);
    }

}
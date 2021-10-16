<?php

namespace Pikokr\XePlugin\GrapesJs\Controllers;

use App\Facades\XePresenter;
use Pikokr\XePlugin\GrapesJs\Components\Modules\GrapesJSModule;
use Xpressengine\Config\ConfigEntity;
use Xpressengine\Config\ConfigManager;
use Xpressengine\Routing\InstanceConfig;

class GrapesJsInstanceController
{
    /**
     * @var ConfigManager
     */
    protected $configManager;

    public function __construct(ConfigManager $configHandler) {
        $this->configManager = $configHandler;
    }

    public function index(ConfigEntity $config) {
        $instanceId = InstanceConfig::instance()->getInstanceId();
        $config = $this->configManager->get(GrapesJSModule::getId() . '.' . $instanceId);

        $html = $config->get('html', '');
        $css = $config->get('css', '');

        return XePresenter::make('grapes_js::views/index', [
            'html' => $html,
            'css' => $css
        ])->render();
    }
}
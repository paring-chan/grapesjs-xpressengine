<?php
namespace Pikokr\XePlugin\GrapesJs\Controllers;

use App\Facades\XeDB;
use App\Facades\XeTheme;
use App\Http\Controllers\Controller as BaseController;
use Pikokr\XePlugin\GrapesJs\Components\Modules\GrapesJSModule;
use View;
use Xpressengine\Config\ConfigManager;
use XePresenter;
use Xpressengine\Http\Request;
use Xpressengine\Presenter\Presenter;

class GrapesJsSettingsController extends BaseController
{
    /**
     * @var ConfigManager
     */
    protected $configManager;

    public function __construct(ConfigManager $configHandler) {
        $this->configManager = $configHandler;
    }

    public function editConfig($pageId) {
        $config = $this->configManager->get(GrapesJSModule::getId() . '.' . $pageId);

//        return View::make('grapes_js::views/edit_page', [
//            'data' => $config['data'] == null ? '' : $config['data']
//        ])->render();

        XeTheme::selectSiteTheme();

        return XePresenter::make('grapes_js::views/edit_page', [
            'html' => $config->get('html', ''),
            'css' => $config->get('css', '')
        ])->render();
    }

    public function saveConfig(Request $request, $pageId) {
        XeDB::beginTransaction();

        try {
            $id = GrapesJSModule::getId() . '.' . $pageId;

            $config = $this->configManager->get($id);
            $html = $request->get('html', '');
            $css = $request->get('css', '');

            $config->set('html', $html);
            $config->set('css', $css);

            $this->configManager->modify($config);

//            $config->set('html', $html);
//            $config->set('css', $css);
//            $this->configManager->set($id, $config->toArray());
        } catch (\Exception $e) {
            XeDB::rollback();
            throw $e;
        }

        XeDB::commit();
        return ['ok' => true];
    }
}

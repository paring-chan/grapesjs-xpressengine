<?php

namespace Pikokr\XePlugin\GrapesJs\Components\Modules;

use App\Facades\XeDB;
use Pikokr\XePlugin\GrapesJs\GrapesJSHandler;
use View;
use Route;
use Xpressengine\Config\ConfigManager;
use Xpressengine\Menu\AbstractModule;

class GrapesJSModule extends AbstractModule
{
    public static function boot()
    {
        self::registerSettingsRoute();
        self::registerInstanceRoute();
    }

    protected static function registerInstanceRoute() {
        Route::instance(self::getId(), function() {
            Route::get('/', ['as' => 'index', 'uses' => 'Pikokr\XePlugin\GrapesJs\Controllers\GrapesJsInstanceController@index']);
        });
    }

    protected static function registerSettingsRoute()
    {
        Route::settings(self::getId(), function () {
            Route::get('config/{pageId}', [
                'as' => 'settings.grapes_js.grapes_js.config',
                'uses' => 'Pikokr\XePlugin\GrapesJs\Controllers\GrapesJsSettingsController@editConfig']
            );
            Route::put('config/{pageId}', [
                'uses' => 'Pikokr\XePlugin\GrapesJs\Controllers\GrapesJsSettingsController@saveConfig'
            ]);
        });
    }

    public function createMenuForm(): string
    {
        return '';
    }

    /**
     * getPageHandler
     *
     * @return GrapesJSHandler
     */
    protected function getPageHandler(): GrapesJSHandler
    {
        return app('xe.grapes_js.handler');
    }

    public function storeMenu($instanceId, $menuTypeParams, $itemParams)
    {
        $this->getPageHandler()->createPageInstance($instanceId, $menuTypeParams);
    }

    public function editMenuForm($instanceId): string
    {
        return '';
    }

    public static function getInstanceSettingURI($instanceId)
    {
        return route('settings.grapes_js.grapes_js.config', $instanceId);
    }

    public function updateMenu($instanceId, $menuTypeParams, $itemParams)
    {
        // TODO: Implement updateMenu() method.
    }

    public function summary($instanceId)
    {
        // TODO: Implement summary() method.
    }

    public function deleteMenu($instanceId)
    {
        XeDB::beginTransaction();

        try {
            $configManager = app('xe.config');

            $configManager->removeByName(GrapesJSModule::getId() . '.' . $instanceId);
        } catch (\Exception $e) {
            XeDB::rollback();
            throw $e;
        }
        XeDB::commit();
    }

    public function getTypeItem($id)
    {
        // TODO: Implement getTypeItem() method.
    }
}

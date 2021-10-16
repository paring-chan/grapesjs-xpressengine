<?php

namespace Pikokr\XePlugin\GrapesJs\Components\Modules;

use View;
use Route;
use Xpressengine\Menu\AbstractModule;

class GrapesJSModule extends AbstractModule
{
    public static function boot()
    {
        self::registerSettingsRoute();
    }

    protected static function registerSettingsRoute()
    {
        Route::settings(self::getId(), function () {
            Route::get('config/{pageId}', [
                'as' => 'settings.grapes_js.grapes_js.config',
                'uses' => 'Pikokr\XePlugin\GrapesJs\Controllers\GrapesJsSettingsController@editConfig']
            );
        });
    }

    public function createMenuForm(): string
    {
        return '';
    }

    public function storeMenu($instanceId, $menuTypeParams, $itemParams)
    {
        // TODO: Implement storeMenu() method.
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
        // TODO: Implement deleteMenu() method.
    }

    public function getTypeItem($id)
    {
        // TODO: Implement getTypeItem() method.
    }
}

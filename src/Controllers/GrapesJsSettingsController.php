<?php
namespace Pikokr\XePlugin\GrapesJs\Controllers;

use App\Facades\XePresenter;
use App\Http\Controllers\Controller as BaseController;
use View;

class GrapesJsSettingsController extends BaseController
{
    public function editConfig() {
        return View::make('grapes_js::views/edit_page')->render();
    }
}

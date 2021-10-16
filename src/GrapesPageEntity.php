<?php

namespace Pikokr\XePlugin\GrapesJs;

use Illuminate\Database\Eloquent\Model;
use Pikokr\XePlugin\GrapesJs\Migrations\GrapesJsPageMigration;

class GrapesPageEntity extends Model {
    protected $table = GrapesJsPageMigration::TABLE_NAME;

    public $timestamps = false;

    protected $fillable = ['data'];

    protected $primaryKey = '';
}

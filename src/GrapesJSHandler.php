<?php

namespace Pikokr\XePlugin\GrapesJs;

use mysql_xdevapi\Exception;
use XeDB;
use Pikokr\XePlugin\GrapesJs\Components\Modules\GrapesJSModule;
use Xpressengine\Config\ConfigEntity;
use Xpressengine\Config\ConfigManager;
use Xpressengine\Document\DocumentHandler;

class GrapesJSHandler
{
    /**
     * @var ConfigManager
     */
    protected $configManager;

    /**
     * @var DocumentHandler
     */
    protected $document;

    public function __construct(ConfigManager $configManager, DocumentHandler $document)
    {
        $this->configManager = $configManager;
        $this->document = $document;
    }

    protected function getConfigKeyString($pageId)
    {
        return sprintf('%s.%s', GrapesJSModule::getId(), $pageId);
    }

    protected function existPageInstance($pageId)
    {
        $configName = $this->getConfigKeyString($pageId);

        return ($this->configManager->get($configName) !== null);
    }

    /**
     * @throws \Exception
     */
    public function createPageInstance($pageId, array $inputs)
    {
        if ($this->existPageInstance($pageId)) {
            throw new \Exception("Already {$pageId} is existed");
        }

        XeDB::beginTransaction();
        try {
            $pageTitle = '';
            $this->createDocumentInstance($pageId, $pageTitle);
            $this->addPageConfig($pageId, $inputs);
        } catch (\Exception $e) {
            XeDB::rollback();
            throw $e;
        }

        XeDB::commit();
    }

    protected function addPageConfig($pageId, $pageConfigs)
    {
        $configName = $this->getConfigKeyString($pageId);
        $this->configManager->add($configName, $pageConfigs);
    }

    protected function createDocumentInstance($pageId, $pageTitle)
    {
        $documentConfig = new ConfigEntity;
        $documentConfig->set('instanceId', $pageId);
        $documentConfig->set('instanceName', $pageTitle);
        $documentConfig->set('revision', true);

        $this->document->getInstanceManager()->add($documentConfig);
    }
}

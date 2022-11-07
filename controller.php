<?php

namespace Concrete\Package\AttributeCroppieImage;

use Concrete\Core\Backup\ContentImporter;
use Config;
use Package;
use Route;

use Concrete\Core\Asset\AssetList;

class Controller extends Package
{
    protected $pkgHandle = 'attribute_croppie_image';
    protected $appVersionRequired = '5.8';
    protected $pkgVersion = '1.0.4';

    public function getPackageName()
    {
        return t('Croppie image attribute');
    }

    public function getPackageDescription()
    {
        return t('Installs an attribute where you can crop the uploaded picture');
    }

    protected function installXmlContent()
    {
        $pkg = Package::getByHandle($this->pkgHandle);

        $ci = new ContentImporter();
        $ci->importContentFile($pkg->getPackagePath() . '/install.xml');
    }

    public function install()
    {
        parent::install();

        if (!file_exists(DIR_BASE . '/application/files/avatars/')) {
            mkdir(DIR_BASE . '/application/files/avatars/', Config::get('concrete.filesystem.permissions.directory'));
        }

        $this->installXmlContent();
    }

    public function upgrade()
    {
        parent::upgrade();

        $this->installXmlContent();
    }

    protected function registerAssets()
    {
        $al = AssetList::getInstance();
        $pkg = Package::getByHandle($this->pkgHandle);

        $al->register('javascript', 'croppie', 'js/croppie.js', ['version' => '1.0.0', 'minify' => true, 'combine' => true], $pkg);
        $al->register('javascript', 'croppie/init', 'js/croppie.init.js', ['version' => '1.0.0', 'minify' => true, 'combine' => true], $pkg);
        $al->register('css', 'croppie', 'css/croppie.css', [], $pkg);
        $al->register('css', 'croppie/custom', 'css/croppie.custom.css', [], $pkg);

        $al->registerGroup('croppie', [
            ['javascript', 'croppie'],
            ['javascript', 'croppie/init'],
            ['css', 'croppie'],
            ['css', 'croppie/custom'],
        ]);
    }

    public function on_start()
    {
        $this->registerAssets();
    }
}

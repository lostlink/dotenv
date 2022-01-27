<?php

namespace App\Providers;

use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Butschster\Head\Contracts\Packages\ManagerInterface;
use Butschster\Head\Facades\PackageManager;
use Butschster\Head\MetaTags\Entities\Favicon;
use Butschster\Head\MetaTags\Meta;
use Butschster\Head\Packages\Package;
use Butschster\Head\Providers\MetaTagsApplicationServiceProvider as ServiceProvider;

class MetaTagsServiceProvider extends ServiceProvider
{
    protected function packages()
    {
        PackageManager::create('favicons', function (Package $package) {
            $package->setFavicon('/images/favicon/favicon.ico');
            collect(['16x16', '32x32', '194x194', '192x192'])
                ->each(function ($size) use ($package) {
                    $package->addTag(
                        'favicon.' . $size,
                        new Favicon('/images/favicon/favicon-' . $size . '.png', ['sizes' => $size])
                    );
                });
            $package->addLink('apple-touch-icon', ['sizes' => '180x180', 'href' => '/images/favicon/apple-touch-icon.png']);
            $package->addLink('manifest', ['href' => '/site.webmanifest']);
            $package->addLink('mask-icon', ['href' => '/images/favicon/safari-pinned-tab.svg', 'color' => '#5bbad5']);
            $package->addLink('shortcut icon', ['href' => '/images/favicon/favicon.ico']);
            $package->addMeta('apple-mobile-web-app-title', ['content' => 'dotEnv']);
            $package->addMeta('application-name', ['content' => 'dotEnv']);
            $package->addMeta('msapplication-TileColor', ['content' => '#00aba9']);
            $package->addMeta('msapplication-config', ['content' => '/browserconfig.xml']);
            $package->addMeta('theme-color', ['content' => '#ffffff']);
        });
    }

    // if you don't want to change anything in this method just remove it
    protected function registerMeta(): void
    {
        $this->app->singleton(MetaInterface::class, function () {
            $meta = new Meta(
                $this->app[ManagerInterface::class],
                $this->app['config']
            );

            $meta->initialize();

//            $meta->addWebmaster(Webmaster::GOOGLE, 'f+e-Ww4=[Pp4wyEPLdVx4LxTsQ');

            return $meta;
        });
    }
}

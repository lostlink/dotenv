<?php

namespace App\Traits;

//use App\Models\UserAgent;
use Exception;
use Spatie\Browsershot\Browsershot;

trait TakesScreenshots
{
    public string $url;

    public function getHtml($url = null): string
    {
        if ($url) {
            $this->setUrl($url);
        }

        return $this->browsershot()->bodyHtml();
    }

    public function getImage($url = null): string
    {
        if ($url) {
            $this->setUrl($url);
        }

        return $this->browsershot()->screenshot();
    }

    public function getBase64($url = null): string
    {
        if ($url) {
            $this->setUrl($url);
        }

        return $this->browsershot()->base64Screenshot();
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    private function browsershot(): Browsershot
    {
        if (empty($this->url)) {
            throw new Exception('URL cannot be empty');
        }

        return Browsershot::url($this->url)
            ->windowSize(720, 1280)
            ->setNodeModulePath(config('_app.paths.node_modules'))
            ->setNpmBinary(config('_app.binaries.npm'))
            ->setNodeBinary(config('_app.binaries.node'))
            ->setChromeBinary(config('_app.binaries.chrome'))
            ->setBinPath(app_path('Services/Browsershot/browser.js'))
            ->setOption('args', [
                '--autoplay-policy=user-gesture-required',
                '--disable-background-networking',
                '--disable-background-timer-throttling',
                '--disable-backgrounding-occluded-windows',
                '--disable-breakpad',
                '--disable-client-side-phishing-detection',
                '--disable-component-update',
                '--disable-default-apps',
                '--disable-dev-shm-usage',
                '--disable-domain-reliability',
                '--disable-extensions',
                '--disable-features=AudioServiceOutOfProcess',
                '--disable-hang-monitor',
                '--disable-ipc-flooding-protection',
                '--disable-notifications',
                '--disable-offer-store-unmasked-wallet-cards',
                '--disable-popup-blocking',
                '--disable-print-preview',
                '--disable-prompt-on-repost',
                '--disable-renderer-backgrounding',
                '--disable-setuid-sandbox',
                '--disable-speech-api',
                '--disable-sync',
                '--disk-cache-size=33554432',
                '--hide-scrollbars',
                '--ignore-gpu-blacklist',
                '--metrics-recording-only',
                '--mute-audio',
                '--no-default-browser-check',
                '--no-first-run',
                '--no-pings',
                '--no-sandbox',
                '--no-zygote',
                '--password-store=basic',
                '--use-gl=swiftshader',
                '--use-mock-keychain',
            ])
//            ->userAgent(UserAgent::first()->useragent)
            ->waitUntilNetworkIdle();
    }
}

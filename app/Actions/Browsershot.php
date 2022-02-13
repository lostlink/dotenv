<?php

namespace App\Actions;

//use App\Models\UserAgent;
use Exception;
use Wnx\SidecarBrowsershot\BrowsershotLambda;

class Browsershot
{
    public string $screenshotUrl;

    public static function __callStatic($funName, $arguments)
    {
        return (new self())->$funName($arguments);
    }

    public function getHtml($screenshotUrl = null): string
    {
        if ($screenshotUrl) {
            $this->setUrl($screenshotUrl);
        }

        return $this->browsershot()->bodyHtml();
    }

    public function setUrl(string $screenshotUrl): self
    {
        $this->screenshotUrl = $screenshotUrl;

        return $this;
    }

    private function browsershot(): BrowsershotLambda
    {
        if (empty($this->screenshotUrl)) {
            throw new Exception('URL cannot be empty');
        }

        return BrowsershotLambda::url($this->screenshotUrl)
            ->windowSize(720, 1280)
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

    public function getImage($screenshotUrl = null): string
    {
        if ($screenshotUrl) {
            $this->setUrl($screenshotUrl);
        }

        return $this->browsershot()->screenshot();
    }

    public function getBase64($screenshotUrl = null): string
    {
        if ($screenshotUrl) {
            $this->setUrl($screenshotUrl);
        }

        return $this->browsershot()->base64Screenshot();
    }
}

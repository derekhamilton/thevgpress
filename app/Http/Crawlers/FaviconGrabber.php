<?php
namespace App\Http\Crawlers;

use App\Contracts\Http\Crawlers\Grabber;

class FaviconGrabber implements Grabber
{
    public function get($url)
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $domain = parse_url($url, PHP_URL_HOST);

        $context = stream_context_create([
            'http' => [
                'timeout' => 3      // Timeout in seconds
            ]
        ]);

        $html = file_get_contents($url, 0, $context);

        if (!$html) {
            $html = file_get_contents($scheme.'://'.$domain, 0, $context);
        }

        if (!$html) {
            return null;
        }

        preg_match('/href=(\"|\')\/?((.*?)\.ico)/', $html, $regs);

        if (!isset($regs[2])) {
            preg_match('/href=(\"|\')\/?(favicon\.([a-zA-Z]{3}))/', $html, $regs);
        }

        $regs[2]{0} != 'h' ? $faviconUrl = $scheme.'://'.$domain.'/'.$regs[2] : $faviconUrl = $regs[2];

        if (isset($regs[1])) {
            return file_get_contents($faviconUrl, 0, $context);
        }
    }
}

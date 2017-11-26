<?php
namespace App\Files\Savers;

use Illuminate\Config\Repository as Configuration;
use App\Contracts\Http\Crawlers\Grabber;

class FileGrabberSaver
{
    /** @var string */
    private $dir;

    /** @var Grabber */
    private $grabber;

    /**
     * @param Grabber $grabber
     */
    public function __construct(Configuration $config, Grabber $grabber)
    {
        $this->dir = $config->get('app.filesDir');
        $this->grabber = $grabber;
    }

    /**
     * @param string $url
     * @return string|null
     */
    public function save($url)
    {
        $domain = parse_url($url, PHP_URL_HOST);
        $filePath = "{$this->dir}/$domain.ico";
        $failFilePath = "{$this->dir}/$domain.fail";

        if (file_exists($filePath)) {
            return $filePath;
        }

        if (file_exists($failFilePath)) {
            return null;
        }

        $file = $this->grabber->get($url);
        if (!$file) {
            return null;
        }

        file_put_contents($filePath, $file);
        return $filePath;
    }
}

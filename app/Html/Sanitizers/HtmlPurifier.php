<?php
namespace App\Html\Sanitizers;

use App\Contracts\Html\Sanitizer;
use App\Contracts\Html\HtmlPurifier as Purifier;

class HtmlPurifier implements Sanitizer
{
    /**
     * @param Purifier $purifier
     */
    public function __construct()
    {
        require_once(config('app.dir').'/vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php');

        $config = \HTMLPurifier_Config::createDefault();
        $config->set('HTML.DefinitionID', 'stupidFixForTargetLinks');

        // configuration goes here:
        $config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
        $config->set('HTML.Doctype', 'XHTML 1.0 Transitional'); // replace with your doctype

        //$config->set('HTML', 'AllowedElements', array('b', 'i', 'p', 'a', 'img', 'font', 'br', 'span', 'div', 'blockquote', 'ol', 'ul', 'li', 'object', 'param', 'embed'));
        //$config->set('HTML', 'AllowedAttributes', array('a.href', '*.id', 'div.class', 'blockquote.class', 'div.style', 'span.style', 'object.width', 'object.height', 'object.codebase', 'embed.width', 'embed.height', 'embed.src', 'embed.type'));
        $config->set('HTML.AllowedElements', array('table','th','tr','tbody','thead','td','b', 'i', 'p', 'a', 'strong', 'em', 'img', 'font', 'br', 'span', 'div', 'blockquote', 'ol', 'ul', 'li', 'pre', 'font','hr','strike','s','sup','sub'));
        $config->set('HTML.AllowedAttributes', array('a.href', 'a.target', '*.id', '*.class', 'p.style', 'div.style', 'span.style', 'pre.style', 'img.src', 'img.alt', 'img.title', '*.width', '*.height', 'img.style', 'font.size', 'font.color', 'font.face','table.border','table.style', 'td.style', 'th.style', 'tr.style'));
        //$config->set('HTML', 'AllowedAttributes', array('Filter.YouTube' => true));
        $config->set('Filter.YouTube', true);

        $def = $config->maybeGetRawHTMLDefinition(true);
        if ($def) {
            $def->addAttribute('a', 'rel', 'Enum#nofollow');
            $def->addAttribute('a', 'target', 'Enum#_blank');
        }
        $this->purifier = new \HTMLPurifier($config);
    }

    public function sanitize($string)
    {
        return $this->purifier->purify($string);
    }
}

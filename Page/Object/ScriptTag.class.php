<?php
/**
 * This namespace is for objects that are for building pages.
 */
namespace TheMysteryMarket\Page\Object
{

    /**
     * @todo comment this file.
     */
    class ScriptTag
    {
        private $tagString = '<script src="%s"></script>';
        private $uri;

        public function __construct(string $uri)
        {
            $this->uri = $uri;
        }

        public function Generate(): string
        {

            return sprintf($this->tagString, $this->uri);
        }
    }
}
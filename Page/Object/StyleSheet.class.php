<?php
/**
 * This namespace is for objects that are for building pages.
 */
namespace TheMysteryMarket\Page\Object
{

    /**
     * This is a very basic style sheet object. I will expand on this as necessary.
     */
    class StyleSheet
    {
        /** @var string $tagString The string that is passed into sprintf to be populated. */
        private $tagString = '<link href="%s" rel="stylesheet">';
        /** @var string $uri The style sheet uri. */
        private $uri;

        /**
         * This is the basic constructor.
         * @param string $uri
         */
        public function __construct(string $uri)
        {
            $this->uri = $uri;
        }

        /**
         * This method will generate each style sheet.
         * @return string
         */
        public function Generate(): string
        {
            return sprintf($this->tagString, $this->uri);
        }
    }
}
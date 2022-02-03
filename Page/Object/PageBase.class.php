<?php
/**
 * This namespace is for objects that are for building pages.
 */
namespace TheMysteryMarket\Page\Object
{
    /** Include both the StyleSheet and ScriptTag object files and namespaces. */
    require_once("Page/Object/StyleSheet.class.php");
    require_once("Page/Object/ScriptTag.class.php");
    use TheMysteryMarket\Page\Object\StyleSheet;
    use TheMysteryMarket\Page\Object\ScriptTag;

    /**
     * This is the PageBase abstract class. This contains all the support for building out a generic page.
     */
    abstract class PageBase
    {
        /** @var string|null $title The page title tag content or null */
        protected $title            = NULL;
        /** @var string|null $description The meta description or null */
        protected $description      = NULL;
        /** @var string|null $author The site author or null. */
        protected $author           = NULL;
        /** @var string|null $ogTitle The og:title meta property or null */
        protected $ogTitle          = NULL;
        /** @var string|null $ogType The og:type meta property or null */
        protected $ogType           = NULL;
        /** @var string|null $ogURL The og:url meta property or null */
        protected $ogURL            = NULL;
        /** @var string|null $ogDescription The og:description property or null */
        protected $ogDescription    = NULL;
        /** @var string|null $ogImgage The og:image property or null */
        protected $ogImage          = NULL;
        /** @var string|null $faviconICO The favicon as an ICO or null */
        protected $faviconICO       = NULL;
        /** @var string|null $faviconSVG The favicon as a svg or null */
        protected $faviconSVG       = NULL;
        /** @var string|null $faviconPNG The favicon as a png or null */
        protected $faviconPNG       = NULL;
        /** @var string|null $gTag This is the google analytics tag  */
        protected $gTag             = NULL;
        /** @var string|null $facebookPixel The facebook pixel string  */
        protected $facebookPixel    = NULL;
        /** @var StyleSheet[] $styleSheets  This is an array of all the style sheets that the page uses represented as StyleSheet objects*/
        protected $styleSheets      = [];
        /** @var ScriptTag[] $topScripts This is an array of all the script tags to generate at the top of the page represented by ScriptTag objects. */
        protected $topScripts       = [];
        /** @var ScriptTag[] $bottomScripts This is an array of all the script tags to generate at the bottom of the page represented by ScriptTag objects. */
        protected $bottomScripts    = [];
        /** @var string|null $bodyHTML This is the body html or null. */
        protected $bodyHTML         = NULL;
        /** @var string|null $bodyClass This is an optional body class. */
        protected $bodyClass        = NULL;

        /**
         * This function returns a string containing the HTML doctype and tags up to the viewport.
         * @return string
         */
        protected function GenerateDocumentStart(): string
        {
            return '
            <!doctype html>
                <html lang="en">';
        }

        /**
         * This method will generate all the header html then return a string containing it.
         * @return string
         */
        protected function GenerateHTMLHead(): string
        {
            $returnString = "
                <head>
                    <meta charset=\"utf-8\">
                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n";
            /** If the title is set generate the title tag and add it to the return string. */
            if(!is_null($this->title))
            {
                $returnString .= sprintf("<title>%s</title>", $this->title)."\r\n";
            }
            /** If the description is set generate the description tag and add it to the return string. */
            if(!is_null($this->description))
            {
                $returnString .= sprintf('<meta name="description" content="%s">', $this->description)."\r\n";
            }
            /** if the author is set generate it and add it to the return string. */
            if(!is_null($this->author))
            {
                $returnString .= sprintf('<meta name="author" content="%s">', $this->author)."\r\n";
            }
            /** if the ogTitle is set generate it and add it to the return string. */
            if(!is_null($this->ogTitle))
            {
                $returnString .= sprintf('<meta property="og:title" content="%s">', $this->ogTitle)."\r\n";
            }
            /** if the ogType is set generate the tag and add it to the return string. */
            if(!is_null($this->ogType))
            {
                $returnString .= sprintf('<meta property="og:type" content="%s">', $this->ogType)."\r\n";
            }
            /** if the ogURL is set generate the tag and add it to the return string. */
            if(!is_null($this->ogURL))
            {
                $returnString .= sprintf('<meta property="og:url" content="%s">', $this->ogURL)."\r\n";
            }
            /** if the ogDescription is set generate the tag and add it to the return string. */
            if(!is_null($this->ogDescription))
            {
                $returnString .= sprintf('<meta property="og:description" content="%s">', $this->ogDescription)."\r\n";
            }
            /** if the ogImage is set generate it and add it to the return string. */
            if(!is_null($this->ogImage))
            {
                $returnString .= sprintf('<meta property="og:image" content="%s">', $this->ogImage)."\r\n";
            }
            /** if the faviconICO is set generate the tag and add it to the return string. */
            if(!is_null($this->faviconICO))
            {
                $returnString .= sprintf('<link rel="icon" href="%s">', $this->faviconICO)."\r\n";
            }
            /** if the faviconSVG is set generate the tag and add it to the return string. */
            if(!is_null($this->faviconSVG))
            {
                $returnString .= sprintf('<link rel="icon" href="%s" type="image/svg+xml">', $this->faviconSVG)."\r\n";
            }
            /** if the faviconPNG is set generate the tag and add it to the return string. */
            if(!is_null($this->faviconPNG))
            {
                $returnString .= sprintf('<link rel="apple-touch-icon" href="%s">', $this->faviconPNG)."\r\n";
            }
            /** Generate the style tags and append them to the return string.*/
            $returnString .= $this->GenerateStyleTags();
            /** Generate the script tags and append them to the return string. */
            $returnString .= $this->GenerateScriptTags(false);
            /** If we are provided gTag data add it to the head */
            if(!is_null($this->gTag))
            {
                $returnString .= $this->gTag;
            }
            /** If there is a facebook pixel set render it. */
            if(!is_null($this->facebookPixel))
            {
                $returnString .= $this->facebookPixel;
            }
            /** Return the return string after appending the ending head tag. */
            return $returnString."</head>\r\n";
        }

        /**
         * This will generate and return the html body as a string.
         * @return string
         */
        protected function GenerateHTMLBody(): string
        {
            $returnString = "<body";
            if(!is_null($this->bodyClass))
            {
                $returnString .= ' class="'.$this->bodyClass.'"';
            }
            $returnString .= ">\r\n";
            if(!is_null($this->bodyHTML))
            {
                $returnString .= $this->bodyHTML;
            }
            $returnString .= $this->GenerateScriptTags(true);
            return $returnString."\r\n</body>\r\n";
        }

        /**
         * This method will return the HTML end tags including the ending body tag.
         * @return string
         */
        protected function GenerateDocumentEnd(): string
        {
            return '</html>';
        }

        /**
         * Render will assemble the whole page and echo it.
         */
        public function Render(): void
        {
            echo $this->GenerateDocumentStart().
                $this->GenerateHTMLHead().
                $this->GenerateHTMLBody().
                $this->GenerateDocumentEnd();
        }

        /**
         * This method sets the page title.
         * @param string $title
         * @return $this
         */
        protected function SetTitle(string $title): PageBase
        {
            $this->title = $title;
            return $this;
        }

        /**
         * This method sets the page description.
         * @param string $description
         * @return $this
         */
        protected function SetDescription(string $description): PageBase
        {
            $this->description = $description;
            return $this;
        }

        /**
         * This method will set the page author.
         * @param string $author
         * @return $this
         */
        protected function SetAuthor(string $author): PageBase
        {
            $this->author = $author;
            return $this;
        }

        /**
         * This method will set the ogTitle value.
         * @param string $ogTitle
         * @return $this
         */
        protected function SetOgTitle(string $ogTitle): PageBase
        {
            $this->ogTitle = $ogTitle;
            return $this;
        }

        /**
         * This method will set the ogType value.
         * @param string $ogType
         * @return $this
         */
        protected function SetOgType(string $ogType): PageBase
        {
            return $this;
        }

        /**
         * This method sets the ogUrl value.
         * @param string $ogURL
         * @return $this
         */
        protected function SetOgURL(string $ogURL): PageBase
        {
            $this->ogURL = $ogURL;
            return $this;
        }

        /**
         * This method will set the OgDescription.
         * @param string $ogDescription
         * @return $this
         */
        protected function SetOgDescription(string $ogDescription): PageBase
        {
            $this->ogDescription = $ogDescription;
            return $this;
        }

        /**
         * This method will set the ogImage value.
         * @param string $ogImage
         * @return $this
         */
        protected function SetOgImage(string $ogImage): PageBase
        {
            $this->ogImage = $ogImage;
            return $this;
        }

        /**
         * This method will set the FaviconICO value.
         * @param string $faviconICO
         * @return $this
         */
        protected function SetFaviconICO(string $faviconICO):PageBase
        {
            $this->faviconICO = $faviconICO;
            return $this;
        }

        /**
         * This method will set the faviconSVG value.
         * @param string $faviconSVG
         * @return $this
         */
        protected function SetFaviconSVG(string $faviconSVG): PageBase
        {
            $this->faviconSVG = $faviconSVG;
            return $this;
        }

        /**
         * This method will set the faviconPNG value.
         * @param string $faviconPNG
         * @return $this
         */
        protected function SetFaviconPNG(string $faviconPNG): PageBase
        {
            $this->faviconPNG = $faviconPNG;
            return $this;
        }

        /**
         * Set the google analytics tag.
         * @param string $tagScript
         * @return $this
         */
        protected function SetGoogleAnalyticsTag(string $tagScript): PageBase
        {
            $this->gTag = $tagScript;
            return $this;
        }

        /**
         * This will set the facebook pixel code.
         * @param string $pixelCode
         * @return $this
         */
        protected function SetFacebookPixel(string $pixelCode): PageBase
        {
            $this->facebookPixel = $pixelCode;
            return $this;
        }

        /**
         * This method will take the style sheet uri passed and create a style sheet object and add it to the stack
         * of style sheets that need to be generated on render.
         * @param string $uri
         * @return $this
         */
        protected function AddStyleSheet(string $uri): PageBase
        {
            array_push($this->styleSheets, new StyleSheet($uri));
            return $this;
        }

        /**
         * This method generates all the style tags in the stack and returns the html string.
         * @return string
         */
        protected function GenerateStyleTags(): string
        {
            $returnString = "";
            foreach($this->styleSheets as $styleSheet)
            {
                $returnString .= $styleSheet->Generate()."\r\n";
            }
            return $returnString;
        }

        /**
         * This method takes in a script uri and a bool value then uses those to create a script tag object
         * and append it to the correct stack.
         * @param string $uri
         * @param bool $appendToBottom Are we appending to the start or end of the page?
         * @return $this
         */
        protected function AddScript(string $uri, bool $appendToBottom = false): PageBase
        {
            if($appendToBottom)
            {
                array_push($this->bottomScripts, new ScriptTag($uri));
                return $this;
            }
            array_push($this->topScripts, new ScriptTag($uri));
            return $this;
        }

        /**
         * This method will generate the html script tags for the top or bottom of the page.
         * @param bool $generateBottom
         * @return string
         */
        protected function GenerateScriptTags(bool $generateBottom = false): string
        {
            $returnString = "";
            $targetArray = $generateBottom ? $this->bottomScripts : $this->topScripts;
            foreach($targetArray as $script)
            {
                $returnString .= $script->Generate()."\r\n";
            }
            return $returnString;
        }

        /**
         * This function takes in new body html content and saves it to the bodyHTML parameter.
         * @param string $bodyHTML
         * @return $this
         */
        protected function SetBodyHTML(string $bodyHTML): PageBase
        {
            $this->bodyHTML = $bodyHTML;
            return $this;
        }

        /**
         * This will set the body class
         * @param string $bodyClass
         * @return $this
         */
        protected function SetBodyClass(string $bodyClass): PageBase
        {
            $this->bodyClass = $bodyClass;
            return $this;
        }
    }
}
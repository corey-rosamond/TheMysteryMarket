<?php
/**
 * This is the frontEnd page namespace.
 */
namespace TheMysteryMarket\Page\FrontEnd
{
    /** Include the PageBase class file and namespace. */
    require_once("Page/Object/PageBase.class.php");
    use TheMysteryMarket\Page\Object\PageBase;

    /**
     * This is the Front End base class. This is where we define functions specific to the front end.
     */
    abstract class FrontEndBase extends PageBase
    {
        private const LightLogo = 'Image/Front-End/logo.svg';
        private const DarkLogo = 'Image/Front-End/logo.svg';
        private const LogoAltText = 'The Mystery Market Logo';
        private const PhoneNumber = '(928) 583-2032';
        /**
         * Base constructor setting some default values for all the frontend.
         */
        public function __construct()
        {
            $this
                /** Favicons */
                ->SetFaviconPNG("Image/Front-End/favicon.png")
                ->SetFaviconICO("Image/Front-End/favicon.png")
                /** Style Sheets */
                ->AddStyleSheet('Asset/fonts/fonts.min.css')
                ->AddStyleSheet('Asset/plugins/font-awesome/font-awesome.min.css')
                ->AddStyleSheet('Asset/plugins/jquery-ui/jquery-ui.min.css')
                ->AddStyleSheet('Asset/plugins/jquery-ui/timepicker.min.css')
                ->AddStyleSheet('Asset/plugins/bootstrap/bootstrap.min.css')
                ->AddStyleSheet('Asset/css/style.css')
                /** Script files */
                ->AddScript("Asset/plugins/jquery/jquery.min.js", true)
                ->AddScript('Asset/plugins/bootstrap/bootstrap.min.js', true)
                ->AddScript('Asset/plugins/validate/validate.min.js', true)
                ->AddScript("Asset/plugins/jquery-ui/jquery-ui.min.js", true)
                ->AddScript("Asset/plugins/jquery-ui/timepicker.min.js", true)
                ->AddScript("Asset/js/main.js", true)
                /** Page Details */
                ->SetAuthor('Corey Rosamond')
                ->SetOgType('website');
            if(explode('.', $_SERVER['HTTP_HOST'])[0]!='development')
            {
                $this->SetGoogleAnalyticsTag('
                    <!-- Global site tag (gtag.js) - Google Analytics -->
                    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1PD7Z1HQ7K"></script>
                    <script>
                      window.dataLayer = window.dataLayer || [];
                      function gtag(){dataLayer.push(arguments);}
                      gtag(\'js\', new Date());
                      gtag(\'config\', \'G-1PD7Z1HQ7K\');
                    </script>
                ')->SetFacebookPixel("
                    <!-- Facebook Pixel Code -->
                    <script>
                    !function(f,b,e,v,n,t,s)
                    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                    n.queue=[];t=b.createElement(e);t.async=!0;
                    t.src=v;s=b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t,s)}(window, document,'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                    fbq('init', '380149556935664');
                    fbq('track', 'PageView');
                    </script>
                    <noscript><img height=\"1\" width=\"1\" style=\"display:none\"
                    src=\"https://www.facebook.com/tr?id=380149556935664&ev=PageView&noscript=1\"
                    /></noscript>
                    <!-- End Facebook Pixel Code -->
                ");
            }
        }


        protected function GenerateHeader(): string
        {
            return '
            <header class="fixed-top bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="inner-container d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between">
                                <a class="navbar-brand" href="index.php">
                                    <img src="'.self::LightLogo.'" alt="'.self::LogoAltText.'" class="img-fluid" style="max-width: 250px;width:250px;">
                                </a>
                                <p class="mb-0 mt-2 mt-md-0 text-center text-md-right">
                                    <span class="font-weight-bold text-blue">CALL TODAY:</span> '.self::PhoneNumber.'
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>';
        }

        protected function GenerateFooter(): string
        {
            return '
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <div class="logo mx-auto mb-3">
                                <img src="'.self::DarkLogo.'" alt="'.self::LogoAltText.'" class="img-fluid" style="max-width: 250px;width:250px;margin-left:-35px;">
                            </div>
                            <p>NEED HELP? | We\'re available by phone, text, and chat Monday-Friday, 9 a.m. - 5 p.m. PST. <br /><i class="fa fa-envelope" aria-hidden="true"></i>  <a href="mailto: support@themysterymarket.com">support@themysterymarket.com</a>&nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa fa-phone-square" aria-hidden="true"></i>  '.self::PhoneNumber.'   &nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i> 9am-5pm</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="index.php?page=PrivacyPolicy" class="text-white">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="index.php?page=TermsAndConditions" class="text-white">Terms & Conditions</a></li>
                            </ul>
                            <p>© Copyright 2021 TheMysteryMarket.com - All rights reserved</p>
                        </div>
                    </div>
                </div>
            </footer>';
        }

    }
}

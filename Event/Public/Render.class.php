<?php
/**
 * This is the base event namespace.
 */
namespace TheMysteryMarket\Event
{
    /** Use the Event Interface namespace. */
    use TheMysteryMarket\Interfaces\Event;
    /** Use the warning exception namespace */
    use TheMysteryMarket\Exception\WarningException;

    /**
     * Render Event
     */
    class Render implements Event
    {
        /**
         * Run finds the correct page to render and renders it.
         * @todo add support for an error page.
         */
        public function run(array $data = [])
        {
            $requestedPage = $this->RequestedPage($data);
            try{
                /** Suppress the fatal error that php tries to product so we can catch the exception and handle it. */
                include_once(
                    sprintf(
                        '%s%s.page.php',
                        PAGE_LOCATION,
                        $requestedPage
                    )
                );
            }/** Catch the warning exception if the file does not exist. */
            catch (WarningException $exception){
                /** Swap the requested page to the 404 page and include it. */
                $requestedPage = FOUR_ZERO_FOUR;
                include_once(
                    sprintf(
                        '%s%s.page.php',
                        PAGE_LOCATION,
                        $requestedPage
                    )
                );
            }
            $pageClassName = PAGE_NAMESPACE.$requestedPage;
            /** Construct the page to render then render it. */
            (new $pageClassName($data))->Render();
        }

        /**
         * This method determines what to set the requested page as.
         * @param array $data
         * @return string
         */
        private function RequestedPage(array $data): string
        {
            if(array_key_exists('page', $data) && $data['page'] != "")
            {
                return $data['page'];
            }
            if(array_key_exists('page', $_GET) && $_GET['page'] != "")
            {
                return $_GET['page'];
            }
            return HOME_PAGE;
        }
    }
}
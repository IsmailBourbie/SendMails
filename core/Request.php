<?php
namespace Core;
Class Request {
    

    /**
     * get the requested url removing the last '/'
     * @static
     * @return string
     */
    public static function url() {
        $url = rtrim($_SERVER['QUERY_STRING'], '/');

        return self::removeQueryStringVar($url);
    }


    /**
     * Remove QueryString Variables from the url
     *  e.g www.site.com/users/add?u=1 => www.site.com/users/add
     * @static
     * @param string $url
     * @return string
     */
    private static function removeQueryStringVar($url) {
        if($url != '') {
            $parts = explode('&', $url, 2);
            if(strpos($parts[0], "=") === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }

    /**
     * get the type of the request method
     * @static
     * @return string
     */
    public static function method() {
        return $_SERVER['REQUEST_METHOD'];
    }

}
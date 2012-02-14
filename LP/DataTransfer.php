<?php

/**
 * Safely retrieve urls and submits posts
 * 
 * On some system, url_fopen is disabled, in which case file_get_contents() will
 * fail. To prevent this error, curl can be used. This class automatically determines
 * system configuration and chooses the best methods if available.
 * 
 * @category    LP
 * @package     LP
 * @subpackage  DataTransfer
 * @version     Release: 2
 * @since       Class available since Release 1.0
 * @author      Benjamin Sommer <developer@benjaminsommer.com>
 * @uses        Nb_Error, curl, file_get_contents
 */
class LP_DataTransfer {

    /**
     * Initialize a data transfer
     *
     * @param  string   $url    The url to connect to
     */
    public function __construct($url) {
        $this->url = $url;
    }

    /**
     * Retrive header and content of a given URL.
     * 
     * This method either requires curl or fopen wrappers.
     * 
     * @return bool     Whether retrieval was successful
     */
    public function retrieveUrl() {
        if (function_exists('curl_init')) {
            $ch = curl_init();
            $options = array(
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true, // return web page
                CURLOPT_HEADER => false, // don't return headers
                CURLOPT_FOLLOWLOCATION => true, // follow redirects
                CURLOPT_ENCODING => "", // handle all encodings
                CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'], // who am i
                CURLOPT_AUTOREFERER => true, // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
                CURLOPT_TIMEOUT => 120, // timeout on response
                CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
            );
            curl_setopt_array($ch, $options);
            $data = curl_exec($ch);
            $this->info = curl_getinfo($ch);
            $errno = curl_errno($ch);
            $error = curl_error($ch);
            if (!empty($errno))
                LP_Error::push($error, $errno);
            curl_close($ch);
            $this->response = $data;
            return empty($errno) && empty($error);
        } else if (ini_get('allow_url_fopen') == '1') {
            $this->response = @file_get_contents($url);
            return true;
        }
        LP_Error::push('Failed to retrieve url due to limited system configuration', 404);
        return false;
    }

    /**
     * Submit post safely either with curl or fopen-wrappers.
     * 
     * @param mixed     $fields     The post attributes and their values
     * @return bool                 If submission was successful
     */
    public function submit($fields) {
        if (is_array($fields))
            $fields = http_build_query($fields);

        if (function_exists('curl_init')) {
            $ch = curl_init();
            $options = array(
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $fields,
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true, // return web page
                CURLOPT_HEADER => false, // don't return headers
                //CURLOPT_FOLLOWLOCATION => true,     // follow redirects
                //CURLOPT_ENCODING       => "",       // handle all encodings
                CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'], // who am i
                //CURLOPT_AUTOREFERER    => true,     // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
                CURLOPT_TIMEOUT => 120, // timeout on response
                    //CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            );
            curl_setopt_array($ch, $options);
            $data = curl_exec($ch);
            $this->info = curl_getinfo($ch);
            $errno = curl_errno($ch);
            $error = curl_error($ch);
            if (!empty($errno))
                LP_Error::push($error, $errno);
            curl_close($ch);
            $this->response = $data;
            return $errno == 0;
        } else if (ini_get('allow_url_fopen') == '1') {
            $context = stream_context_create(
                    array('http' => array(
                            'method' => "POST",
                            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                            'content' => $fields,
                        )
                    )
            );
            $r = @fopen($url, "r", null, $context);
            if ($r) {
                $this->response = stream_get_contents($r);
                fclose($r);
                return true;
            }
            return false;
        }
        LP_Error::push('Failed to submit post due to limited system configuration', 404);
        return false;
    }

    /**
     * Get the url to connect to
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Get the response from given url
     * @return string
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * Get an array of infos about last retrieval / connection
     * 
     * Details at: http://php.net/manual/en/function.curl-getinfo.php
     * 
     * @return array 
     */
    public function getInfo() {
        return $this->info;
    }

    private $url;
    private $response;
    private $info = array();

}

?>
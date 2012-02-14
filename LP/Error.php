<?php

/*
 * Set and get last error
 * 
 * Static methods of this class are used by any package/subpackage whenever
 * to communicate detailed error messages to other functions. It is an addition
 * to returning boolean values from methods/functions indicating state of success.
 * 
 * Detailed messages are very useful to trace errors back or to act accordingly. They
 * can by used for user feedback. Note that exceptions should not be triggered if
 * the user is the source of the error.
 * 
 * @category    LP
 * @package     LP
 * @subpackage  Error
 * @version     Release: 2.10
 * @since       Class available since Release 1.0
 * @author      Benjamin Sommer <developer@benjaminsommer.com>
 */

class LP_Error {

    /**
     * Set the current error state and overwrite the last error
     *
     * @param int       $errno      An unique error identifier
     * @param string    $message      The error message to be read by the user
     */
    public static function push($message, $errno=400) {
        $t['errno'] = $errno;
        $t['message'] = $message;
        self::$errs[] = (object) $t;
    }

    /**
     * Get the detailed error message with error number
     *
     * @return string   Error message 
     */
    public static function getLastError() {
        return end(self::$errs);
    }

    /**
     * Get the detailed error message with error number
     *
     * @return object   Last Error with ->error and ->errno
     */
    public static function popLastError() {
        return array_pop(self::$errs);
    }

    /**
     * If the error stack is not empty, so if it contains at least one error
     *
     * @return bool
     */
    public static function hasError() {
        return sizeof(self::$errs) > 0;
    }

    public static function printStack($ln=PHP_EOL) {
        foreach (self::$errs as $o)
            echo "Error {$o->errno}: {$o->message}." . $ln;
    }

    /**
     * Clear the current error state
     */
    public static function clear() {
        self::$errs = array();
    }

    private static $errs = array();

}

?>

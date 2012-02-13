<?php

require LP_API . '/Error.php';
require LP_API . '/Fragment.php';


/**
 * Initialize LPPress (literate programming for wordpress)
 *
 * @category    LP
 * @package     LP
 * @subpackage  LP_Init
 * @version     Release: 1.0
 * @since       Class available since Release 1.0
 * @author      Benjamin Sommer <developer@benjaminsommer.com>
 */
class LP_Init {

    /**
     * Initialize Netblog and its activated modules
     */
    public static function exec() {
        // TODO
    }

    /**
     * Register UI elements and js scripts for the admin panel
     */
    public static function initAdminPanel() {
        $version = get_option('LP_VERSION');
        if ($version === false) {
            self::on_install();
        } else if ($version != self::getVersion())
            self::on_update();
    }

    /**
     * Set up tables, add options, etc. - All preparation that only needs to be done once
     */
    public static function activate() {
        self::executeCLAction('activate');
    }

    /**
     * Do nothing like removing settings, etc. 
     * The user could reactivate the plugin and wants everything in the state before activation.
     * Take a constant to remove everything, so you can develop & test easier.
     */
    public static function deactivate() {
        self::executeCLAction('deactivate');
    }

    /**
     * Any operation required in case of an update
     */
    public static function update() {
        update_option('LP_VERSION', self::getVersion());
        self::executeCLAction('update');
    }

    /**
     * Remove/Delete everything - If the user wants to uninstall, then he wants the state of origin.
     */
    public static function uninstall() {
        if (__FILE__ != WP_UNINSTALL_PLUGIN)
            return;
        delete_option('LP_VERSION');
        self::executeCLAction('uninstall');
    }

    /**
     * Sets up database if this plugin is installed.
     */
    public static function install() {
        add_option('LP_VERSION', self::getVersion());
        self::executeCLAction('install');
    }

    /**
     * Execute the CLAction
     * @param string $action 
     */
    private static function executeCLAction($action) {
        require LP_API . '/DataTransfer.php';
        $transfer = new LP_DataTransfer(self::getCLActionURL());
        $param = array('clversion' => self::getVersion(), 'clname' => 'lppress', 'claction' => $action);
        $transfer->submit($param);
    }

    public static function resetModule($packageDir) {
        // TODO
        return true;
    }
    
    /**
     * Get the url to the CLAction server to protocol updates and installs.
     * @return URL
     */
    public static function getCLActionURL() {
        return 'http://cs.benjaminsommer.com/claction/claction.php';
    }
    
    /**
     * Get the current version
     * @return string
     */
    public static function getVersion() {
        return '1.0.0';
    }

    /**
     * Get the current release
     * @return string
     */
    public static function getRelease() {
        return '1.0';
    }

}

function LP_Assert($bool, $message) {
    if ($bool)
        echo "<font color=\"red\">$message</font>";
}

function LP_GetLines($string) {
    //return explode( 13, $string);
    return preg_split("/((\r?\n)|(\r\n?))/", $string);
    //return explode(PHP_EOL, $string);
    //return explode('<br />',nl2br($string));
    //return explode(array("\r\n", "\n", "\r"), $string); 
}
?>

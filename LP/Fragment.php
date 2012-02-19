<?php

/**
 * Handle fragments from literate programming (fragment definition and declaration).
 *
 * @category    LP
 * @package     LP
 * @subpackage  LP_Fragment
 * @version     Release: 1.2
 * @since       Class available since Release 1.0
 * @author      Benjamin Sommer <developer@benjaminsommer.com>
 */
class LP_Fragment {

    public static function doShortcode($atts, $content) {
        if (empty($content)) {
            if (in_array('ref', $atts))
                return self::referenceShortcode($atts, $content);
            return self::definitionShortcode($atts, $content);
        }
        $id = get_the_ID();
        LP_Assert(!isset(self::$fragments[$id][$atts['name']]) && !in_array('root', $atts), "Missing Fragment Definition &#9001;{$atts['name']}&#9002;. ");
        $fragment = &self::$fragments[$id][$atts['name']];
        $content = do_shortcode($content);
        $operator = isset($fragment['content']) ? '+&equiv;' : '&equiv;';
        $ret = "<pre><span style=\"color:blue\">&#9001;<em><b>{$atts['name']}</b></em>&#9002;</span> $operator ";
        $lines = LP_GetLines(($content));

        foreach ($lines as $k => $line) {
            if (!empty($line))
                break;
            unset($lines[$k]);
        }
        for ($i = sizeof($lines) - 1; $i >= 0; $i--) {
            if (!empty($lines[$i]))
                break;
            unset($lines[$i]);
        }

        $tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
        foreach ($lines as $k => $line)
            $ret .= "$tab$line";
        $ret .= '</pre>';
        $fragment['content'] .= $content;
        return $ret;
    }

    public static function definitionShortcode($atts, $content) {
        $id = get_the_ID();
        LP_Assert(!isset($atts['name']) || empty($atts['name']), "Missing Fragment Name in new definition.");
        LP_Assert(isset(self::$fragments[$id][$atts['name']]), "Fragment &#9001;{$atts['name']}&#9002; already defined.");
        self::$fragments[$id][$atts['name']] = array();
        return "<span style=\"color:blue\">&#9001;<em>{$atts['name']}</em>&#9002;</span>";
    }

    public static function referenceShortcode($atts, $content) {
        $id = get_the_ID();
        LP_Assert(!isset(self::$fragments[$id][$atts['name']]), "Missing Fragment Definition &#9001;{$atts['name']}&#9002;. ");
        return "<code>&#0139;{$atts['name']}&#9002;</code>";
    }

    private static $fragments = array();

}

add_shortcode('fragment', 'LP_Fragment::doShortcode');
add_shortcode('fragment_def', 'LP_Fragment::definitionShortcode');
add_shortcode('fragment_ref', 'LP_Fragment::referenceShortcode');
add_filter('comment_text', 'do_shortcode');
?>

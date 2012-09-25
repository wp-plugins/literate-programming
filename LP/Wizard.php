<?php

class LP_Wizard {
	public static function init() {
		$types = get_post_types(array('public'=>true));
		foreach ($types as $t)
			add_meta_box('lpp-wizard', 'Literate Programming Shortcodes', array(new LP_Wizard(),'display'), $t, 'side');
	}
	
	public function display() {
		echo '<p><strong>Define Fragment</strong>';
		echo '<input type="text" value="[fragment name=&quot;UNIQUE_NAME&quot;]DEFINITION[/fragment]" style="width:100%" /></p>';
		
		echo '<p><strong>Insert Fragment (Reference)</strong>';
		echo '<input type="text" value="[fragment name=&quot;UNIQUE_NAME&quot;/]" style="width:100%" /></p>';
	}
}
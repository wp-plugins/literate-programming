=== Plugin Name ===
Contributors: BenjaminSommer
Donate link: http://benjaminsommer.com/donate.php
Tags: literate programming, fragments, source code publishing
Requires at least: 2.8
Tested up to: 3.3.1
Stable tag: 1.0

Gradually introduce and explain source code fragments to state your thoughts clearly and explicitly.

== Description ==

This plugin brings literate programming to WordPress. Use it to `clearly and explicitly 
state the thoughts behind your published programs`, key algorithms and complex code snippets. 

Authors can `better restart their own thought processes` at any later time, and other programmers 
can `understand the construction` of the program more easily. 

Readers of your posts don't have to decipher the thought process behind the program from the code and
its associated comments. 

Source code can be gradually implemented and explained, without the need to repeatedly refer to one complete source code.

**Other advantages**:

* Very lightweight plugin
* Internationalization supported
* Strict Compliance to Zend Frameworks Coding Standard suggestions/guidelines


This is the first published version. Any ideas for new features and improvements are greatly welcomed! 

Some introductions, tutorials, posts about this plugin and literate programming in general 
can be found on my personal weblog.


== Installation ==

Use WordPress integrated installation. No additional dependencies required.

== Frequently Asked Questions ==

= How to define a fragment? =

Use WP shortcodes for that: `[fragment_def name="unique fragment name" /]`. In normal cases, this should be placed within a parent fragment: `[fragment name="parent fragment"] ... [fragment_def name="sub fragment" /] ... [/fragment]`. 

= How do I add implementations to fragments? =

Just the the shortcode 

`[fragment name="unique fragment name"]
//add implementation here
[/fragment]` 

You can add implementations step by step by repeatedly using this fragment with the same name. The plugin
does the rest.

= I got the error message: no fragment definition <...> found! =

The first and thus root fragment cannot have a definition, thus define it as root and the message will disappear: `[fragment name="unique fragment name" root]`.

= Do I really need fragment_def? =

Well, yes and no. Officially, nested shortcodes having the same name is not recommended/supported according to WordPress.org. But you use `fragment` instead of `fragment_def` - it worked on my system.

== Screenshots ==

No screenshots available - maybe when I provides a UI.

== Upgrade Notice ==

No upgrade notices available - it should work just fine.

== Changelog ==

= 1.0 =
* Added class LP_Fragment
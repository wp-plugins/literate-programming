=== Plugin Name ===
Contributors: BenjaminSommer
Donate link: http://benjaminsommer.com/donate.php
Tags: literate programming, fragments, source code publishing, prototypes, snippets, source code, algorithm, pseudocode
Requires at least: 2.8
Tested up to: 3.5
Stable tag: 1.3

Introduce and explain source code, prototypes, pseudocodes, fragments, snippets. Easily demonstrate, presentate and explain algorithms and their ideas.

== Description ==

This plugin brings literate programming to WordPress. Use it to `clearly and explicitly 
state the thoughts behind your published programs`, key algorithms and complex code snippets. 

Authors can `better restart their own thought processes` at any later time, and other programmers 
can `understand the construction` of the program more easily. 

Readers of your posts don't have to decipher the thought process behind the program from the code and
its associated comments. 

Source code can be gradually implemented and explained, without the need to repeatedly refer to one complete source code.

**Features**:

* Automatically format nested fragments, so you can concentrate on key algorithms and their presentations (or explanations)
* Very lightweight plugin
* Internationalization supported
* Strict Compliance to Zend Frameworks Coding Standard suggestions/guidelines

**Future Work**:

* Interactive source code editor to create fragments from standard source code. Simply paste in source code and mark sections to create fragments with unique names. Use these names when writing WordPress posts, pages, comments.
* Automatically create complete source code listings from previously defined fragments at the end of posts or pages. 

[Introductions, tutorials, posts about this plugin](http://weblog.benjaminsommer.com/projects/literate-programming/ "Tutorials, Introductions, Posts") and literate programming in general can be found on my personal weblog.


== Installation ==

Use WordPress integrated installation. No additional dependencies required.

== Frequently Asked Questions ==

= How to define a fragment? =

Use WP shortcodes for that: `[fragment name="unique fragment name" /]`. In normal cases, this should be placed within a parent fragment: 

`[fragment name="implemented parent fragment name"] 
... 
[fragment name="define new fragment" /] 
...
[/fragment]`

= How do I add implementations to fragments? =

Just the the shortcode 

`[fragment name="define new fragment"]
//add implementation here
[/fragment]` 

You can add implementations step by step by repeatedly using this fragment with the same name. The plugin
does the rest.

= Can I reference fragment names just within my text? =

Yes. Just type `[fragment name="your_fragment_name"/]` into your WordPress editor.


= Do I really need fragment_def? =

Well, yes and no. Officially, nested shortcodes having the same name is not recommended/supported according to WordPress.org. But you use `fragment` instead of `fragment_def` - it worked on my system.

== Upgrade Notice ==

No upgrade notices available - it should work just fine.

== Changelog ==

= 1.3 =
* Added Wizard
* Improved Shortcode handling
* No warnings are displayed (silent working)
* Compatibility to WordPress 3.5

= 1.2 =
* Added support for comments: Fragments can now be defined and referenced in comments so that the user or editor of comments can better refer to post contents.
* Updated readme.txt

= 1.1 =
* Updated LP_Fragment: `[fragment name="" ref /]` may be used as a shortcut for `[fragment_ref name="" /]`
* Changed enclosing fragment characters from smaller/greater to bra/ket characters.
* Changed equal character to identical character when implementing fragments to increase readability.

= 1.0 =
* Added class LP_Fragment

=== Try Ninja Demo ===
Contributors: sdavis2702
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=52HQDSEUA542S
Tags: ninja demo, demo site, plugins, themes, widget, sdavis2702
Requires at least: 3.8
Tested up to: 4.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display the Ninja Demo entry form with a widget.

== Description ==

Intended for use with [Ninja Demo](http://ninjademo.com/), this simple plugin adds a new widget that automatically outputs the demo entry form and allows you to specify the text to display based on whether or not a user is inside of the demo.

Follow Try Ninja Demo's development on [Github](https://github.com/sdavis2702/try-ninja-demo)

== Installation ==

1. Upload `try-ninja-demo` to the `/wp-content/plugins/` directory
2. Network Activate the plugin through the Network Admin 'Plugins' menu in WordPress
3. Visit the dashboard -> Appearance -> Widgets page to use the "Try Ninja Demo" widget.

== Frequently Asked Questions ==

= Do I have to use Ninja Demo to use this plugin? =

Yes. This plugin will not create the widget if Ninja Demo is not activated.

= What does "Network Activate" mean in the installation instructions? =

Ninja Demo runs on WordPress Multisite in a network configuration. Each demo user actually creates their own instance of the main network site every time they log into the demo. By network activating this plugin, you make it available to each [demo] site in the network.

= How do I output the demo entry form? =

All you have to do is use the widget. When the user is not inside of the demo, the entry form will display just below the content you place in the widget. When the user is inside of the demo, your previous content and entry form will both be replaced by the content you place in the widget for users who are inside of the demo.

= Can I style the widget? =

Certainly. Use the following CSS classes.

`.try-ninja-demo-widget`
Wraps the entire widget output
`.tnd-widget`
Wraps all content below the widget title
`.tnd-widget-content`
Wraps all content you place inside of either textarea
`.tnd-not-in-demo`
Wraps only the content that displays if the user is not in the demo
`.tnd-in-demo`
Wraps only the content that displays if the user is in the demo
`.nd-start-demo`
(Ninja Demo) Wraps the form question and submit

== Screenshots ==

1. widget preview
2. user NOT inside the demo
3. user inside the demo

== Changelog ==

= 1.0.0 =
* first stable version
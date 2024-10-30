=== BW Facebook Feed ===
Contributors:bluwebzwp, nealmegh, ahsanulkabir
Tags: facebook feed, facebook posts, Social Feed, Facebook Feed, Feed, social feed
Requires at least: 3.3
Tested up to: 4.7
Stable tag: 1.0.5

A simple way to show facebook feed in your website!

== Description ==
Facebook feed plugin is the flexible and customizable process to show your Facebook feed on your website. You can add as many posts as you want from your facebook page, simply by using this plugin.
“bw-facebook-feed” is the very simple plugin to show your Facebook feed on your website. Widget ready, so you can show Facebook feed on your sidebars too. This plugin adds a short code and a widget to your WordPress website. It will help you gain more followers on Facebook driven from your website. It will also increase your website traffic, as people will get all the recent information from one page. So if you happened to own a website and Facebook page, then this plugin is the right choice for you to gain more traffic in your website as well as Facebook page.

= Features = 
 * Set number of posts you want to show
 * Set post length
 * Shortcode option for styling multiple facebook contents in various ways
 * Mobile optimized and completely responsive
 * Facebook feed content is crawlable
 * Simple process just enter your facebook page ID and it’s done
 * You can show not only text of your Facebook post but also the photo through this “bw-facebook-feed” plugin
 
= Shortcode = 
[bwfbfeed]
== Installation ==

Step 1. Upload “bw-facebook-feed” folder to the /wp-content/plugins/ directory

Step 2. Activate the plugin through the Plugins menu in WordPress

Step 3. Go to Settings/"BW Facebook Feed" and configure the plugin settings.

Step 4. Use the shortcode “[bwfbfeed]” in your page, post or widget to display your feed.

== Frequently Asked Questions ==
= 1. What is the installation process?  =

1. You can install the BW Facebook Feed by uploading the files to your web server or using the WordPress plugin directory.
2. You can enable the plugin in WordPress using the plugin menu.
3. To configure your feed you can go to ‘Settings-> BW Facebook Feed’ settings page.
4. You can display your feed by using the shortcode “[bwfbfeed]” in your page, post or widget.


= 2. How do I find the Page ID of my Facebook page? =

If you have a Facebook page with a URL like this:
https://www.facebook.com/bluwebz then the Page ID is just bluwebz.
If your page URL like this:
https://www.facebook.com/bluwebz/123456789101112  then the page ID is actually the number at the end, so in this case it’s 123456789101112.

If your page URL is like this:
https://www.facebook.com/bluwebz-123456789101112 then the page ID is also will be the number at the end, so it will be 123456789101112.


= 3. How to get Facebook app secret? =

First of all you have to create a Facebook app from developer account, then go to the dashboard of the app and there will be a text field named ‘App Secret’. Click on show button copy the code and paste it on the app secret option in the settings page and save it.

= 4. Are there any limitations on which Facebook page feeds I can display? =

Your page must have to be public if you want to display the Facebook feed. You will not be able to display any feeds from personal Facebook profile or private Facebook page. This is one of the Facebook’s privacy policy. You can’t display a private Facebook feed publicly.
If you want to display the Facebook feed you must have to check that your page is public or not. To find that out you can log out from Facebook and try to visit your page. If you can do that it’s public if not and you have to sign in to visit than it’s private. So for people to see your page have to log into Facebook  and people who don’t have Facebook account won’t be able to see it.   Maybe your page has some kind of restrictions on it so people need to log into Facebook. To solve this problem you can go to your Facebook page settings and simply remove any location or age restrictions you have on it. After that it will allow BW Facebook feed plugin to access and display your feed.
= 5. Can I show PHOTOS in my BW Facebook feed? =

This free plugin just not only allow you to display text from your Facebook feeds but also allows you to display photos from your post. So yeah you can show photos from your Facebook posts.
= 6. Is the content of my BW Facebook Feed crawlable by search engines? =

Yes, off course. Most of the Facebook plugins which use iframes are not crawlable by search engines they show Facebook feed into your page after it’s loaded. The BW Face book feed uses PHP to insert your Facebook feed posts directly into your page. Which adds zestful, search engine crawlable content to your website.

= 7. How do I embed the BW Facebook Feed directly into a WordPress page template? =

You can use the WordPress do_shortcode function: <? php echo do_shortcode (“[bwfbfeed]”) ; ?> for embedding the BW Facebook Feed directly into a WordPress  page template. 
= 8. Why my Facebook feed posts are not showing up? =

We are always here to support you for this kind of problem. But there are some common facts which occurs this problem, where your Facebook feeds do not show up. So in that case please go through the following checks:
You are using a personal profile: The main reason could be this that you are trying to display your personal profile post. Which is not possible due to Facebook’s privacy policy. You can’t show personal Facebook profiles post publically. So if you won a business, organization or something else, then we recommend to convert your personal Facebook profile to a public page. Then you will be able to take the advantage of BW Facebook feed plugin and you will be able to display your posts.
You are trying to display posts from the Facebook page that has restrictions on it: If your Facebook page have any kind of restrictions like age or location then users have to sign into Facebook to view your page. Which is not sensible, cause many people don’t have Facebook account so they will not be able to see your posts. So go to your Facebook page settings and check if there is any restrictions if so remove them. It will allow BW Facebook feed plugin to access and display your feeds.
If you are using your own Facebook Access Token check it if it’s valid or not. You can solve it simply by just using this plugin’s build in access token cause you don’t really need to use your own access token.
Maybe you have entered wrong Page ID. So check it carefully.
Maybe there are no recent posts in your Facebook page or the posts you have are old. Therefore, it might not show up. Try to post new things in your Facebook page and check if the posts are displaying in your website’s Facebook Feed.
Check if there are any problem while installing the plugin. 
Check if there is any server configuration issue.

= 9. My Facebook feed appears to have stopped updating / working =

If your recent Facebook posts aren’t showing, then a possible reason can be your recent Facebook posts are shared from a personal Facebook profile. Due to Facebook’s privacy policy you can’t display anything in your feed which are share from personal Facebook profiles or from outside, Which doesn’t belong to your page technically. It’s not a limitation of our plugin it is Facebook’s privacy policy. So to overcome this problem you just repost the content in your Facebook page instead of sharing. Then you will be able to show the post in your website’s Facebook feed.

== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png

== Changelog == 


= 1.0.0 = 
 * First stable release



= 1.0.1 =
 * Set default app id and app secret. Shortcode shown in settings page.

= 1.0.2 =
 * Fix a bug
= 1.0.2.0 =
 * Fix a bug
= 1.0.2.1 =
 * Fix a bug
= 1.0.2.2 =
 * Default values updated
= 1.0.2.3 =
 * Default values updated
= 1.0.2.4 =
 * Design fixed
= 1.0.2.5 =
 * Design fixed
= 1.0.2.6 =
 * Design fixed
= 1.0.3 =
 * Design fixed and backend modified
= 1.0.4 =
 * Documentation changes
= 1.0.5 =
 * fix issues
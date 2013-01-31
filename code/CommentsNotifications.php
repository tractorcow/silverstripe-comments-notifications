<?php

/**
 * Bootstrapping / configuration class for comments notification
 *
 * @author Damo
 */
class CommentsNotifications {
	
	public static function configure_siteconfig() {
		return Config::inst()->get('CommentsNotifications', 'recipient') === 'SiteConfig';
	}
	
	public static function configure_page() {
		return Config::inst()->get('CommentsNotifications', 'recipient') === 'Page';
	}
	
	/**
	 * Returns the email address that should be notified of comments to the given page
	 * 
	 * @param DataObject $parent Parent object
	 * @return string Email address, if available
	 */
	public static function get_recipient($parent) {
		$recipient = Config::inst()->get('CommentsNotifications', 'recipient');
		switch($recipient) {
			case 'Disabled': return null;
			case 'SiteConfig': return SiteConfig::current_site_config()->CommentNotificationEmail;
			case 'Page': return $parent->CommentNotificationEmail;
			case 'Admin': return Email::getAdminEmail();
			default: return $recipient;
		}
	}
}
<?php

/**
 * Bootstrapping / configuration class for comments notification
 *
 * @author Damo
 */
class CommentsNotifications {
	
	/**
	 * Flag indicating whether or not to autoload this module with its 
	 * required extensions
	 * 
	 * @var boolean
	 */
	public static $enabled = true;
	
	/**
	 * Determine the recipient of the notification emails. One of:
	 * <ul>
	 *   <li>SiteConfig - Set email in SiteConfig</li>
	 *   <li>Page - Set email per page</li>
	 *   <li>Disabled - No emails</li>
	 *   <li>Admin - Use admin email</li>
	 *   <li>An email address - Hard coded value</li>
	 * </ul>
	 * 
	 * @var string 
	 */
	public static $recipient = 'SiteConfig';
	// Probably could put this into yaml config files, but the manifest isn't
	// loaded at the correct time.
	
	/**
	 * Flag indicating whether we should notify the user only of unmoderated 
	 * entries, or all entries.
	 * 
	 * @var boolean
	 */
	public static $only_unmoderated = false;
	
	public static $email_template = 'CommentNotificationsEmail';
	
	public static $email_sender = 'noreply@silverstripe.org';
	
	public static $email_subject = 'New comment notification';
	
	public static function init() {
		if(!self::$enabled) return;
		
		if(!class_exists('CommentingController')) {
			user_error('Please install the comments module - https://github.com/silverstripe/silverstripe-comments', E_USER_ERROR);
		}
		
		CommentingController::add_extension('CommentingControllerNotificationsExtension');
		
		switch(self::$recipient) {
			case 'SiteConfig':
				SiteConfig::add_extension('CommentsNotificationsExtension');
				SiteConfig::add_extension('SiteConfigCommentsNotificationsExtension');
				break;
			case 'Page':
				Page::add_extension('CommentsNotificationsExtension');
				Page::add_extension('PageCommentsNotificationsExtension');
				break;
		}
	}
	
	/**
	 * Returns the email address that should be notified of comments to the given page
	 * 
	 * @param DataObject $parent Parent object
	 * @return string Email address, if available
	 */
	public static function get_recipient($parent) {
		switch(self::$recipient) {
			case 'Disabled': return null;
			case 'SiteConfig': return SiteConfig::current_site_config()->CommentNotificationEmail;
			case 'Page': return $parent->CommentNotificationEmail;
			case 'Admin': return Email::getAdminEmail();
			default: return self::$recipient;
		}
	}
}
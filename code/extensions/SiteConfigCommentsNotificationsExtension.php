<?php

/**
 * @author Damian Mooyman
 */
class SiteConfigCommentsNotificationsExtension extends DataExtension {
	
	public function updateCMSFields(FieldList $fields) {
		if(CommentsNotifications::configure_siteconfig()) {
			$fields->addFieldToTab(
				'Root.CommentNotifications', 
				new EmailField('CommentNotificationEmail', 'Comment Notification Email', null, 255)
			);
		}
	}
}
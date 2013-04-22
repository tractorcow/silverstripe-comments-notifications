<?php

/**
 * @author Damian Mooyman
 */
class CommentsNotificationsExtension extends DataExtension {
	private static $db = array(
		'CommentNotificationEmail' => 'Varchar(255)'
	);
}

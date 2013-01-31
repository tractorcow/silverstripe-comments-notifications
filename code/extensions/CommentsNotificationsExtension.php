<?php

/**
 * @author Damian Mooyman
 */
class CommentsNotificationsExtension extends DataExtension {
	static $db = array(
		'CommentNotificationEmail' => 'Varchar(255)'
	);
}
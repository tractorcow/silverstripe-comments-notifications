<?php

/**
 * @author Damian Mooyman
 * @see CommentingController
 */
class CommentingControllerNotificationsExtension extends Extension {
	
	/**
	 * Notify admin of new comment
	 * 
	 * @param Comment $comment
	 */
	public function onAfterPostComment(Comment $comment) {
		
		// Determine recipient
		$recipient = CommentsNotifications::get_recipient($comment->getParent());
		if(empty($recipient)) return;
		
		// Check moderation status
		if(Config::inst()->get('CommentsNotifications', 'only_unmoderated') && $comment->Moderated) return;
		
		// Generate email
		$email = new Email();
		$email->setSubject(Config::inst()->get('CommentsNotifications', 'email_subject'));
		$email->setTo($recipient);
		$email->setTemplate(Config::inst()->get('CommentsNotifications', 'email_template'));
		$email->populateTemplate($comment);
		
		// Corretly set sender and from as per email convention
		$sender = Config::inst()->get('CommentsNotifications', 'email_sender');
		if(!empty($comment->Email)) {
			$email->setFrom($comment->Email);
			$email->addCustomHeader ('Reply-To', $comment->Email);
		} else {
			$email->setFrom($sender);
		}
		$email->addCustomHeader('X-Sender', $sender);
		$email->addCustomHeader('Sender', $sender);
		
		// Send
		$email->send();
	}
}
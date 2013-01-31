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
		if(CommentsNotifications::$only_unmoderated && $comment->Moderated) return;
		
		// Generate email
		$email = new Email();
		$email->setSubject(CommentsNotifications::$email_subject);
		$email->setTo($recipient);
		$email->setTemplate(CommentsNotifications::$email_template);
		$email->populateTemplate($comment);
		
		// Corretly set sender and from as per email convention
		if(!empty($comment->Email)) {
			$email->setFrom($comment->Email);
			$email->addCustomHeader ('Reply-To', $comment->Email);
		} else {
			$email->setFrom(CommentsNotifications::$email_sender);
		}
		$email->addCustomHeader('X-Sender', CommentsNotifications::$email_sender);
		$email->addCustomHeader('Sender', CommentsNotifications::$email_sender);
		
		// Send
		$email->send();
	}
}
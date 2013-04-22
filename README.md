# Page comments email notification module for Silverstripe

This mobule provides simple email notifications for page comments

## Credits and Authors

 * Damian Mooyman - <https://github.com/tractorcow/silverstripe-comments-notifications>

## License

 * TODO

## Requirements

 * SilverStripe 3.1
 * PHP 5.3
 * Comments module - <https://github.com/silverstripe/silverstripe-comments>

## Installation Instructions

 * Extract all files into the 'comments-notifications' folder under your Silverstripe root. 

## Configuration

Using the Config set the "recipient" attribute of "CommentsNotifications" class to one of:

 * SiteConfig (configure the email under settings globally)
 * Page (configure the recipient per page)
 * Admin (uses the admin email address)
 * Disabled
 * any email address (use this explicit email address)

E.g. MyProject.yaml

```yaml
CommentsNotifications:
  recipient: 'Page'
```

## Extending

To hook into the outgoing email (in order to customise the template) you can 
extend CommentingController with an extending class with a function updateEmail

```php
class EmailSenderExtension extends Extension {
	public function updateEmail(Email &$email) {
		$email->populateTemplate(array(
			'SiteConfig' => SiteConfig::current_site_config()
		));
	}
}
```

## Need more help?

Message or email me at damian.mooyman@gmail.com or, well, read the code!

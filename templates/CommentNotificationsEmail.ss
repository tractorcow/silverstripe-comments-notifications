<!DOCTYPE html>
<html>
	<head></head>
	<body>
		<p>A new comment has been posted.</p>
		<% if Link %>
			<p><a href="$Link">Click here to view this entry</a></p>
		<% end_if %>
		<p>Comment details</p>
		<dl>
			<dt>Date Posted:</dt>
			<dd>$Created.Nice</dd>
			<% if Name %>
				<dt>Name:</dt>
				<dd>$Name.XML</dd>
			<% end_if %>
			<% if Email %>
				<dt>Email:</dt>
				<dd>$Email.XML</dd>
			<% end_if %>
			<% if URL %>
				<dt>URL:</dt>
				<dd>$URL.XML</dd>
			<% end_if %>
			<% if Comment %>
				<dt>Comment:</dt>
				<dd>$Comment.XML</dd>
			<% end_if %>
		</dl>
	</body>
</html>
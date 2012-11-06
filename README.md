php-mini-tpl
------------

**What this is:**
 - most minimalistic approach to templates in PHP. It really is just a wrapper for finding a template file and performing a mass `str_replace`.

**What this is not:**
 - a template engine to use project-wide in a website that has complex user interaction. This is just for quickly rendering text/html or other documents with variables.
 
Example usage:
--------------

*tpl/test.tpl:*

	<html>
	<head>
		<title>{title}</title>
		{extra}
	</head>
	<body>
		<p>Today was a {myday} day.</p>
	</body>
	</html>

*index.php:*

	include 'class.tpl.php';
	
	$main = new tpl('test');
	$main->add('title', 'Page Title');
	$main->add('extra', '<script src="jquery.js"></script>');
	
	if (isset($_GET['myday']))
	{
		$main->add('myday', htmlspecialchars($_GET['myday']));
	}
	else
	{
		$main->add('myday', 'mysterious');
	}
	
	echo $main->build();
	
<!-- title and metas -->
<title><{if $xoops_pagetitle !=''}><{$xoops_pagetitle}> : <{/if}><{$xoops_sitename}></title>
<meta http-equiv="content-type" content="text/html; charset=<{$xoops_charset}>" />
<meta name="robots" content="<{$xoops_meta_robots}>" />
<meta name="author" content="<{$xoops_meta_author}>"/>
<meta name="generator" content="XOOPS"/>
<{if $url|default:false}>
	<meta http-equiv="Refresh" content="<{$time}>; url=<{$url}>" />
<{/if}>

<!-- Rss -->
<link rel="alternate" type="application/rss+xml" title="" href="<{xoAppUrl 'backend.php'}>" />

<!-- path favicon -->
<link rel="shortcut icon" type="image/ico" href="<{xoAppUrl 'favicon.ico'}>" />

<!-- Xoops style sheet -->

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- customized header contents -->
<{$xoops_module_header}>
<?php
	require "pdml.php";
?>
<pdml>
<head>
<title>Document title goes here</title>
<subject>Document subject goes here</subject>
<keywords>example,php,document,and,stuff</keywords>
<script>
tts.qText("I am pee dee hef. Hear me Roar!!!");
tts.talk();
app.alert("err, hi!");
</script>
</head>
<body>
<header>
<rotate angle="45" center="30mm,190mm">
<div top=19cm left=3cm height=1.5cm>
<font color="#FFD0E0" face=arial size=50pt>
<b>This is a Water Mark</b>
</font></div>
</rotate>
</header>
<font size="200%">
This is some sample text.
This is some sample text.
This is some sample text.
<br><br>
This is some sample text.
This is some sample text.
</font>
<page>
<font size=1cm>
<multicell top=50% align=center>
This page intentionally left blank
</multicell></font>
<header>
<a href="http://pdml.sf.net">pdml.sf.net</a>
<i><multicell align=right>Look, a different Header!</multicell></i>
</header>
<page>
<footer>
<multicell top=98% align=center>
Page &pagenumber;/&pagecount;</multicell>
</footer>
<div color="#ffc0e0" top=2cm left=50pt width=40% height=100">
Random page content goes here.
<font size=300%>Bigger font</font><br>
<font color="#00ff00>Colored text </font>
<b>Bold</b>, <u>Underlined</u> or <i>Italic</i>
<br>
</div>
</body>
</pdml>

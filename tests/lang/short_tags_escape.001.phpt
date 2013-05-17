--TEST--
Escaping with short_open_tag: On, __auto_escape: On
--INI--
short_open_tag=on
asp_tags=on
__auto_escape=on
--FILE--
<?='this should be escaped "<>&'?>

<%='so should this "<>&'%>


<?php
echo "this shouldn't be escaped \"<>&\n";
print "nor this \"<>&"; ?>

--EXPECT--
this should be escaped &quot;&lt;&gt;&amp;
so should this &quot;&lt;&gt;&amp;

this shouldn't be escaped "<>&
nor this "<>&

--TEST--
Escaping with short_open_tag: On, __auto_escape: On
--INI--
short_open_tag=on
__auto_escape=on
--FILE--
<?='this should be escaped "<>&'?>

<?='so should this "<>&'?>

<?php
echo "and so should this \"<>&\n";
print "and even this \"<>&"; ?>

But this shouldn't be escaped "<>&
<? fwrite(STDOUT, "and this shouldn't either \"<>&"); ?>
--EXPECT--
this should be escaped &quot;&lt;&gt;&amp;
so should this &quot;&lt;&gt;&amp;
and so should this &quot;&lt;&gt;&amp;
and even this &quot;&lt;&gt;&amp;
But this shouldn't be escaped "<>&
and this shouldn't either "<>&

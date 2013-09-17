--TEST--
No escaping with raw short open tags short_open_tag: On, __auto_escape: On
--INI--
short_open_tag=on
__auto_escape=on
--FILE--
<?raw="this shouldn't be escaped \"<>&"?>

<?='but this should "<>&'?>

<? ini_set('__auto_escape', 0); ?>
<?="though now it shouldn't \"<>&"?>
--EXPECT--
this shouldn't be escaped "<>&
but this should &quot;&lt;&gt;&amp;
though now it shouldn't "<>&

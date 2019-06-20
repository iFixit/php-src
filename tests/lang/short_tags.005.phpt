--TEST--
Escaping with custom flags using short open tags __auto_escape: On
--INI--
short_open_tag=on
__auto_escape=on
--FILE--
<?="both quotes should be escaped: \" '" ?>

<? ini_set('__auto_escape_flags', ENT_COMPAT); ?>
<?="       now just double quotes: \" '" ?>

<? ini_set('__auto_escape_flags', ENT_NOQUOTES); ?>
<?="           now neither quotes: \" '" ?>
--EXPECT--
both quotes should be escaped: &quot; &#039;
       now just double quotes: &quot; '
           now neither quotes: " '

--TEST--
Auto-escaping with __auto_escape_exempt_class using short open tags __auto_escape: On
--INI--
short_open_tag=on
__auto_escape=Off
__auto_escape_exempt_class=HtmlString
--FILE--
<?
class HtmlString {
    protected $html = '';

    public function __construct($html) {
       $this->html = $html;
    }

    public function __toString() {
       return $this->html;
    }
}

function byRef(&$byRef) {}
?>
<?= "this ampersand shouldn't be escaped when autoescaping is off: &" ?>

<? ini_set("__auto_escape", 1) ?>
<?= "   this ampersand should be escaped when autoescaping is on: &" ?>

<?= new HtmlString("this ampersand shouldn't be escaped when using an Exempt class: &") ?>

<? $html = new HtmlString("Passing an Exempt class by reference should leave this uescaped: &") ?>
<? byRef($html); echo $html; ?>

<? ini_set("__auto_escape_exempt_class", "No Such Class") ?>
<?= new HtmlString("   this ampersand should be escaped when using a non-Exempt class: &") ?>
--EXPECT--
this ampersand shouldn't be escaped when autoescaping is off: &
   this ampersand should be escaped when autoescaping is on: &amp;
this ampersand shouldn't be escaped when using an Exempt class: &
Passing an Exempt class by reference should leave this uescaped: &
   this ampersand should be escaped when using a non-Exempt class: &amp;

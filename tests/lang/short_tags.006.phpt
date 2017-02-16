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
?>
<?= "this ampersand shouldn't be escaped when autoescaping is off: &" ?>

<? ini_set("__auto_escape", 1) ?>
<?= "   this ampersand should be escaped when autoescaping is on: &" ?>

<?= new HtmlString("this ampersand shouldn't be escaped when using an Exempt class: &") ?>
<? ini_set("__auto_escape_exempt_class", "No Such Class") ?>

<?= new HtmlString("   this ampersand should be escaped when using a non-Exempt class: &") ?>
--EXPECT--
this ampersand shouldn't be escaped when autoescaping is off: &
   this ampersand should be escaped when autoescaping is on: &amp;
this ampersand shouldn't be escaped when using an Exempt class: &
   this ampersand should be escaped when using a non-Exempt class: &amp;

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
<?= "this ampersand shouldn't be escaped: &" ?>

<? ini_set("__auto_escape", 1) ?>
<?= "   this ampersand should be escaped: &" ?>

<?= new HtmlString("this ampersand shouldn't be escaped: &") ?>
<? ini_set("__auto_escape_exempt_class", "No Such Class") ?>

<?= new HtmlString("   this ampersand should be escaped: &") ?>
--EXPECT--
this ampersand shouldn't be escaped: &
   this ampersand should be escaped: &amp;
this ampersand shouldn't be escaped: &
   this ampersand should be escaped: &amp;

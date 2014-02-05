--TEST--
Auto-escaping with HtmlStrings using short open tags __auto_escape: On
--INI--
short_open_tag=on
__auto_escape=on
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
<?= "   this ampersand should be escaped: &" ?>

<?= new HtmlString("this ampersand shouldn't be escaped: &") ?>
--EXPECT--
   this ampersand should be escaped: &amp;
this ampersand shouldn't be escaped: &

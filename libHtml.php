
<?php
class Elem
{
  private $tree = array();
  private $def = array('class'=>false, 'id'=>false, 'val'=>false, 'href'=>false, 'src'=>false);

  public function __construct($elem, $args){
    $args['elem'] = $elem;
    $args = array_merge($this->def, $args);
    $this->tree = array('args'=>$args, 'children'=>array());
  }

  public function add($elem, $args)
  {
    array_push($this->tree['children'], new Elem($elem, $args));
    return end($this->tree['children']);
  }

  public function print($i=0)
  {
    $args = $this->tree['args'];
    $sep = " ";

    $opt = '';
    foreach (array('class','id','href','src') as $v) {
      $opt .= ($args[$v]) ? ' '.$v.'="'.$args[$v].'"' : '';
    }
    $val = ($args['val']) ? str_repeat($sep,$i+2).$args['val']."\n" : '';

    echo str_repeat($sep,$i).'<'.$args['elem'].$opt.">\n";
      echo $val;
      foreach ($this->tree['children'] as $value) {
        $value->print($i+2);
      }
    echo str_repeat($sep,$i).'</'.$args['elem'].'>'."\n";
  }
}
?>

<?php
class Elem
{
  private $tree; // Element root

  public function __construct($elem, $args=array()){
    $args['elem'] = $elem; // Element options
    $this->tree = array('args'=>$args, 'children'=>array());
  }

  public function add($elem, $args=array()){
    array_push($this->tree['children'], new Elem($elem, $args)); // Push the new element to children array
    return end($this->tree['children']); // New born element
  }


  public function outerHtml($i=0)
  {
    $args = $this->tree['args'];          // Retrieve element otions
    $html = '';                           // Main html

    $sep = " ";                           // Indent unit
    $sp = str_repeat($sep,$i);            // Indent
    $sp_val = (isset($args['val'])) ? '' : $sp; // Indent after inner html

    $lb = "\n";                           // Line break unit
    $lb_val = (isset($args['val'])) ? '' : $lb; // Line break around inner html

    // Extract element type, val and extra_opt
    $elem = $args['elem']; unset($args['elem']);
    $val = (isset($args['val'])) ? $args['val'].$lb_val : ''; unset($args['val']);
    $extra_opt = (isset($args['extra_opt'])) ? ' '.$args['extra_opt'] : ''; unset($args['extra_opt']);
    $close_tag = (isset($args['close_tag'])) ? $args['close_tag'] : true; unset($args['close_tag']);


    // Concat element tags
    $opt = '';
    foreach($args as $k => $v) {
      $opt .= ' '.$k.'="'.$v.'"';
    }

    // Write html output
    $html .= $sp.'<'.$elem.$opt.$extra_opt.'>'.$lb_val;
      $html .= $val;
      foreach ($this->tree['children'] as $child) {
        $html .= $child->outerHtml($i+1);
      }
    if($close_tag) $html .= $sp_val.'</'.$elem.'>'.$lb;

    return $html;
  }
}
?>

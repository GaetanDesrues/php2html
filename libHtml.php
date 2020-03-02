<?php
class Elem
{
  private $tree; // Element root

  public function __construct($elem, $args=array()){
    $args['elem'] = $elem; // Element options
    $this->tree = array('args'=>$args, 'children'=>array());
  }

  // Add arguments wrapped in array
  public function add($elem, $args=array()){
    array_push($this->tree['children'], new Elem($elem, $args)); // Push the new element to children array
    return end($this->tree['children']); // New born element
  }

  // Return children array
  public function getChild($i){
    return $this->tree['children'][$i];
  }

  // Add arguments one by one
  public function attr($opt, $val){ // Add an option (href="http.." | class="")
    $this->tree['args'][$opt] = $val; // Push the new option to args array
    return $this;
  }
  public function class($class){ // Add an option class=""
    $this->tree['args']['class'] = $class; // Push the new option to args array
    return $this;
  }
  public function id($id){ // Add an option id=""
    $this->tree['args']['id'] = $id; // Push the new option to args array
    return $this;
  }
  public function val($val){ // Add innerHtml
    $this->tree['args']['val'] = $val; // Push the new option to args array
    return $this;
  }
  public function style($style){ // Add style inline option
    $this->tree['args']['style'] = $style; // Push the new option to args array
    return $this;
  }

  // Add an Elem as new child
  public function include($_elem_){
    array_push($this->tree['children'], $_elem_); // Push the new element to children array
    return $_elem_;
  }

  // Add pure html as new child
  public function includeHtml($html_body){
    array_push($this->tree['children'], $html_body); // Push the row html to children array
  }


  // Print html
  public function outerHtml($i=0)
  {
    $args = $this->tree['args'];          // Retrieve element otions
    $html = '';                           // Main html

    $sep = " ";                           // Indent unit
    $sp = str_repeat($sep,$i);            // Indent
    $sp_val = (isset($args['val'])) ? '' : $sp; // Indent after inner html

    $lb = "\n";                           // Line break unit
    $lb_val = (isset($args['val'])) ? '' : $lb; // Line break around inner html

    // Extract special element options
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
        $html .= (is_a($child, 'Elem')) ? $child->outerHtml($i+1) : $child;
      }
    if($close_tag) $html .= "$sp_val</$elem>$lb";

    return $html;
  }
}
?>

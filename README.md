# Php converter to html syntax

### Example

```
$obj = new Elem('div', array('class'=>'class1', 'val'=>'a text'));
$s1 = $obj->add('span', array('class'=>'class2'));
$s1->add('span', array('val'=>'a span'));
$obj->add('img', array('href'=>'source', 'id'=>'my_image', 'class'=>'my_class'));
$obj->print();
```
Output:
```
<div class="class1">
  a text
  <span class="class2">
    <span>
      a span
    </span>
  </span>
  <img class="my_class" id="my_image" href="source">
  </img>
</div>
```

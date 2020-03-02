# Php converter to html syntax

### Example

```
$obj = (new Elem('div'))->class('class1')->id('text1');
$s1 = $obj->add('div')->class('class2');
$s1->add('span')->val('a span');
$obj->add('img', array('href'=>'source', 'id'=>'my_image', 'class'=>'my_class', 'close_tag'=>false));
echo $obj->outerHtml();
```
Output:
```
<div class="class1" id="text1">
 <div class="class2">
  <span>a span</span>
 </div>
 <img href="source" id="my_image" class="my_class">
</div>
```

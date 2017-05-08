# Collapse

`Jblv\Admin\Widgets\Collapse` class used to generate folding components:
```php
use Jblv\Admin\Widgets\Collapse;

$collapse = new Collapse();

$collapse->add('Bar', 'xxxxx');
$collapse->add('Orders', new Table());

echo $collapse->render();

```

The `Collapse::add($title, $content)` method is used to add a collapsed item to the collapsing component. The `$title` parameter sets the title of the item. The`$content` parameter is used to .
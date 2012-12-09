Usage
================

```php
use Landmarx\Landmark\LandmarkItem as Landmark;
use Landmarx\Landmark\Renderer\ListRenderer;

// create the root item 
$root = new Landmark('Appalachian Mountain Range');

// add a child landmark
$root->addChild('Mt. Washington');

// add to root as a child
$katahdin = new Landmark('Mt. Katahdin');
$root->addChild($katahdin);

// access children
$washington = $root['Mt. Washington'];

// add lat/lng
$washington->setLatitude('-47.55');
$washington->setLongitude('70.36');

$katahdin->setLatLng(array('-47.65', '70.59'));

// render tree
$renderer = new ListRenderer();
echo $renderer->render($landmarks);
```
this would render the html to display an unordered list.
```html
<ul>
  <li>
    <a href="/appalachian-mountain-range">Appalachian Mountain Range</a>
  </li>
  <li>
    <ul>
      <li>
        <a href="/appalachian-mountain-range/mt-katahdin">Mt. Katahdin</a>
      </li>
      <li>
        <a href="/appalachian-mountain-range/mt-washington">Mt. Washington</a>
      </li>
    </ul>
  </li>
</ul>
```
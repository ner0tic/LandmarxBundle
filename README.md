Landmarx TreeNode Mapping System

The originating intention of this application was to track certain details about landmarks while hiking and/or driving.

Planned Usage:

```php
// create a base landmark... your container if you will
$trail = new Landmark('appalachian', new LandmarkCategory('trail')); // __constructor($name, $category, $parent = null, array $opts)
// planned shortcut
$trail = new Trail('appalachian'); // __constructor($name, $parent = null, array $opts)

// add a landmark to the trail
$trailheads[] = new Trailhead('Northern Terminus', $trail);
$trailheads[] = new Trailhead('Southern Terminus', $trail);

// set landmark coords
$trailheads[0]->setLatLng(45.904356, -68.921275);

// add a custom category
$leanToCat = new LandmarkCategory('lean-to', 'campsite'); // __constructor($name, $parent = null, $description = null)
$wilsonLeanto = new $leanToCat('wilson', $trail);
$wilsonLeanto->setLatLng(array(45.39873, -69.45921)); // can accept arrays as well
```
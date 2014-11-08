#Sluggable

[![Latest Stable Version](https://poser.pugx.org/crabstudio/cakephp-sluggable/v/stable.svg)](https://packagist.org/packages/crabstudio/cakephp-sluggable)
[![Total Downloads](https://poser.pugx.org/crabstudio/cakephp-sluggable/downloads.svg)](https://packagist.org/packages/crabstudio/cakephp-sluggable)
[![Latest Unstable Version](https://poser.pugx.org/crabstudio/cakephp-sluggable/v/unstable.svg)](https://packagist.org/packages/crabstudio/cakephp-sluggable)
[![License](https://poser.pugx.org/crabstudio/cakephp-sluggable/license.svg)](https://packagist.org/packages/crabstudio/cakephp-sluggable)

CakePHP 3.0 Behavior to remove signed utf-8 character and make friendly url

## Requirement:

Cakephp 3.x

PHP: >= 5.4.0

## Installation:
Add the following lines to your application's `composer.json`:

```
    "require": {
        "crabstudio/cakephp-sluggable:dev-master": "dev-master"
    }
```

followed by the command:

`composer update`

Or run the following command directly without changing your `composer.json`:

`composer require crabstudio/cakephp-sluggable:dev-master`

## Usage:
In your Model Table, insert this one into function initialize:

```
        $this->addBehavior('Sluggable', [
            'field' => 'title',
            'slug' => 'slug',
            'replacement' => '-', 
            'implementedFinders' => [
                'slugged' => 'findSlug',
                'check' => 'checkExist']
        ]);
```

## Explain:
```
  field: name of field hold original string
  slug: name of field will save slugged string
  replacement: the connector charactor
  slugged: alias of function fundSlug, you can change to new one. VD: 'friendlyName' => 'findSlug'
  check: alias of function checkExist, you can change to new one. VD: 'checkExisting' => 'checkExist'
```
Để gọi function slugged, check (gọi tới tên alias của function) này các bạn dùng như sau: (Các bạn có thể gọi bất cứ đâu dùng TableRegistry, hoặc loadModel)
## Call function:
```
Ex1: 
$article = \Cake\ORM\TableRegistry::get('Articles')->find('slugged', ['slug' => 'Cach-lam-link-than-thien'])->first();
Ex2:
$this->loadModel('Articles');
$article = $this->Articles->find('slugged', ['slug' => 'Cach-lam-link-than-thien'])->first();
Ex3:
$isExist = $this->Articles->find('check', ['slug' => 'Cach-lam-link-than-thien'])->first();
if($isExist)
        do_some_thing;
else
        save entity;
```

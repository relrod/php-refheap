PHP Refheap
===========

A PHP client to [Refheap](https://refheap.com/). Just in case you didn't get
that from the name.

Usage
=====

```php
<?php

require_once dirname(__FILE__).'/php-refheap/__init__.php';

$refheap = RefHeapUtils::id(new RefHeapClient())
  ->setUsername('myusername')
  ->setToken('00000000-0000-0000-0000-0000000000000');

$paste = RefHeapUtils::id(new RefHeapPaste())
  ->setPrivate(true)
  ->setLanguage('PHP')
  ->setContents(file_get_contents('PHPRefheapClient.php'));

$result = $refheap->paste($paste);
```

Developer Information
=====================

Methods and classes within this library are documented via the
[Diviner](https://github.com/facebook/diviner/) documentation generator.

Please document all new methods.

License
=======

(c) 2012 Ricky Elrod and others.

Licensed under a MIT license, the same as RefHeap itself.

[![Code Climate](https://codeclimate.com/github/psilocyberunner/acoustid-php/badges/gpa.svg)](https://codeclimate.com/github/psilocyberunner/acoustid-php)
[![Test Coverage](https://codeclimate.com/github/psilocyberunner/acoustid-php/badges/coverage.svg)](https://codeclimate.com/github/psilocyberunner/acoustid-php/coverage)

# AcoustId API

This project is a PHP wrapper around [Acoustid.org](https://acoustid.org/webservice) Web Services API.

### Installation

TODO: Describe the installation process

### Usage

To use this library you should first decide what kind of lookup you want. 

At this moment library supports two types of lookups:
* Lookup by TrackId
* Lookup by FingerPrint

Also library supports: 
* Submission of fingerprints 
* Getting the submission status

**How to make a fingerprint lookup:**

First you have to bootstrap the application:

```php
require_once __DIR__ . '/../src/bootstrap.php';
\AcoustId\Exception::setExceptionHandler();
```

**FingerPrint lookup** can be created as: <a id="chapter-1"></a>

```php
$lookUp = new \AcoustId\LookUp\FingerPrint($d, $f);

# Response format, ['json', 'jsonp', 'xml'], default if 'json'
$lookUp->setFormat('json');

# Available meta data to get from service (you can combine theese ones to achieve necessary output)
$lookUp->setMeta([
  'recordings', 'recordingids', 'releases', 
  'releaseids', 'releasegroups', 'releasegroupids', 
  'tracks', 'compress', 'usermeta', 'sources'
]);

# You can set the callback functions
$lookUp->setJsonCallBack('test');

# Set basic data
$lookUp->setMeta(['recordings']);

$response = $client->lookUp(
    $lookUp
);
echo $response->getBody()->getContents();
```

**TrackId lookup** is also available as:

```php
$lookUp = new \AcoustId\LookUp\TrackId($t);

# Optional response type and callback, you can wrap the response with JSONP callback
$lookUp->setFormat('jsonp')->setJsonCallBack('testCallback');

# Set requested meta
$lookUp->setMeta([
  'recordings', 'recordingids', 'releases', 
  'releaseids', 'releasegroups', 'releasegroupids', 
  'tracks', 'compress', 'usermeta', 'sources'
]);

$response = $client->lookUp(
    $lookUp
);

echo $response->getBody()->getContents();
```

Both lookups support [JSONP](https://ru.wikipedia.org/wiki/JSONP) callbacks

TODO: add usage examples for submit  and submit-status requests. 

For more details see examples at **/examples** folder

Info about AcoustId.org web service could be found [here](https://acoustid.org/webservice)

### Note

Library doesn't support **batch-submissions** and **listing of AcoustIDs by MBID**. I'll try to add it in future releases.

### Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

### License

**The MIT License (MIT)**

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

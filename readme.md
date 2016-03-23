[![Code Climate](https://codeclimate.com/github/psilocyberunner/acoustid-php/badges/gpa.svg)](https://codeclimate.com/github/psilocyberunner/acoustid-php)
[![Test Coverage](https://codeclimate.com/github/psilocyberunner/acoustid-php/badges/coverage.svg)](https://codeclimate.com/github/psilocyberunner/acoustid-php/coverage)

# AcoustId API

This project is a PHP wrapper around [Acoustid.org](https://acoustid.org/webservice) Web Services API.

### Installation

Yout can clone this repository.
```
git clone https://github.com/psilocyberunner/acoustid-php.git
```

But the easiest way is to require the [package](https://packagist.org/packages/c0dex/acoustid) from [Composer](https://getcomposer.org/) repository:

```
composer require c0dex/acoustid
```

After that the initialization of library is done as:

```php
use AcoustId\AcoustId;
use AcoustId\LookUp\FingerPrint;

require 'vendor/autoload.php';

# Set exception handler
\AcoustId\Exception::setExceptionHandler();

# Init the credentials
$acoustId = new AcoustId('YOUR_ACOUSTID_CLIENT_TOKEN');

# Create lookup
$lookUp = new FingerPrint($duration, $fingerPrint);

# Create the request and get response
$response = $acoustId->lookUp($lookUp);

# View the results
echo $response->getBody()->getContents();
```

Example output is:

```json
{
  status: "ok",
  results: [
    {
      score: 0.950422,
      id: "c97a7693-af5d-4d73-8334-e4588aec169a"
    },
    {
      score: 0.720728,
      id: "c8f5bfc0-3d4e-416d-857d-42d5d1c1e466"
    }
  ]
}
```

### Usage

To use this library you should first decide what kind of lookup you want. 

At this moment library supports two types of lookups:
* Lookup by TrackId
* Lookup by FingerPrint

Also library supports: 
* Submiting new fingerprints to AcoustId
* Getting the status for fingerprint submission

**Basic lookups examples:**

First you have to bootstrap the application, these lines are mandatory in all examples:

```php
# Requiring the bootstrap is optional if you don't need helpers.php for debugging
require_once __DIR__ . '/path/to/bootstrap.php';
\AcoustId\Exception::setExceptionHandler();
$client = new \AcoustId\AcoustId('YOUR_ACOUSTID_CLIENT_TOKEN');
```

**FingerPrint lookup:**

```php
$lookUp = new \AcoustId\LookUp\FingerPrint($duration, $fingerPrint);

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

# Example response with default meta
# {"status": "ok", "results": [{"score": 0.950422, "id": "c97a7693-af5d-4d73-8334-e4588aec169a"}, {"score": 0.720728, "id": "c8f5bfc0-3d4e-416d-857d-42d5d1c1e466"}]}
```

**TrackId lookup:**

```php
$lookUp = new \AcoustId\LookUp\TrackId($trackId);

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

# Example response with default meta
# {"status": "ok", "results": [{"score": 1.0, "id": "c97a7693-af5d-4d73-8334-e4588aec169a"}]}
```

Example response:

```json
{
  "status":"ok",
  "results":[
    {
      "score":1.0,
      "id":"c97a7693-af5d-4d73-8334-e4588aec169a"
    }
  ]
}
```

Both lookups support [JSONP](https://ru.wikipedia.org/wiki/JSONP) callbacks

**Submit new data to AcoustId:**

```php
# UserId can be found at https://acoustid.org/api-key after sign up
$submission = new \AcoustId\Submission('ACOUSTID_USER_TOKEN', $duration, $fingerPrint);
$response   = $client->submission(
    $submission
);
echo $response->getBody()->getContents();

# Example response with default meta
# {"status": "ok", "submissions": [{"status": "pending", "id": 155971755}]}
```

**Get the submission status:**

```php
# Here we need the submission id from previous request: $submissionId = 155971755
$status = new \AcoustId\Submission\Status($submissionId);

# Read the submission state
$response = $client->submissionStatus($status);
echo $response->getBody()->getContents();

# Example response with default meta
# {"status": "ok", "submissions": [{"status": "imported", "id": 155971755, "result": {"id": "c97a7693-af5d-4d73-8334-e4588aec169a"}}]}
```

**List tracks by MBID:**

```php
# $mbid could be an array (for batch requests) or string. 
$list = new \AcoustId\ListByMDID($mbid);

# Optionally you can use batch requests, see params above. # If $mbid is array - the batch would be set to 1 automatically
$list->setBatch(1);

# list data
$response = $client->listByMBID($list);

echo $response->getBody()->getContents();
```

---

For more details see examples at **/examples** folder

Info about AcoustId.org web service could be found [here](https://acoustid.org/webservice)

### Note

Library doesn't support **batch-submissions** at this time. I'll add this feature in future releases.

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

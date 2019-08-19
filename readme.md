# AcoustId API

[![Build Status](https://travis-ci.com/psilocyberunner/acoustid-php.svg?branch=master)](https://travis-ci.com/psilocyberunner/acoustid-php)

This project is a PHP wrapper around [Acoustid.org](https://acoustid.org/webservice) Web Services API.

### Installation

You can clone this repository.
```
git clone https://github.com/psilocyberunner/acoustid-php.git
```

But the easiest way is to require the [package](https://packagist.org/packages/c0dex/acoustid) from [Composer](https://getcomposer.org/) repository:

```
composer require c0dex/acoustid
```

### Usage

Library supports next features of AcoustId API:

* Lookup by audio fingerprint
* Lookup by track ID
* Submit audio fingerprints
* Get data submission status
* List AcoustIDs by MBID (MusicBrainz IDs)

### Usage

After installation you should initialize library. 
Here i use [Dotenv](https://github.com/vlucas/phpdotenv) package to avoid storing credentials inside php
files. Also i use exception handler - [Whoops](https://github.com/filp/whoops), you can set your preferred
one.

```php
<?php
#bootstrap.php

# I use Dotenv package for config management (optional)
$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();
$dotenv->required(['API_APPLICATION_TOKEN', 'API_USER_TOKEN'])->notEmpty();

# Set exception handler (optional)
$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
```

**Lookup by fingerprint**

Here you should pass two required parameters - duration and  fingerprint. Both can be obtained from 
[fpcalc](https://acoustid.org/chromaprint) utility.

fpcalc is used as:

```bash
fpcalc -json ./mp3/some-track.mp3
```

You'll get something like:

```json
{"duration": 255, "fingerprint": "AQADtF8SZUkSRZjyzEMo.....long string"}
```

Decode data in php and you are ready to create API calls.

```php
<?php

require_once '../vendor/autoload.php'; # Composer autoloader
require_once 'bootstrap.php'; # See contents of bootstrap at the beginning 

# Here you can change getenv('API_APPLICATION_TOKEN') to your API token without getenv()
$lookUp = new \AcoustId\LookUp\FingerPrint(getenv('API_APPLICATION_TOKEN'));
$result = $lookUp->setJSONResponseType() # I want JSON response here (JSON is default)
    ->setMetaData([ # Choose what meta data you want. See API details for info
        \AcoustId\LookUp::META_RECORDINGS,
        \AcoustId\LookUp::META_RELEASES,
        \AcoustId\LookUp::META_USERMETA,
        \AcoustId\LookUp::META_RECORDINGIDS,
    ])->lookUp(255, 'AQADtF8SZUkSRZjyzEMo...'); # Data from fpcalc for certain media track

# View the response (all examples should have the same lines at the end)
echo $result->getBody()->getContents();
```

Example response:

```json
{  
   results:[  
      {  
         id:"5dfed459-fd8f-40d7-9d93-...",
         recordings:[  
            {},
            {}
         ],
         score:0.926028
      }
   ],
   status:"ok"
}
```

**Lookup by TrackId**

Here you should pass track id (UUID) as main parameter.

```php
<?php

require_once '../vendor/autoload.php';
require_once 'bootstrap.php';

$trackId = new \AcoustId\LookUp\TrackId(getenv('API_APPLICATION_TOKEN'));

# Optional response type JSONP and callback
//$lookUp->setFormat('jsonp')->setJsonCallBack('testCallback');

$trackId->setMetaData([
    \AcoustId\LookUp::META_RECORDINGS,
    \AcoustId\LookUp::META_RECORDINGIDS,
]);

$result = $trackId->lookUp('5dfed459-fd8f-40d7-9d93-...');
```

Example response:

```json
{  
   results:[  
      {  
         id:"5dfed459-fd8f-40d7-9d93-...",
         recordings:[  
            {  
               id:"180a17dd-f456-4ff2-be39-..."
            },
            {...},
            {  
               id:"c6b6ea6b-52a7-46b3-9821-..."
            }
         ],
         score:1
      }
   ],
   status:"ok"
}
```

**Submit audio fingerprints**

If you wish to support AcoustId database with your own data - you'll need also user API token 
(second one, only for data submit requests). Get your personal user's API key 
[here](https://acoustid.org/api-key). In this code example i use 
[getId3 library](https://github.com/JamesHeinrich/getID3) for extracting the id3 tags from mp3 files.

```php
<?php

require_once '../vendor/autoload.php';
require_once './bootstrap.php';

$dir  = __DIR__ . '/..';
$x    = exec(escapeshellcmd('fpcalc -json ./../mp3/some-track.mp3'), $output, $return);
$data = json_decode($output[0]);

$id3   = new getID3();
$file1 = $id3->analyze('./../mp3/some-track.mp3');

$submission = new \AcoustId\Submission(getenv('API_APPLICATION_TOKEN'));
$result     = $submission->setJSONResponseType()
    ->setWait(1) # How long to wait for request to be processed
    ->setDuration($data->duration)
    ->setUserToken(getenv('API_USER_TOKEN')) # User's API token
    ->setFingerPrint($data->fingerprint)
    ->setAlbumArtist($file1['id3v2']['comments']['artist'][0]) # Array structure for 
    ->setTrackTitle($file1['id3v2']['comments']['title'][0])   # your track may differ
    ->setTrackNo(20)
    ->send();
```

Example response:

```json
{  
   status:"ok",
   submissions:[  
      {  
         id:1234567890,
         result:{  
            id:"5dfed459-fd8f-40d7-9d93-..."
         },
         status:"imported"
      }
   ]
}
```

Or if submission is pending:

```json
{  
   "status":"ok",
   "submissions":[  
      {  
         "id":123456789,
         "status":"pending"
      }
   ]
}
```

**Batch submit fingerprints**

You can pass several fingerprints at the same time as:

```php
<?php

require_once '../vendor/autoload.php';
require_once './bootstrap.php';

$batch = new \AcoustId\Submission\Batch(getenv('API_APPLICATION_TOKEN'));
$batch->setUserToken(getenv('API_USER_TOKEN'));
$batch->setWait(5);

$batch->setBatch([
    (new AcoustId\Submission($batch->getClientAPIToken()))
        ->setFingerPrint('BDQGOCRIIpDoYgA...')
        ->setDuration(256),
    (new AcoustId\Submission($batch->getClientAPIToken()))
        ->setFingerPrint('AQADtEmiKEnCREl...')
        ->setDuration(238),
]);

$result = $batch->sendBatch();
```

Example response:

```json
{  
   status:"ok",
   submissions:[  
      {  
         id:1234567890,
         index:"0",
         result:{  
            id:"5dfed459-fd8f-40d7-9d93-..."
         },
         status:"imported"
      },
      {  
         id:1234567890,
         index:"1",
         result:{  
            id:"f786e327-453d-49b6-b313-..."
         },
         status:"imported"
      }
   ]
}
```

**Get submission status**

After submitting your data to AcoustId you probably will need to check the submission state, 
especially when submission could not be imported immediately ('pending' status). 
So get your submission id and run:

```php
<?php

require_once '../vendor/autoload.php';
require_once 'bootstrap.php';

$status = new \AcoustId\Submission\Status(getenv('API_APPLICATION_TOKEN'));
$result = $status->setSubmissionId(123456789)->find();
//or
$result = $status->find(123456789);
```

Example response:

```json
{  
   status:"ok",
   submissions:[  
      {  
         id:123456789,
         result:{  
            id:"e13393ef-7b4f-4a35-ae86-..."
         },
         status:"imported"
      }
   ]
}
```

**List AcoustIDs by MBID**

You'll need MusicBrainz recording ID for such request.

```php
<?php

require_once '../vendor/autoload.php';
require_once './bootstrap.php';

$list   = new \AcoustId\ListByMBId(getenv('API_APPLICATION_TOKEN'));
$list->setJSONResponseType();
$result = $list->search('4e0d8649-1f89-44f3-91af-...');
```

Example response:

```json
{  
   status:"ok",
   tracks:[  
      {  
         id:"8dbf2f94-3e91-4501-bb47-..."
      },
      {...},
      {  
         id:"12123b04-1bd6-4f55-9afa-..."
      }
   ]
}
```

---

For more details see examples at **/examples** folder.

Info about AcoustId.org web service could be found [here](https://acoustid.org/webservice)

### License

**The MIT License (MIT)**

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

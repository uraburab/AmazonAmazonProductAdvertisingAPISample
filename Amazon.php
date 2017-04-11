<?php

require_once __DIR__.'/vendor/autoload.php';

use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Operations\Search;
use ApaiIO\ApaiIO;

class Amazon
{
    const AWS_API_KEY = 'API_KEY'; // 取得した値をここに定義

    const AWS_API_SECRET_KEY = 'API_SECRET_KEY'; // 取得した値をここに定義

    const AWS_ASSOCIATE_TAG = 'nuchwedesn-22';

    public $apaiIO;

    public function __construct()
    {
        $conf = (new GenericConfiguration())
          ->setCountry('co.jp')
          ->setAccessKey(static::AWS_API_KEY)
          ->setSecretKey(static::AWS_API_SECRET_KEY)
          ->setAssociateTag(static::AWS_ASSOCIATE_TAG)
          ->setRequest(new \ApaiIO\Request\GuzzleRequest(new \GuzzleHttp\Client()));
        $this->apaiIO = new ApaiIO($conf);
    }

    public function getList($category, $keyword)
    {
      $search = new Search();
      $search->setCategory($category);
      $search->setKeywords($keyword);

      return $this->apaiIO->runOperation($search);
    }
}

// example

$amazon = new Amazon();
var_dump($amazon->getList('DVD', 'ワンパンマン'));

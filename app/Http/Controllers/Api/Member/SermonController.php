<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Exception;

class SermonController extends Controller
{
  use ResponseTrait;

  public function sermons()
  {
    try {
      $fileContents = file_get_contents("http://www.podcasts.com/rss_feed/00b03551b395628591a24c0ab6050926");
      $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
      $fileContents = trim(str_replace('"', "'", $fileContents));
      $simpleXml = simplexml_load_string($fileContents);
      $links = [];

      foreach ($simpleXml->channel->item as $item) {
        $links[] = $item;
      }
      return $this->dataResponse($links);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}

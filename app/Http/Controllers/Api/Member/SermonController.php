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
      $fileContents = file_get_contents(getenv("RSS_FEED_URL"));
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

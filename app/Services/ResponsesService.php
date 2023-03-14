<?php
  namespace App\Services;

  class ResponsesService {

    public function renderResponse($object, $responseStatus) {
      $contentType = "application/json";
      return response($object, $responseStatus)->header('Content-Type', $contentType);
    }
  }
?>
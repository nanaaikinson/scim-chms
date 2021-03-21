<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

trait ResponseTrait
{
  public function deleteResponse($message = null, $data = null): JsonResponse
  {
    $response = [
      'code' => 204,
      'status' => 'success',
      'data' => $data,
      'message' => $message ? $message : 'Resource Deleted'
    ];
    return response()->json($response, $response['code']);
  }

  public function errorResponse($message = null, $data = null): JsonResponse
  {
    $response = [
      'code' => 400,
      'status' => 'error',
      'data' => $data,
      'message' => $message ? $message : 'Unprocessable Entity'
    ];
    return response()->json($response, $response['code']);
  }

  public function validationResponse($errors): JsonResponse
  {
    $response = [
      'code' => 422,
      'status' => 'validation error',
      'errors' => $errors
    ];
    return response()->json($response, $response['code']);
  }

  public function unauthorizedResponse($message = "Unauthorized"): JsonResponse
  {
    $response = [
      'code' => 401,
      'status' => 'unauthorized',
      'message' => $message
    ];
    return response()->json($response, $response['code']);
  }

  protected function successResponse($message): JsonResponse
  {
    $response = [
      'code' => 200,
      'status' => 'success',
      'message' => $message,
    ];
    return response()->json($response, $response['code']);
  }

  protected function successDataResponse($message = null, $data = null): JsonResponse
  {
    $response = [
      'code' => 200,
      'status' => 'success',
      'message' => $message,
      'data' => $data
    ];
    return response()->json($response, $response['code']);
  }

  protected function dataResponse($data = null): JsonResponse
  {
    $response = [
      'code' => 200,
      'status' => 'success',
      'data' => $data
    ];
    return response()->json($response, $response['code']);
  }

  protected function createdResponse($message = null, $data = null): JsonResponse
  {
    $response = [
      'code' => 201,
      'status' => 'created',
      'message' => $message,
      'data' => $data
    ];
    return response()->json($response, $response['code']);
  }

  protected function notFoundResponse($message = null): JsonResponse
  {
    $response = [
      'code' => 404,
      'status' => 'error',
      'data' => 'Resource Not Found',
      'message' => $message ? $message : 'Record Not Found'
    ];
    return response()->json($response, $response['code']);
  }

  public function downloadFileAndDeleteResponse($file, $filename, $headers = null): BinaryFileResponse
  {
    return response()->download($file, $filename)->deleteFileAfterSend();
  }

  public function exceptionResponse(\Exception $exception, $message = null): JsonResponse
  {
    $appEnv = strtolower(config("app.env"));
    $appDebug = config("app.debug");

    if ($appEnv == "production" && $appDebug == false) {
      return response()->json(["message" => $message ?: "An error has occurred"], 400);
    }

    return response()->json(["message" => $exception->getMessage()], 400);
  }
}

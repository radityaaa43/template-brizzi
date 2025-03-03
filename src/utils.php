<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../../briapi-sdk/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..')->load();

use BRI\Brizzi\Brizzi;
use BRI\Util\ExecuteCurlRequest;
use BRI\Util\GetAccessToken;
use BRI\Util\PrepareRequest;

function getCredentials(): array {
  $clientId = $_ENV['CONSUMER_KEY'] ?? null;
  $clientSecret = $_ENV['CONSUMER_SECRET'] ?? null;

  if (!$clientId || !$clientSecret) {
      throw new Exception('Missing client credentials in environment variables.');
  }

  return [$clientId, $clientSecret];
}

function getAccessToken(
  string $clientId,
  string $clientSecret,
  string $baseUrl
): string {
  $getAccessToken = new GetAccessToken();

  $accessToken = $getAccessToken->getBRIAPI(
    $clientId,
    $clientSecret,
    $baseUrl
  );

  if (!$accessToken) {
    throw new Exception('Failed to retrieve access token.');
  }

  return $accessToken;
}

// Get current timestamp in UTC
function getTimestamp(): string {
  $date = new DateTime("now", new DateTimeZone("UTC"));
  return $date->format('Y-m-d\TH:i:s') . '.' . substr($date->format('u'), 0, 3) . 'Z';
}

// Sanitize input parameters
function sanitizeInput(array $inputs): array {
  $sanitized = [];
  foreach ($inputs as $key => $value) {
      $sanitized[$key] = filter_var($value, FILTER_SANITIZE_STRING);
      if (empty($sanitized[$key])) {
        throw new Exception("Invalid input parameter for $key");
      }
  }
  return $sanitized;
}

function fetchCheckTopupStatus(
  string $clientSecret,
  string $baseUrl,
  string $accessToken,
  string $timestamp,
  array $body
): string {
  $executeCurlRequest = new ExecuteCurlRequest();
  $prepareRequest = new PrepareRequest();

  $directDebit = new Brizzi(
    $executeCurlRequest,
    $prepareRequest
  );

  $response = $directDebit->checkTopupStatus(
    $clientSecret, 
    $baseUrl,
    $accessToken,
    $timestamp,
    $body
  );

  if (empty($response)) {
    throw new Exception("Error Processing Request", 1);
  }

  return $response;
}

function fetchTopupDeposit(
  string $clientSecret, 
  string $baseUrl,
  string $accessToken, 
  string $timestamp,
  array $body
): string {
  $executeCurlRequest = new ExecuteCurlRequest();
  $prepareRequest = new PrepareRequest();

  $directDebit = new Brizzi(
    $executeCurlRequest,
    $prepareRequest
  );

  $response = $directDebit->topupDeposit(
    $clientSecret, 
    $baseUrl,
    $accessToken, 
    $timestamp,
    $body
  );

  if (empty($response)) {
    throw new Exception("Error Processing Request", 1);
  }

  return $response;
}

function fetchValidateCardNumber(
  string $clientSecret,
  string $baseUrl,
  string $accessToken,
  string $timestamp,
  array $body
): string {
  $executeCurlRequest = new ExecuteCurlRequest();
  $prepareRequest = new PrepareRequest();

  $directDebit = new Brizzi(
    $executeCurlRequest,
    $prepareRequest
  );

  $response = $directDebit->validateCardNumber(
    $clientSecret,
    $baseUrl,
    $accessToken,
    $timestamp,
    $body
  );

  if (empty($response)) {
    throw new Exception("Error Processing Request", 1);
  }

  return $response;
}

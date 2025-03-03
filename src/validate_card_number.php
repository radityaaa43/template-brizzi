<?php

require 'utils.php';

header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("Content-Security-Policy: default-src 'self'; script-src 'self';");
header("X-Content-Type-Options: nosniff");

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

try {
  if (!str_starts_with($baseUrl, 'https://')) {
    throw new Exception('Base URL must use HTTPS');
  }

  list($clientId, $clientSecret) = getCredentials();

  $accessToken = getAccessToken(
    $clientId,
    $clientSecret,
    $baseUrl
  );

  $timestamp = getTimestamp();

  $username = filter_var('', FILTER_SANITIZE_STRING);
  $brizziCardNo = filter_var('', FILTER_SANITIZE_STRING);

  $validateInputs = sanitizeInput([
    'username' => $username,
    'brizziCardNo' => $brizziCardNo
  ]);

  // body
  $body = [
    'username' => $validateInputs['username'],
    'brizziCardNo' => $validateInputs['brizziCardNo']
  ];

  $response = fetchValidateCardNumber(
    $clientSecret,
    $baseUrl,
    $accessToken,
    $timestamp,
    $body
  );

  echo htmlspecialchars($response, ENT_QUOTES, 'UTF-8');
} catch (InvalidArgumentException $e) {
  // Handle specific exception
  error_log("Invalid argument: " . $e->getMessage());
} catch (RuntimeException $e) {
  // Handle runtime exception
  error_log("Runtime exception: " . $e->getMessage());
} catch (Exception $e) {
  // Fallback for unexpected exceptions
  error_log("Generic exception: " . $e->getMessage());
  exit(1);
}

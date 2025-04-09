<?php

namespace PayPalRestApi\Core;

class ApiException extends \Exception
{
    private $responseBody;
    private $responseCode;

    public function __construct(string $message, int $code = 0, \Exception $previous = null, $responseBody = null, $responseCode = null)
    {
        parent::__construct($message, $code, $previous);
        $this->responseBody = $responseBody;
        $this->responseCode = $responseCode;
    }

    // Getter for response body
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    // Getter for response code
    public function getResponseCode()
    {
        return $this->responseCode;
    }
    
    // Optionally, add a custom string representation
    public function __toString()
    {
        return sprintf(
            "[%s]: %s (Response: %d)\n%s",
            $this->code,
            $this->message,
            $this->responseCode,
            $this->responseBody
        );
    }
}

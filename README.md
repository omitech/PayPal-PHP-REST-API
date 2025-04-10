# PayPal REST API PHP Integration

This repository contains a simple PHP wrapper for integrating PayPal's REST API to create and capture orders. It leverages GuzzleHttp for making HTTP requests to PayPal's API.

## Prerequisites

- PHP >= 8.0
- Composer (for dependency management)
- PayPal API credentials: Client ID and Secret Key

## Features

- Create and manage PayPal subscription plans or single orders .
- Handle user subscriptions (create, update, cancel).
- Handle oders (create, capture).
- Verify and process PayPal webhooks for subscription updates.
- Custom exception handling for API errors.

This package supports only limited number of operaions, mainly focused on digital subscriptions.

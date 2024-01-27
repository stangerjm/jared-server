<?php

include 'email.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

sendEmail(
  requiredFields: array('email', 'firstName', 'lastName'),
  buildMessage: function($data) {
    return "FirstName,LastName,Email
            {$data['firstName']},{$data['lastName']},{$data['email']}";
  },
  buildSubject: function($data) {
    return "Newsletter Request: {$data['firstName']} {$data['lastName']}";
  },
);

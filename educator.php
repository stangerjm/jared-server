<?php

include 'email.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

sendEmail(
  requiredFields: array('email', 'firstName', 'lastName', 'body', 'school'),
  buildMessage: function($data) {
    return "From: {$data['email']}
  {$data['body']}";
  },
  buildSubject: function($data) {
    return "Educator Request: {$data['firstName']} {$data['lastName']} - {$data['school']}";
  },
);

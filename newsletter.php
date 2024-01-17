<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

function sendEmail() {
  $data = json_decode(file_get_contents('php://input'), true);

  if (!isset($data['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'No email was specified.']);
    return;
  }

  if (!isset($data['firstName'])) {
    echo json_encode(['status' => 'error', 'message' => 'No first name was specified.']);
    return;
  }

  if (!isset($data['lastName'])) {
    echo json_encode(['status' => 'error', 'message' => 'No last name was specified.']);
    return;
  }

  $success = mail(to: 'jaredeverettbell@gmail.com', message: $data['email'], subject: 'Test');

  if (!$success) {
    echo json_encode(['status' => 'error', 'message' => 'Could not send email. Please try again later.']);
    return;
  }

  echo json_encode(['status' => 'success', 'message' => 'Email sent successfully.']);
}

sendEmail();

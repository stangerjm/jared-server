<?php

function isEmpty($field) {
  return !isset($field) || empty($field);
}

function sendEmail($requiredFields, callable $buildMessage, callable $buildSubject) {
  $data = json_decode(file_get_contents('php://input'), true);
  $errors = [];

  // loop through each field and verify it exists
  foreach($requiredFields as $field) {
    if (isEmpty($data[$field])) {
      $errors[] = ['message' => "No {$field} was specified."];
    }
  }

  // if there are errors, return a 400 and each error found
  if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'errors' => $errors]);
    return;
  }

  $success = mail(
    to: 'jaredeverettbell@gmail.com',
    message: $buildMessage($data),
    subject: $buildSubject($data),
  );

  // if sending the email was unsuccessful somehow, return a 500 and a message
  if (!$success) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'errors' => [['message' => 'Could not send email. Please try again later.']]]);
    return;
  }

  // if all goes well, return a 200 and indicate a success
  echo json_encode(['status' => 'success']);
}

<?php
header('Content-Type: application/json');

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

// Get the JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Validate input
if (empty($input['event_type']) || empty($input['event_details']) || 
    empty($input['tone']) || empty($input['recipient_email']) || empty($input['invitation'])) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

// Sanitize inputs
$eventType = htmlspecialchars($input['event_type']);
$eventDetails = htmlspecialchars($input['event_details']);
$tone = htmlspecialchars($input['tone']);
$recipientEmail = filter_var($input['recipient_email'], FILTER_SANITIZE_EMAIL);
$invitation = $input['invitation']; // Already HTML, no need to escape

// Validate email
if (!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Invalid email address']);
    exit;
}

// Create email subject
$subject = "Invitation for " . ucfirst($eventType) . " Event";

// Create email headers
$headers = "From:alakshya722@gmail.com\r\n";
$headers .= "Reply-To: no-reply@aiinvite.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Send the email
$mailSent = mail($recipientEmail, $subject, $invitation, $headers);

if ($mailSent) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to send email. Check server mail logs.']);
}
?>
<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Invitation Generator - Create</title>
    <!-- Add Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Add Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .logo {
            font-family: 'Playfair Display', serif;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }
        
        .create-invitation {
            max-width: 900px;
            margin: 0 auto;
            animation: fadeIn 0.8s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        #invitation-form {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        
        #invitation-form:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(106, 17, 203, 0.25);
        }
        
        .btn {
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
        }
        
        .btn-success {
            background: linear-gradient(45deg, #2ecc71, #27ae60);
            border: none;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-100%);
            transition: all 0.3s ease;
        }
        
        .btn:hover::after {
            transform: translateX(0);
        }
        
        .loader {
            display: none;
        }
        
        .loader img {
            filter: drop-shadow(0 0 10px rgba(106, 17, 203, 0.3));
        }
        
        .invitation-card {
            perspective: 1000px;
            transition: all 0.5s ease;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transform-style: preserve-3d;
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            background: white;
            position: relative;
        }
        
        .card-header {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .invitation-content {
            background: white;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }
        
        .invitation-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/light-paper-fibers.png');
            opacity: 0.1;
            z-index: 0;
        }
        
        .invitation-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .invitation-greeting {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--dark-color);
            margin-bottom: 30px;
        }
        
        .invitation-details {
            background: rgba(233, 236, 239, 0.5);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .invitation-details li {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        
        .invitation-details strong {
            color: var(--primary-color);
        }
        
        .invitation-footer {
            font-family: 'Dancing Script', cursive;
            font-size: 1.8rem;
            color: var(--secondary-color);
            margin-top: 30px;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: var(--accent-color);
            opacity: 0;
        }
        
        footer {
            background: linear-gradient(45deg, var(--dark-color), #343a40);
        }
        
        .nav-link.active {
            position: relative;
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 15px;
            width: calc(100% - 30px);
            height: 2px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <header class="bg-dark text-white py-3 shadow-lg">
        <nav class="container d-flex justify-content-between align-items-center">
            <div class="logo fs-3 fw-bold">AI Invite</div>
            <ul class="nav">
                <li class="nav-item"><a href="index.php" class="nav-link text-white"><i class="fas fa-home me-2"></i>Home</a></li>
                <li class="nav-item"><a href="create.php" class="nav-link text-white active"><i class="fas fa-plus-circle me-2"></i>Create Invitation</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="create-invitation py-5">
            <div class="container">
                <h1 class="text-center display-5 fw-bold mb-4 animate__animated animate__fadeInDown">Create Your <span class="text-gradient">Invitation</span></h1>
                <form id="invitation-form" class="p-4 rounded">
                    <div class="mb-4">
                        <label for="event-type" class="form-label fw-bold"><i class="fas fa-calendar-alt me-2"></i>Event Type</label>
                        <select id="event-type" name="event_type" class="form-select" required>
                            <option value="" disabled selected>Select event type</option>
                            <option value="birthday">Birthday Party</option>
                            <option value="wedding">Wedding</option>
                            <option value="anniversary">Anniversary</option>
                            <option value="baby-shower">Baby Shower</option>
                            <option value="corporate">Corporate Event</option>
                            <option value="graduation">Graduation</option>
                            <option value="retirement">Retirement Party</option>
                            <option value="holiday">Holiday Party</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="event-details" class="form-label fw-bold"><i class="fas fa-info-circle me-2"></i>Event Details</label>
                        <textarea id="event-details" name="event_details" class="form-control" rows="3" placeholder="Enter event details (date, time, location, dress code, etc.)" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="tone" class="form-label fw-bold"><i class="fas fa-comment me-2"></i>Tone</label>
                        <select id="tone" name="tone" class="form-select" required>
                            <option value="" disabled selected>Select tone</option>
                            <option value="formal">Formal</option>
                            <option value="casual">Casual</option>
                            <option value="fun">Fun & Playful</option>
                            <option value="elegant">Elegant</option>
                            <option value="whimsical">Whimsical</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="recipient-email" class="form-label fw-bold"><i class="fas fa-envelope me-2"></i>Recipient Email</label>
                        <input type="email" id="recipient-email" name="recipient_email" class="form-control" placeholder="Enter recipient's email" required>
                    </div>
                    
                    <div class="d-flex gap-3 mt-4">
                        <button type="button" id="generate-btn" class="btn btn-primary flex-grow-1 py-3 animate__animated animate__pulse animate__infinite">
                            <i class="fas fa-magic me-2"></i>Generate Invitation
                        </button>
                        <button type="button" id="send-btn" class="btn btn-success flex-grow-1 py-3" disabled>
                            <i class="fas fa-paper-plane me-2"></i>Send Invitation
                        </button>
                    </div>
                </form>
                
                <div id="loader" class="loader text-center my-5">
                    <img src="https://i.gifer.com/origin/b4/b4d657e7ef262b88eb5f7ac021edda87.gif" alt="Loading..." width="100" class="floating">
                    <p class="mt-3 fw-bold text-muted">Generating your beautiful invitation...</p>
                </div>
                
                <div id="invitation-card" class="invitation-card mt-5" style="display: none;">
                    <div class="card">
                        <div class="card-header text-white text-center py-3">
                            <h3 class="card-title mb-0"><i class="fas fa-envelope-open-text me-2"></i>Your Invitation</h3>
                        </div>
                        <div class="card-body">
                            <div id="invitation-content" class="invitation-content"></div>
                        </div>
                        <div class="card-footer text-center text-muted py-3">
                            <small>Created with ❤️ by AI Invitation Generator</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p class="mb-0">© 2025 AI Invitation Generator. All rights reserved.</p>
    </footer>
    
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sendBtn = document.getElementById('send-btn');
            const invitationForm = document.getElementById('invitation-form');

            sendBtn.addEventListener('click', function () {
                // Disable the button to prevent multiple clicks
                sendBtn.disabled = true;
                sendBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...';

                // Collect form data
                const formData = {
                    event_type: document.getElementById('event-type').value,
                    event_details: document.getElementById('event-details').value,
                    tone: document.getElementById('tone').value,
                    recipient_email: document.getElementById('recipient-email').value,
                    invitation: document.getElementById('invitation-content').innerHTML
                };

                // Send data to the server
                fetch('send_invitation.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            alert('Invitation sent successfully!');
                        } else {
                            // Show error message
                            alert('Failed to send invitation: ' + data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while sending the invitation.');
                    })
                    .finally(() => {
                        // Restore the button
                        sendBtn.disabled = false;
                        sendBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Send Invitation';
                    });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const generateBtn = document.getElementById('generate-btn');
            const sendBtn = document.getElementById('send-btn');
            const invitationForm = document.getElementById('invitation-form');
            const loader = document.getElementById('loader');
            const invitationCard = document.getElementById('invitation-card');
            const invitationContent = document.getElementById('invitation-content');
            
            // Add floating animation to form inputs on focus
            const inputs = document.querySelectorAll('.form-control, .form-select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('animate__animated', 'animate__pulse');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('animate__animated', 'animate__pulse');
                });
            });
            
            generateBtn.addEventListener('click', function() {
                // Validate form
                if (!invitationForm.checkValidity()) {
                    invitationForm.reportValidity();
                    return;
                }
                
                // Show loader
                loader.style.display = 'block';
                invitationCard.style.display = 'none';
                generateBtn.classList.remove('animate__pulse');
                
                // Add loading animation to button
                generateBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Generating...';
                
                // Simulate processing delay
                setTimeout(function() {
                    // Hide loader
                    loader.style.display = 'none';
                    
                    // Restore generate button
                    generateBtn.innerHTML = '<i class="fas fa-magic me-2"></i>Generate Invitation';
                    generateBtn.classList.add('animate__pulse');
                    
                    // Get form values
                    const eventType = document.getElementById('event-type').value;
                    const eventDetails = document.getElementById('event-details').value;
                    const tone = document.getElementById('tone').value;
                    const recipientEmail = document.getElementById('recipient-email').value;
                    
                    // Generate invitation content based on form inputs
                    let invitationText = generateInvitation(eventType, eventDetails, tone, recipientEmail);
                    
                    // Display the invitation with animation
                    invitationContent.innerHTML = invitationText;
                    invitationCard.style.display = 'block';
                    invitationCard.classList.add('animate__animated', 'animate__fadeInUp');
                    
                    // Enable send button
                    sendBtn.disabled = false;
                    sendBtn.classList.add('animate__pulse');
                    
                    // Add confetti effect
                    createConfetti();
                }, 2000);
            });
            
            sendBtn.addEventListener('click', function() {
                // Add sending animation
                sendBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...';
                
                // Simulate sending delay
                setTimeout(function() {
                    // Show success message
                    const toast = document.createElement('div');
                    toast.className = 'position-fixed bottom-0 end-0 p-3';
                    toast.style.zIndex = '11';
                    toast.innerHTML = `
                        <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header bg-success text-white">
                                <strong class="me-auto"><i class="fas fa-check-circle me-2"></i>Success</strong>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body bg-light">
                                Invitation sent successfully to ${document.getElementById('recipient-email').value}!
                            </div>
                        </div>
                    `;
                    document.body.appendChild(toast);
                    
                    // Remove toast after 5 seconds
                    setTimeout(() => {
                        toast.remove();
                    }, 5000);
                    
                    // Restore send button
                    sendBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Send Invitation';
                }, 1500);
            });
            
            function generateInvitation(eventType, details, tone, recipient) {
                // Parse details (assuming format: date, time, location)
                const detailsParts = details.split(',');
                const date = detailsParts[0]?.trim() || 'To be determined';
                const time = detailsParts[1]?.trim() || 'To be determined';
                const location = detailsParts[2]?.trim() || 'To be determined';
                const dressCode = detailsParts[3]?.trim() || 'No specific dress code';
                
                // Determine greeting based on tone
                let greeting = '';
                let greetingStyle = '';
                if (tone === 'formal') {
                    greeting = 'Dear Guest,';
                    greetingStyle = 'font-weight: 500; color: #343a40;';
                } else if (tone === 'casual') {
                    greeting = 'Hey there!';
                    greetingStyle = 'font-weight: 600; color: #6a11cb;';
                } else if (tone === 'fun') {
                    greeting = '🎉 Party Alert! 🎉';
                    greetingStyle = 'font-weight: 700; color: #ff6b6b;';
                } else if (tone === 'elegant') {
                    greeting = 'Dearest Friend,';
                    greetingStyle = 'font-weight: 500; font-style: italic; color: #6a11cb;';
                } else {
                    greeting = 'Hello!';
                    greetingStyle = 'font-weight: 600; color: #2575fc;';
                }
                
                // Determine event type name and icon
                let eventName = '';
                let eventIcon = '';
                switch(eventType) {
                    case 'birthday':
                        eventName = 'Birthday Celebration';
                        eventIcon = 'fas fa-birthday-cake';
                        break;
                    case 'wedding':
                        eventName = 'Wedding Ceremony';
                        eventIcon = 'fas fa-ring';
                        break;
                    case 'anniversary':
                        eventName = 'Anniversary Party';
                        eventIcon = 'fas fa-heart';
                        break;
                    case 'baby-shower':
                        eventName = 'Baby Shower';
                        eventIcon = 'fas fa-baby';
                        break;
                    case 'corporate':
                        eventName = 'Corporate Event';
                        eventIcon = 'fas fa-briefcase';
                        break;
                    case 'graduation':
                        eventName = 'Graduation Party';
                        eventIcon = 'fas fa-graduation-cap';
                        break;
                    case 'retirement':
                        eventName = 'Retirement Party';
                        eventIcon = 'fas fa-golf-ball';
                        break;
                    case 'holiday':
                        eventName = 'Holiday Gathering';
                        eventIcon = 'fas fa-holly-berry';
                        break;
                    default:
                        eventName = 'Special Event';
                        eventIcon = 'fas fa-star';
                }
                
                // Generate the invitation HTML
                return `
                    <div class="text-center mb-4">
                        <i class="${eventIcon} fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h2 class="invitation-title">${eventName}</h2>
                        <p class="invitation-greeting" style="${greetingStyle}">${greeting}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-center mb-4" style="font-size: 1.1rem;">You are cordially invited to join us for this special occasion. We would be delighted by your presence!</p>
                        <div class="invitation-details">
                            <ul class="list-unstyled">
                                <li><strong><i class="fas fa-calendar-day me-2"></i>Date:</strong> ${date}</li>
                                <li><strong><i class="fas fa-clock me-2"></i>Time:</strong> ${time}</li>
                                <li><strong><i class="fas fa-map-marker-alt me-2"></i>Location:</strong> ${location}</li>
                                <li><strong><i class="fas fa-tshirt me-2"></i>Dress Code:</strong> ${dressCode}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <p style="font-size: 1.1rem;">Please RSVP by replying to this email.</p>
                        <p class="invitation-footer">We look forward to seeing you!</p>
                        <p class="mt-3"><strong>The Host</strong></p>
                    </div>
                `;
            }
            
            function createConfetti() {
                const colors = ['#6a11cb', '#2575fc', '#ff6b6b', '#2ecc71', '#f39c12'];
                const container = document.getElementById('invitation-card');
                
                for (let i = 0; i < 50; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + '%';
                    confetti.style.top = -10 + 'px';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                    confetti.style.width = Math.random() * 8 + 5 + 'px';
                    confetti.style.height = Math.random() * 8 + 5 + 'px';
                    container.appendChild(confetti);
                    
                    const animationDuration = Math.random() * 3 + 2;
                    
                    confetti.animate([
                        { transform: `translateY(0) rotate(0deg)`, opacity: 1 },
                        { transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 360}deg)`, opacity: 0 }
                    ], {
                        duration: animationDuration * 1000,
                        easing: 'cubic-bezier(0.1, 0.8, 0.3, 1)',
                        delay: Math.random() * 2000
                    });
                    
                    setTimeout(() => {
                        confetti.remove();
                    }, animationDuration * 1000);
                }
            }
        });
    </script>
</body>
</html>
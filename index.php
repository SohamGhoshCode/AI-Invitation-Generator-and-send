<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Invitation Generator - Home</title>
    <!-- Add Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="bg-dark text-white py-3">
        <nav class="container d-flex justify-content-between align-items-center">
            <div class="logo fs-4 fw-bold">AI Invite</div>
            <ul class="nav">
                <li class="nav-item"><a href="index.php" class="nav-link text-white active"><i class="fas fa-home me-2"></i>Home</a></li>
                <li class="nav-item"><a href="create.php" class="nav-link text-white"><i class="fas fa-plus-circle me-2"></i>Create Invitation</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero text-center py-5">
            <div class="container">
                <h1 class="display-4 fw-bold mb-4">Create Stunning Invitations with AI</h1>
                <p class="lead mb-5">Design personalized invitations effortlessly and send them via email with our AI-powered platform.</p>
                <a href="create.php" class="btn btn-primary btn-lg mt-3 btn-hero">
                    <i class="fas fa-rocket me-2"></i>Get Started Now
                </a>
            </div>
        </section>

        <section class="features py-5">
            <div class="container">
                <h2 class="text-center mb-5">Why Choose Our Invitation Generator?</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="feature-icon mb-4">
                                    <i class="fas fa-bolt fa-3x text-primary"></i>
                                </div>
                                <h3 class="h4 mb-3">Lightning Fast</h3>
                                <p class="text-muted">Generate beautiful invitations in seconds with our powerful AI technology.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="feature-icon mb-4">
                                    <i class="fas fa-palette fa-3x text-primary"></i>
                                </div>
                                <h3 class="h4 mb-3">Customizable</h3>
                                <p class="text-muted">Choose from various tones and styles to match your event perfectly.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="feature-icon mb-4">
                                    <i class="fas fa-paper-plane fa-3x text-primary"></i>
                                </div>
                                <h3 class="h4 mb-3">Easy Sharing</h3>
                                <p class="text-muted">Send invitations directly to your guests via email with just one click.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="how-it-works py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">How It Works</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="step text-center">
                            <div class="step-number">1</div>
                            <h3 class="h4 mb-3">Enter Event Details</h3>
                            <p>Fill in your event information, including type, date, and location.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step text-center">
                            <div class="step-number">2</div>
                            <h3 class="h4 mb-3">AI Generates Invitation</h3>
                            <p>Our AI crafts a perfect invitation based on your specifications.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step text-center">
                            <div class="step-number">3</div>
                            <h3 class="h4 mb-3">Send to Guests</h3>
                            <p>Email the invitation directly to your guests with one click.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© 2025 AI Invitation Generator. All rights reserved.</p>
    </footer>
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
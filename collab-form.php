<?php
$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $pen_name = trim($_POST['pen-name'] ?? '');
    $real_name = trim($_POST['real-name'] ?? '');
    $previous_works = trim($_POST['previous-works'] ?? '');
    $why_collab = trim($_POST['why-collab'] ?? '');
    $portfolio_url = trim($_POST['portfolio-url'] ?? '');
    
    // Validate inputs
    $errors = [];
    
    if (empty($pen_name)) {
        $errors[] = "Pen name is required";
    }
    
    if (empty($real_name)) {
        $errors[] = "Real name is required";
    }
    
    if (empty($previous_works)) {
        $errors[] = "Previous works information is required";
    }
    
    if (empty($why_collab)) {
        $errors[] = "Please explain why you want to collaborate";
    }
    
    if (empty($portfolio_url)) {
        $errors[] = "Portfolio URL is required";
    } elseif (!filter_var($portfolio_url, FILTER_VALIDATE_URL)) {
        $errors[] = "Please enter a valid URL";
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        // Here you would typically send an email or save to database
        // For now, we'll just show a success message
        $success_message = "Thank you for your collaboration request! We'll review your application and get back to you soon.";
        
        // Clear the form
        $pen_name = $real_name = $previous_works = $why_collab = $portfolio_url = '';
    } else {
        $error_message = implode("<br>", $errors);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaboration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background Video */
        .video-back {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .video-back video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.7;
        }

        /* Form Container */
        .collab-form {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .collab-form h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 20px;
            color: white;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body class="text-light bg-dark">
    
    <!-- Background Video -->
    <div class="video-back">
        <video autoplay muted loop>
            <source src="cexp.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Collaboration Form -->
    <div class="container">
        <div class="collab-form">
            <h2>Collaboration Form</h2>
            
            <?php if ($success_message): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            
            <?php if ($error_message): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Pen Name -->
                <div class="mb-3">
                    <label for="pen-name" class="form-label text-light">Pen Name</label>
                    <input type="text" id="pen-name" name="pen-name" class="form-control" 
                           placeholder="Enter your pen name" 
                           value="<?php echo htmlspecialchars($pen_name ?? ''); ?>">
                </div>

                <!-- Who Are You -->
                <div class="mb-3">
                    <label for="real-name" class="form-label text-light">Who are you?</label>
                    <input type="text" id="real-name" name="real-name" class="form-control" 
                           placeholder="Say about yourself, Who you really are?"
                           value="<?php echo htmlspecialchars($real_name ?? ''); ?>">
                </div>

                <!-- Previous Works -->
                <div class="mb-3">
                    <label for="previous-works" class="form-label text-light">Previous Works</label>
                    <textarea id="previous-works" name="previous-works" class="form-control" rows="3" 
                              placeholder="Tell me about your previous works"><?php echo htmlspecialchars($previous_works ?? ''); ?></textarea>
                </div>

                <!-- Why Collaborate -->
                <div class="mb-3">
                    <label for="why-collab" class="form-label text-light">Why do you want to collaborate with me?</label>
                    <textarea id="why-collab" name="why-collab" class="form-control" rows="3" 
                              placeholder="Explain why you want to work with me"><?php echo htmlspecialchars($why_collab ?? ''); ?></textarea>
                </div>

                <!-- Portfolio URL -->
                <div class="mb-3">
                    <label for="portfolio-url" class="form-label text-light">Portfolio URL</label>
                    <input type="url" id="portfolio-url" name="portfolio-url" class="form-control" 
                           placeholder="Provide a link to your portfolio"
                           value="<?php echo htmlspecialchars($portfolio_url ?? ''); ?>">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
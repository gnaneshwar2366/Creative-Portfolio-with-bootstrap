<?php
$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validate inputs
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (!preg_match("/^[A-Za-z\s]+$/", $name)) {
        $errors[] = "Only letters are allowed in Name";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        // Here you would typically send an email or save to database
        // For now, we'll just show a success message
        $success_message = "Thank you for your message! We'll get back to you soon.";
        
        // Clear the form
        $name = $email = $message = '';
    } else {
        $error_message = implode("<br>", $errors);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Georgia, 'Times New Roman', Times, serif;
            color: #333;
            text-align: center;
            background-color: #f0f0f0;
            background-image: linear-gradient(45deg, rgba(0,0,0,0.6) 25%, transparent 25%), 
                              linear-gradient(-45deg, rgba(0,0,0,0.6) 25%, transparent 25%);
            background-size: 4px 4px;  
            background-position: 0 0, 20px 20px; 
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('minx.jpg'); 
            background-size: cover;
            background-position: center;
            animation: changeBackground 30s infinite;
            z-index: -1;
        }

        @keyframes changeBackground {
            0% { background-image: url('minx.jpg'); }
            20% { background-image: url('min0.jpg'); }
            40% { background-image: url('min1.jpg'); }
            60% { background-image: url('min3.jpg'); }
            80% { background-image: url('min2.jpg'); }
            100% { background-image: url('min.jpg'); }
        }

        .navbar {
            position: fixed;
            top: 20px;
            left: 20px; 
            z-index: 1000;
        }

        .navbar .logo-img {
            width: 150px; 
            height: auto;
        }

        .contact-form {
            max-width: 600px;
            margin: 100px auto;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.6); 
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .contact-form .form-control {
            background-color: rgba(249, 249, 249, 0.8);
        }

        .contact-form .form-control:focus {
            border-color: #007bff;
            outline: none;
        }

        .contact-form .btn-primary {
            width: 100%;
            padding: 12px;
            font-size: 18px;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    
    <div class="navbar">
        <a href="intro.html">
            <img src="clogo.png" alt="logo" class="logo-img">
        </a>
    </div>

    <div class="container">
        <div class="contact-form">
            <h2 class="fw-bold text-center">Contact Us</h2>
            
            <?php if ($success_message): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            
            <?php if ($error_message): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" 
                           value="<?php echo htmlspecialchars($name ?? ''); ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email"
                           value="<?php echo htmlspecialchars($email ?? ''); ?>">
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea id="message" name="message" class="form-control" rows="3" placeholder="Enter your message"><?php echo htmlspecialchars($message ?? ''); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
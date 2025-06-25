<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            color: white;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
            font-size: 1rem;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .success-message {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .error-message {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
        }

        .user-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            border-left: 4px solid #667eea;
        }

        .user-info h3 {
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .info-item i {
            margin-right: 10px;
            color: #667eea;
            width: 20px;
        }

        .back-btn {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        .form-icon {
            text-align: center;
            font-size: 4rem;
            color: #667eea;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .form-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to main page
        </a>

        <div class="header">
            <h1><i class="fas fa-user-plus"></i> Add New User</h1>
            <p>Fill out the form to add a new user to the system</p>
        </div>

        <div class="form-card">
            <div class="form-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            
            <h2 class="form-title">User Registration Form</h2>

            <form method="post" action="">
                <div class="form-group">
                    <label for="fname">
                        <i class="fas fa-user"></i> Full Name:
                    </label>
                    <input type="text" id="fname" name="fname" placeholder="Enter full name" required>
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i> Email Address:
                    </label>
                    <input type="email" id="email" name="email" placeholder="Enter email address" required>
                </div>

                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> Add User
                </button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                // Include database configuration
                require_once 'config.php';

                try 
                {
                    $pdo = getDBConnection();

                    $subscriber_name = trim($_POST['fname']);
                    $email = trim($_POST['email']);

                    // Data validation
                    if (empty($subscriber_name) || empty($email)) {
                        echo '<div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                All fields are required!
                              </div>';
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo '<div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                Invalid email format!
                              </div>';
                    } else {
                        // Check if email already exists
                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM subscribers WHERE email = :email");
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();
                        
                        if ($stmt->fetchColumn() > 0) {
                            echo '<div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    User with this email address already exists!
                                  </div>';
                        } else {
                            $stmt = $pdo->prepare("INSERT INTO subscribers (fname, email) VALUES (:fname, :email)");
                            $stmt->bindParam(':fname', $subscriber_name);
                            $stmt->bindParam(':email', $email);
                            $stmt->execute();

                            echo '<div class="success-message">
                                    <i class="fas fa-check-circle"></i>
                                    User has been successfully added to the database!
                                  </div>';

                            // Add audit entry
                            $stmt_audit = $pdo->prepare("INSERT INTO audit_subscribers (subscriber_name, action_performed) VALUES (:subscriber_name, 'Insert a new subscriber')");
                            $stmt_audit->bindParam(':subscriber_name', $subscriber_name);
                            $stmt_audit->execute();

                            // Display added user information
                            echo '<div class="user-info">
                                    <h3><i class="fas fa-info-circle"></i> Added Data:</h3>
                                    <div class="info-item">
                                        <i class="fas fa-user"></i>
                                        <strong>Name:</strong> ' . htmlspecialchars($subscriber_name) . '
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-envelope"></i>
                                        <strong>Email:</strong> ' . htmlspecialchars($email) . '
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-clock"></i>
                                        <strong>Date Added:</strong> ' . date('Y-m-d H:i:s') . '
                                    </div>
                                  </div>';
                        }
                    }
                } 
                catch (Exception $e) 
                {
                    echo '<div class="error-message">
                            <i class="fas fa-exclamation-triangle"></i>
                            Database Error: ' . htmlspecialchars($e->getMessage()) . '
                          </div>';
                }
            }
            ?>
        </div>
    </div>

    <script>
        // Form animation
        document.addEventListener('DOMContentLoaded', function() {
            const formCard = document.querySelector('.form-card');
            formCard.style.opacity = '0';
            formCard.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                formCard.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                formCard.style.opacity = '1';
                formCard.style.transform = 'translateY(0)';
            }, 100);
        });

        // Real-time validation
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                this.style.borderColor = '#f44336';
                this.style.boxShadow = '0 0 0 3px rgba(244, 67, 54, 0.1)';
            } else {
                this.style.borderColor = '#667eea';
                this.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.1)';
            }
        });
    </script>
</body>
</html>
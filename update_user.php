<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User - Management System</title>
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

        .result-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            text-align: center;
        }

        .success-message {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .error-message {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
        }

        .message-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .message-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .message-text {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .user-details {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin: 30px 0;
            border-left: 4px solid #667eea;
        }

        .user-details h3 {
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .detail-item i {
            margin-right: 15px;
            color: #667eea;
            width: 25px;
            font-size: 1.2rem;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
            margin-right: 10px;
        }

        .detail-value {
            color: #333;
        }

        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 15px 30px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
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

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .result-card {
                padding: 30px 20px;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="viewsubscribers.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to user list
        </a>

        <div class="header">
            <h1><i class="fas fa-user-edit"></i> Update User</h1>
            <p>User information update result</p>
        </div>

        <div class="result-card">
            <?php
            // Include database configuration
            require_once 'config.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                try {
                    $pdo = getDBConnection();

                    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
                        // Delete user
                        $id = $_POST['id'];
                        
                        // Get user data before deletion for audit
                        $stmt = $pdo->prepare("SELECT fname FROM subscribers WHERE id = :id");
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($user) {
                            // Delete the user
                            $stmt = $pdo->prepare("DELETE FROM subscribers WHERE id = :id");
                            $stmt->bindParam(':id', $id);
                            $stmt->execute();

                            // Add audit entry
                            $stmt_audit = $pdo->prepare("INSERT INTO audit_subscribers (subscriber_name, action_performed) VALUES (:subscriber_name, 'Deleted a subscriber')");
                            $stmt_audit->bindParam(':subscriber_name', $user['fname']);
                            $stmt_audit->execute();

                            header("Location: viewsubscribers.php?message=deleted");
                            exit();
                        }
                    } else {
                        // Update user
                        $id = $_POST['id'];
                        $fname = trim($_POST['fname']);
                        $email = trim($_POST['email']);

                        // Validation
                        if (empty($fname) || empty($email)) {
                            throw new Exception("All fields are required!");
                        }

                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            throw new Exception("Invalid email format!");
                        }

                        // Check if email exists for other users
                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM subscribers WHERE email = :email AND id != :id");
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        
                        if ($stmt->fetchColumn() > 0) {
                            throw new Exception("Email address already exists for another user!");
                        }

                        // Get old user data for audit
                        $stmt = $pdo->prepare("SELECT fname FROM subscribers WHERE id = :id");
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $oldUser = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Update user
                        $stmt = $pdo->prepare("UPDATE subscribers SET fname = :fname, email = :email WHERE id = :id");
                        $stmt->bindParam(':fname', $fname);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();

                        // Add audit entry
                        $stmt_audit = $pdo->prepare("INSERT INTO audit_subscribers (subscriber_name, action_performed) VALUES (:subscriber_name, 'Updated a subscriber')");
                        $stmt_audit->bindParam(':subscriber_name', $oldUser['fname']);
                        $stmt_audit->execute();

                        header("Location: viewsubscribers.php?message=updated");
                        exit();
                    }

                } catch (Exception $e) {
                    header("Location: viewsubscribers.php?error=" . urlencode($e->getMessage()));
                    exit();
                }
            } else {
                header("Location: viewsubscribers.php");
                exit();
            }
            ?>

            <div class="action-buttons">
                <a href="viewsubscribers.php" class="btn btn-primary">
                    <i class="fas fa-list"></i> Back to User List
                </a>
                <a href="add_user.php" class="btn btn-secondary">
                    <i class="fas fa-user-plus"></i> Add New User
                </a>
            </div>
        </div>
    </div>

    <script>
        // Page animation
        document.addEventListener('DOMContentLoaded', function() {
            const resultCard = document.querySelector('.result-card');
            resultCard.style.opacity = '0';
            resultCard.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                resultCard.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                resultCard.style.opacity = '1';
                resultCard.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>

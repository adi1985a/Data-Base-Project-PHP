<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User - Management System</title>
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

        .delete-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            text-align: center;
        }

        .warning-icon {
            font-size: 4rem;
            color: #f44336;
            margin-bottom: 20px;
        }

        .delete-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .delete-message {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .user-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            border-left: 4px solid #f44336;
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
            color: #f44336;
            width: 20px;
        }

        .btn {
            padding: 15px 40px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
        }

        .btn-danger {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
            border: none;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(244, 67, 54, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            border: none;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
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
            
            .delete-card {
                padding: 30px 20px;
            }
            
            .btn {
                display: block;
                width: 100%;
                margin: 10px 0;
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
            <h1><i class="fas fa-user-times"></i> Delete User</h1>
            <p>Remove user from the system</p>
        </div>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Include database configuration
            require_once 'config.php';

            try {
                $pdo = getDBConnection();

                // Get user data before deletion for audit
                $stmt = $pdo->prepare("SELECT * FROM subscribers WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    echo '<div class="user-info">
                            <h3><i class="fas fa-exclamation-triangle"></i> User to be deleted:</h3>
                            <div class="info-item">
                                <i class="fas fa-id-card"></i>
                                <strong>User ID:</strong> ' . $user['id'] . '
                            </div>
                            <div class="info-item">
                                <i class="fas fa-user"></i>
                                <strong>Name:</strong> ' . htmlspecialchars($user['fname']) . '
                            </div>
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <strong>Email:</strong> ' . htmlspecialchars($user['email']) . '
                            </div>
                          </div>';

                    echo '<form method="post" action="update_user.php">
                            <input type="hidden" name="id" value="' . $user['id'] . '">
                            <input type="hidden" name="action" value="delete">
                            
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-question-circle"></i> Are you sure you want to delete this user?
                                </label>
                            </div>

                            <button type="submit" class="btn" style="background: linear-gradient(135deg, #f44336, #d32f2f);">
                                <i class="fas fa-trash"></i> Confirm Delete
                            </button>
                          </form>';
                } else {
                    echo '<div class="error-message">
                            <i class="fas fa-exclamation-triangle"></i>
                            User not found!
                          </div>';
                }
            } catch (Exception $e) {
                echo '<div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        Database Error: ' . htmlspecialchars($e->getMessage()) . '
                      </div>';
            }
        } else {
            echo '<div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    No user ID provided!
                  </div>';
        }
        ?>
    </div>

    <script>
        // Card animation
        document.addEventListener('DOMContentLoaded', function() {
            const deleteCard = document.querySelector('.delete-card');
            deleteCard.style.opacity = '0';
            deleteCard.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                deleteCard.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                deleteCard.style.opacity = '1';
                deleteCard.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>


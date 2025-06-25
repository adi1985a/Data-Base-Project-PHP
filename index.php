<?php
// Start session at the very beginning
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System</title>
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
            max-width: 1200px;
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

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .card-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            display: block;
        }

        .card.users { color: #4CAF50; }
        .card.views { color: #2196F3; }
        .card.add { color: #FF9800; }
        .card.audit { color: #9C27B0; }

        .card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .card p {
            color: #666;
            line-height: 1.6;
        }

        .stats-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .stat-label {
            color: white !important;
            font-weight: 600 !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }

        .form-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-section h2 {
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .views-display {
            margin-top: 30px;
        }

        .view-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .view-table th,
        .view-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e1e5e9;
        }

        .view-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .view-table tr:hover {
            background: #f8f9fa;
        }

        .message {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .message.success {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .message.error {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
        }

        .db-error {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(255, 152, 0, 0.3);
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-users"></i> User Management System</h1>
            <p>Modern user management with advanced database views and audit system</p>
        </div>

        <?php
        // Include database configuration
        require_once 'config.php';
        
        // Check database connection
        try {
            $pdo = getDBConnection();
            
            // System statistics
            $stmt = $pdo->query("SELECT COUNT(*) FROM subscribers");
            $userCount = $stmt->fetchColumn();

            $stmt = $pdo->query("SELECT COUNT(*) FROM audit_subscribers");
            $auditCount = $stmt->fetchColumn();

            $stmt = $pdo->query("SHOW FULL TABLES WHERE TABLE_TYPE LIKE 'VIEW'");
            $viewCount = $stmt->rowCount();

            $stmt = $pdo->query("SELECT fname FROM subscribers ORDER BY id DESC LIMIT 1");
            $lastUser = $stmt->fetchColumn() ?: 'None';

        } catch (Exception $e) {
            echo '<div class="db-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Database Connection Error:</strong> ' . htmlspecialchars($e->getMessage()) . '
                    <br><br>
                    <strong>Please check:</strong>
                    <ul style="text-align: left; display: inline-block; margin-top: 10px;">
                        <li>XAMPP is running (Apache and MySQL)</li>
                        <li>Database "test" exists in phpMyAdmin</li>
                        <li>Database credentials in config.php are correct</li>
                        <li>Import bazadanych.sql to the "test" database</li>
                    </ul>
                  </div>';
            
            $userCount = $auditCount = $viewCount = 0;
            $lastUser = 'Connection Error';
        }
        ?>

        <div class="dashboard">
            <a href="viewsubscribers.php" class="card users">
                <i class="fas fa-list card-icon"></i>
                <h3>User List</h3>
                <p>Browse, edit and delete users from the system</p>
            </a>

            <a href="add_user.php" class="card add">
                <i class="fas fa-user-plus card-icon"></i>
                <h3>Add User</h3>
                <p>Add a new user to the database</p>
            </a>

            <a href="widoki.php" class="card views">
                <i class="fas fa-eye card-icon"></i>
                <h3>Database Views</h3>
                <p>Browse advanced views and reports</p>
            </a>

            <a href="audit.php" class="card audit">
                <i class="fas fa-history card-icon"></i>
                <h3>Audit History</h3>
                <p>Check the history of all operations in the system</p>
            </a>
        </div>

        <div class="stats-section">
            <h2><i class="fas fa-chart-bar"></i> System Statistics</h2>
            <div class="stats-grid">
                <div class="stat-item" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
                    <div class="stat-number" style="color: white;"><?php echo $userCount; ?></div>
                    <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Users</div>
                </div>
                <div class="stat-item" style="background: linear-gradient(135deg, #4CAF50, #45a049); color: white;">
                    <div class="stat-number" style="color: white;"><?php echo $auditCount; ?></div>
                    <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Audit Entries</div>
                </div>
                <div class="stat-item" style="background: linear-gradient(135deg, #FF9800, #f57c00); color: white;">
                    <div class="stat-number" style="color: white;"><?php echo $viewCount; ?></div>
                    <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Views</div>
                </div>
                <div class="stat-item" style="background: linear-gradient(135deg, #9C27B0, #7B1FA2); color: white;">
                    <div class="stat-number" style="color: white;"><?php echo $lastUser; ?></div>
                    <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Last User</div>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2><i class="fas fa-cogs"></i> Modify View</h2>
            
            <?php
            // Display session messages
            if (isset($_SESSION['view_result'])) {
                echo '<div class="message success">
                        <i class="fas fa-check-circle"></i>
                        ' . htmlspecialchars($_SESSION['view_result']) . '
                      </div>';
                unset($_SESSION['view_result']);
            }
            
            if (isset($_SESSION['view_error'])) {
                echo '<div class="message error">
                        <i class="fas fa-exclamation-triangle"></i>
                        ' . htmlspecialchars($_SESSION['view_error']) . '
                      </div>';
                unset($_SESSION['view_error']);
            }
            ?>

            <form action="process_data.php" method="post">
                <div class="form-group">
                    <label for="table_name">Table Name:</label>
                    <input type="text" id="table_name" name="table_name" placeholder="Enter table name" required>
                </div>

                <div class="form-group">
                    <label for="columns">Select Columns (comma separated):</label>
                    <input type="text" id="columns" name="columns" placeholder="e.g. subscriber_name, action_performed, date_added" required>
                    <small style="color: #666; margin-top: 5px; display: block;">
                        Allowed columns: subscriber_name, action_performed, date_added, id
                    </small>
                </div>

                <button type="submit" name="modify_view" class="btn">
                    <i class="fas fa-save"></i> Save View
                </button>
            </form>

            <?php
            if (isset($pdo)) {
                include('widoki.php');
            }
            ?>
        </div>
    </div>

    <script>
        // Card animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Statistics animation
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const finalNumber = stat.textContent;
                if (!isNaN(finalNumber)) {
                    stat.textContent = '0';
                    let currentNumber = 0;
                    const increment = parseInt(finalNumber) / 50;
                    
                    const timer = setInterval(() => {
                        currentNumber += increment;
                        if (currentNumber >= parseInt(finalNumber)) {
                            stat.textContent = finalNumber;
                            clearInterval(timer);
                        } else {
                            stat.textContent = Math.floor(currentNumber);
                        }
                    }, 30);
                }
            });

            // Auto-hide messages
            const messages = document.querySelectorAll('.message');
            messages.forEach(message => {
                setTimeout(() => {
                    message.style.transition = 'opacity 0.5s ease';
                    message.style.opacity = '0';
                    setTimeout(() => {
                        message.remove();
                    }, 500);
                }, 5000);
            });
        });
    </script>
</body>
</html>

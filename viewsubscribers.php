<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List - Management System</title>
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
            margin-bottom: 20px;
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

        .content-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .info-box {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .info-box h3 {
            margin-bottom: 10px;
            font-weight: 600;
        }

        .info-box p {
            opacity: 0.9;
            line-height: 1.6;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 15px;
            overflow: hidden;
        }

        .users-table th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 1rem;
        }

        .users-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #e1e5e9;
            transition: background-color 0.3s ease;
        }

        .users-table tr:hover {
            background: #f8f9fa;
        }

        .users-table tr:last-child td {
            border-bottom: none;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-edit, .btn-delete {
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-edit {
            background: #2196F3;
            color: white;
        }

        .btn-edit:hover {
            background: #1976D2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33, 150, 243, 0.3);
        }

        .btn-delete {
            background: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background: #d32f2f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .status-active {
            background: #4CAF50;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
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

        .add-user-btn {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .add-user-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
        }

        .no-users {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .no-users i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #ddd;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .content-card {
                padding: 20px;
            }
            
            .users-table {
                font-size: 0.9rem;
            }
            
            .users-table th,
            .users-table td {
                padding: 10px 15px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .stats-row {
                grid-template-columns: 1fr;
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
            <h1><i class="fas fa-users"></i> User List</h1>
            <p>Manage and view all users in the system</p>
        </div>

        <?php
        // Include database configuration
        require_once 'config.php';

        try {
            $pdo = getDBConnection();

            // Get user count
            $stmt = $pdo->query("SELECT COUNT(*) FROM subscribers");
            $userCount = $stmt->fetchColumn();

            // Get total audit entries
            $stmt = $pdo->query("SELECT COUNT(*) FROM audit_subscribers");
            $auditCount = $stmt->fetchColumn();

            // Get recent activity count (last 7 days)
            $stmt = $pdo->query("SELECT COUNT(*) FROM audit_subscribers WHERE date_added >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
            $recentActivity = $stmt->fetchColumn();

        } catch (Exception $e) {
            $userCount = $auditCount = $recentActivity = 0;
        }
        ?>

        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-number"><?php echo $userCount; ?></div>
                <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $auditCount; ?></div>
                <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Audit Entries</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $recentActivity; ?></div>
                <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Recent Activity</div>
            </div>
        </div>

        <div class="content-card">
            <div class="info-box">
                <h3><i class="fas fa-info-circle"></i> System Information</h3>
                <p>This page displays all registered users in the system. You can edit user information or delete users as needed. All actions are automatically logged in the audit system.</p>
            </div>

            <a href="add_user.php" class="add-user-btn">
                <i class="fas fa-user-plus"></i> Add New User
            </a>

            <div class="table-container">
            <?php
            // Include database configuration
            require_once 'config.php';

            try {
                $pdo = getDBConnection();

                // Statystyki
                $stmt = $pdo->query("SELECT COUNT(*) FROM subscribers");
                $totalUsers = $stmt->fetchColumn();

                $stmt = $pdo->query("SELECT COUNT(*) FROM audit_subscribers WHERE action_performed = 'Insert a new subscriber'");
                $totalAdded = $stmt->fetchColumn();

                $stmt = $pdo->query("SELECT COUNT(*) FROM audit_subscribers WHERE action_performed = 'Deleted a subscriber'");
                $totalDeleted = $stmt->fetchColumn();

                echo '<div class="stats-row">
                        <div class="stat-card">
                            <div class="stat-number">' . $totalUsers . '</div>
                            <div class="stat-label">Active Users</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">' . $totalAdded . '</div>
                            <div class="stat-label">Added Users</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">' . $totalDeleted . '</div>
                            <div class="stat-label">Deleted Users</div>
                        </div>
                      </div>';

                $stmt = $pdo->query("SELECT * FROM subscribers ORDER BY id DESC");
                $users = $stmt->fetchAll();

                if (count($users) > 0) {
                    echo '<div class="table-container">
                            <table class="users-table">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-hashtag"></i> #</th>
                                        <th><i class="fas fa-user"></i> User</th>
                                        <th><i class="fas fa-envelope"></i> Email</th>
                                        <th><i class="fas fa-calendar"></i> Status</th>
                                        <th><i class="fas fa-cogs"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>';

                    foreach ($users as $index => $user) {
                        $avatarInitial = strtoupper(substr($user['fname'], 0, 1));
                        echo '<tr>
                                <td>' . ($index + 1) . '</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 15px;">
                                        <div class="user-avatar">' . $avatarInitial . '</div>
                                        <div>
                                            <div style="font-weight: 600; color: #333;">' . htmlspecialchars($user['fname']) . '</div>
                                            <div style="font-size: 0.8rem; color: #666;">ID: ' . $user['id'] . '</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <i class="fas fa-envelope" style="color: #667eea;"></i>
                                        ' . htmlspecialchars($user['email']) . '
                                    </div>
                                </td>
                                <td>
                                    <span class="status-active">
                                        <i class="fas fa-check-circle"></i> Active
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="subscriber_edit.php?id=' . $user['id'] . '" class="btn-edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="subscriber_del.php?id=' . $user['id'] . '" class="btn-delete" 
                                           onclick="return confirm(\'Are you sure you want to delete user ' . htmlspecialchars($user['fname']) . '?\')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>';
                    }

                    echo '</tbody></table></div>';
                } else {
                    echo '<div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h3>No Users</h3>
                            <p>There are no users in the system yet. <a href="add_user.php" style="color: #667eea;">Add the first user</a></p>
                          </div>';
                }

            } catch (Exception $e) {
                echo '<div style="background: #f44336; color: white; padding: 20px; border-radius: 15px; text-align: center;">
                        <i class="fas fa-exclamation-triangle"></i>
                        Database connection error: ' . htmlspecialchars($e->getMessage()) . '
                      </div>';
            }
            ?>
        </div>
    </div>

    <script>
        // Animacja tabeli
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.querySelector('.users-table');
            if (table) {
                const rows = table.querySelectorAll('tbody tr');
                rows.forEach((row, index) => {
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-20px)';
                    setTimeout(() => {
                        row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                        row.style.opacity = '1';
                        row.style.transform = 'translateX(0)';
                    }, index * 100);
                });
            }

            // Animacja statystyk
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const finalNumber = stat.textContent;
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
            });
        });

        // Potwierdzenie usuwania
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Czy na pewno chcesz usunąć tego użytkownika?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>

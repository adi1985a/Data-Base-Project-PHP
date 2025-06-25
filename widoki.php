<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Views - Management System</title>
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

        .views-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: white !important;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }

        .views-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .view-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            border-left: 4px solid #667eea;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .view-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .view-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .view-description {
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .view-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            color: #667eea;
            font-weight: 500;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 15px;
            overflow: hidden;
        }

        .data-table th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 1rem;
        }

        .data-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #e1e5e9;
            transition: background-color 0.3s ease;
        }

        .data-table tr:hover {
            background: #f8f9fa;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .stats-section {
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
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: white;
        }

        .stat-label {
            color: white !important;
            font-weight: 600 !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .no-data i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #ddd;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .views-card {
                padding: 20px;
            }
            
            .views-grid {
                grid-template-columns: 1fr;
            }
            
            .data-table {
                font-size: 0.9rem;
            }
            
            .data-table th,
            .data-table td {
                padding: 10px 15px;
            }
            
            .stats-section {
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
            <h1><i class="fas fa-eye"></i> Database Views</h1>
            <p>Advanced views and reports for data analysis</p>
        </div>

        <?php
        // Include database configuration if not already included
        if (!function_exists('getDBConnection')) {
            require_once 'config.php';
        }

        // Get database connection
        try {
            $pdo = getDBConnection();
        } catch (Exception $e) {
            echo '<div style="background: #f44336; color: white; padding: 20px; border-radius: 15px; margin: 20px 0; text-align: center;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Database Error:</strong> ' . htmlspecialchars($e->getMessage()) . '
                  </div>';
            return;
        }

        // Get statistics
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM subscribers");
            $totalUsers = $stmt->fetchColumn();

            $stmt = $pdo->query("SELECT COUNT(*) FROM audit_subscribers");
            $totalAuditEntries = $stmt->fetchColumn();

            $stmt = $pdo->query("SELECT COUNT(*) FROM audit_subscribers WHERE action_performed = 'Deleted a subscriber'");
            $deletedUsers = $stmt->fetchColumn();

            $stmt = $pdo->query("SELECT COUNT(*) FROM audit_subscribers WHERE action_performed = 'Updated a subscriber' OR action_performed = 'Updated a user'");
            $updatedUsers = $stmt->fetchColumn();

        } catch (PDOException $e) {
            $totalUsers = $totalAuditEntries = $deletedUsers = $updatedUsers = 0;
        }
        ?>

        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-number"><?php echo $totalUsers; ?></div>
                <div class="stat-label" style="color: #333; font-weight: 600;">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $totalAuditEntries; ?></div>
                <div class="stat-label" style="color: #333; font-weight: 600;">Audit Entries</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $deletedUsers; ?></div>
                <div class="stat-label" style="color: #333; font-weight: 600;">Deleted Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $updatedUsers; ?></div>
                <div class="stat-label" style="color: #333; font-weight: 600;">Updated Users</div>
            </div>
        </div>

        <div class="views-card">
            <h2 class="card-title" style="color: #333; background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 15px; border-radius: 10px; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">
                <i class="fas fa-table"></i> Database Views
            </h2>

            <div class="views-grid">
                <div class="view-item">
                    <div class="view-title">Users View</div>
                    <div class="view-description">Shows all users with their registration dates in chronological order.</div>
                    <div class="view-stats">
                        <span><i class="fas fa-users"></i> All users</span>
                        <span>Chronological order</span>
                    </div>
                </div>

                <div class="view-item">
                    <div class="view-title">Existing Users View</div>
                    <div class="view-description">Displays currently active users in the system.</div>
                    <div class="view-stats">
                        <span><i class="fas fa-user-check"></i> Active users</span>
                        <span>Current status</span>
                    </div>
                </div>

                <div class="view-item">
                    <div class="view-title">Deleted Users View</div>
                    <div class="view-description">Shows users who have been removed from the system.</div>
                    <div class="view-stats">
                        <span><i class="fas fa-user-times"></i> Deleted users</span>
                        <span>Removal history</span>
                    </div>
                </div>

                <div class="view-item">
                    <div class="view-title">User Edits View</div>
                    <div class="view-description">Tracks all user information updates and modifications.</div>
                    <div class="view-stats">
                        <span><i class="fas fa-edit"></i> Edit history</span>
                        <span>Last modified</span>
                    </div>
                </div>

                <div class="view-item">
                    <div class="view-title">Deleted Users with Dates</div>
                    <div class="view-description">Shows deleted users with both registration and deletion dates.</div>
                    <div class="view-stats">
                        <span><i class="fas fa-calendar"></i> Date tracking</span>
                        <span>Full lifecycle</span>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <?php
                try {
                    // Display users view
                    echo '<h3 style="margin-bottom: 20px; color: #333; font-weight: 600;">
                            <i class="fas fa-users"></i> Users View (Chronological Order)
                          </h3>';
                    
                    $stmt = $pdo->query("SELECT * FROM users_view ORDER BY date_added DESC");
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($users) > 0) {
                        echo '<table class="data-table">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Registration Date</th>
                                    </tr>
                                </thead>
                                <tbody>';

                        foreach ($users as $user) {
                            echo '<tr>
                                    <td><strong>' . htmlspecialchars($user['subscriber_name']) . '</strong></td>
                                    <td>' . date('Y-m-d H:i:s', strtotime($user['date_added'])) . '</td>
                                  </tr>';
                        }

                        echo '</tbody></table>';
                    } else {
                        echo '<div class="no-data">
                                <i class="fas fa-users"></i>
                                <h3>No Users Found</h3>
                                <p>No users are currently registered in the system.</p>
                              </div>';
                    }

                    // Display existing users view
                    echo '<h3 style="margin: 40px 0 20px 0; color: #333; font-weight: 600;">
                            <i class="fas fa-user-check"></i> Existing Users View
                          </h3>';
                    
                    $stmt = $pdo->query("SELECT * FROM existing_users_view ORDER BY date_added DESC");
                    $existingUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($existingUsers) > 0) {
                        echo '<table class="data-table">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Registration Date</th>
                                    </tr>
                                </thead>
                                <tbody>';

                        foreach ($existingUsers as $user) {
                            echo '<tr>
                                    <td><strong>' . htmlspecialchars($user['subscriber_name']) . '</strong></td>
                                    <td>' . date('Y-m-d H:i:s', strtotime($user['date_added'])) . '</td>
                                  </tr>';
                        }

                        echo '</tbody></table>';
                    } else {
                        echo '<div class="no-data">
                                <i class="fas fa-user-check"></i>
                                <h3>No Active Users</h3>
                                <p>No active users found in the system.</p>
                              </div>';
                    }

                } catch (PDOException $e) {
                    echo '<div class="no-data">
                            <i class="fas fa-exclamation-triangle"></i>
                            <h3>Database Error</h3>
                            <p>Unable to load views: ' . htmlspecialchars($e->getMessage()) . '</p>
                          </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        // Statistics animation
        document.addEventListener('DOMContentLoaded', function() {
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const finalNumber = stat.textContent;
                if (!isNaN(finalNumber)) {
                    stat.textContent = '0';
                    let currentNumber = 0;
                    const increment = parseInt(finalNumber) / 30;
                    
                    const timer = setInterval(() => {
                        currentNumber += increment;
                        if (currentNumber >= parseInt(finalNumber)) {
                            stat.textContent = finalNumber;
                            clearInterval(timer);
                        } else {
                            stat.textContent = Math.floor(currentNumber);
                        }
                    }, 50);
                }
            });

            // View items animation
            const viewItems = document.querySelectorAll('.view-item');
            viewItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>

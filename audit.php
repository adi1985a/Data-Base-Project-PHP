<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit History - Management System</title>
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

        .audit-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filters-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .filter-group input,
        .filter-group select {
            padding: 10px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .filter-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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

        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .audit-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 15px;
            overflow: hidden;
        }

        .audit-table th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 1rem;
        }

        .audit-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #e1e5e9;
            transition: background-color 0.3s ease;
        }

        .audit-table tr:hover {
            background: #f8f9fa;
        }

        .audit-table tr:last-child td {
            border-bottom: none;
        }

        .action-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
        }

        .action-insert {
            background: #4CAF50;
            color: white;
        }

        .action-update {
            background: #2196F3;
            color: white;
        }

        .action-delete {
            background: #f44336;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination a {
            background: #f8f9fa;
            color: #333;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
        }

        .pagination .current {
            background: #667eea;
            color: white;
            font-weight: 600;
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
            
            .audit-card {
                padding: 20px;
            }
            
            .filters-grid {
                grid-template-columns: 1fr;
            }
            
            .audit-table {
                font-size: 0.9rem;
            }
            
            .audit-table th,
            .audit-table td {
                padding: 10px 15px;
            }
            
            .stats-section {
                grid-template-columns: 1fr;
            }
            
            .pagination {
                flex-wrap: wrap;
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
            <h1><i class="fas fa-history"></i> Audit History</h1>
            <p>Complete history of all operations in the system</p>
        </div>

        <?php
        // Include database configuration
        require_once 'config.php';

        try {
            $pdo = getDBConnection();

            // Get total audit entries
            $stmt = $pdo->query("SELECT COUNT(*) FROM audit_subscribers");
            $totalEntries = $stmt->fetchColumn();

            // Get entries by action type
            $stmt = $pdo->query("SELECT action_performed, COUNT(*) as count FROM audit_subscribers GROUP BY action_performed");
            $actionStats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get recent activity (last 7 days)
            $stmt = $pdo->query("SELECT COUNT(*) FROM audit_subscribers WHERE date_added >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
            $recentActivity = $stmt->fetchColumn();

            // Get most active user
            $stmt = $pdo->query("SELECT subscriber_name, COUNT(*) as count FROM audit_subscribers GROUP BY subscriber_name ORDER BY count DESC LIMIT 1");
            $mostActiveUser = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            $totalEntries = $recentActivity = 0;
            $actionStats = [];
            $mostActiveUser = null;
        }
        ?>

        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-number"><?php echo $totalEntries; ?></div>
                <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Total Entries</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $recentActivity; ?></div>
                <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Recent Activity</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $mostActiveUser ? $mostActiveUser['count'] : 0; ?></div>
                <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Most Active User</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo count($actionStats); ?></div>
                <div class="stat-label" style="color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">Action Types</div>
            </div>
        </div>

        <div class="audit-card">
            <h2 class="card-title">
                <i class="fas fa-list"></i> Audit Log
            </h2>

            <div class="filters-section">
                <form method="GET" action="">
                    <div class="filters-grid">
                        <div class="filter-group">
                            <label for="action">Action Type:</label>
                            <select name="action" id="action">
                                <option value="">All Actions</option>
                                <option value="Insert a new subscriber" <?php echo (isset($_GET['action']) && $_GET['action'] == 'Insert a new subscriber') ? 'selected' : ''; ?>>User Addition</option>
                                <option value="Updated a subscriber" <?php echo (isset($_GET['action']) && $_GET['action'] == 'Updated a subscriber') ? 'selected' : ''; ?>>User Update</option>
                                <option value="Updated a user" <?php echo (isset($_GET['action']) && $_GET['action'] == 'Updated a user') ? 'selected' : ''; ?>>User Modification</option>
                                <option value="Deleted a subscriber" <?php echo (isset($_GET['action']) && $_GET['action'] == 'Deleted a subscriber') ? 'selected' : ''; ?>>User Deletion</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="user">User Name:</label>
                            <input type="text" name="user" id="user" placeholder="Filter by user name" value="<?php echo isset($_GET['user']) ? htmlspecialchars($_GET['user']) : ''; ?>">
                        </div>
                        <div class="filter-group">
                            <label for="date_from">Date From:</label>
                            <input type="date" name="date_from" id="date_from" value="<?php echo isset($_GET['date_from']) ? htmlspecialchars($_GET['date_from']) : ''; ?>">
                        </div>
                        <div class="filter-group">
                            <label for="date_to">Date To:</label>
                            <input type="date" name="date_to" id="date_to" value="<?php echo isset($_GET['date_to']) ? htmlspecialchars($_GET['date_to']) : ''; ?>">
                        </div>
                        <div class="filter-group">
                            <button type="submit" class="filter-btn">
                                <i class="fas fa-filter"></i> Apply Filters
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-container">
                <?php
                try {
                    // Build query with filters
                    $whereConditions = [];
                    $params = [];

                    if (!empty($_GET['action'])) {
                        $whereConditions[] = "action_performed = :action";
                        $params[':action'] = $_GET['action'];
                    }

                    if (!empty($_GET['user'])) {
                        $whereConditions[] = "subscriber_name LIKE :user";
                        $params[':user'] = '%' . $_GET['user'] . '%';
                    }

                    if (!empty($_GET['date_from'])) {
                        $whereConditions[] = "DATE(date_added) >= :date_from";
                        $params[':date_from'] = $_GET['date_from'];
                    }

                    if (!empty($_GET['date_to'])) {
                        $whereConditions[] = "DATE(date_added) <= :date_to";
                        $params[':date_to'] = $_GET['date_to'];
                    }

                    $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';

                    // Pagination
                    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                    $perPage = 20;
                    $offset = ($page - 1) * $perPage;

                    // Get total count
                    $countQuery = "SELECT COUNT(*) FROM audit_subscribers $whereClause";
                    $stmt = $pdo->prepare($countQuery);
                    foreach ($params as $key => $value) {
                        $stmt->bindValue($key, $value);
                    }
                    $stmt->execute();
                    $totalRecords = $stmt->fetchColumn();
                    $totalPages = ceil($totalRecords / $perPage);

                    // Get data
                    $query = "SELECT * FROM audit_subscribers $whereClause ORDER BY date_added DESC LIMIT :limit OFFSET :offset";
                    $stmt = $pdo->prepare($query);
                    foreach ($params as $key => $value) {
                        $stmt->bindValue($key, $value);
                    }
                    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
                    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                    $stmt->execute();
                    $auditEntries = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($auditEntries) > 0) {
                        echo '<table class="audit-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Action</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>';

                        foreach ($auditEntries as $entry) {
                            $actionClass = '';
                            $actionText = '';
                            
                            switch ($entry['action_performed']) {
                                case 'Insert a new subscriber':
                                    $actionClass = 'action-insert';
                                    $actionText = 'User Added';
                                    break;
                                case 'Updated a subscriber':
                                case 'Updated a user':
                                    $actionClass = 'action-update';
                                    $actionText = 'User Updated';
                                    break;
                                case 'Deleted a subscriber':
                                    $actionClass = 'action-delete';
                                    $actionText = 'User Deleted';
                                    break;
                                default:
                                    $actionClass = 'action-update';
                                    $actionText = $entry['action_performed'];
                            }

                            echo '<tr>
                                    <td><strong>#' . $entry['id'] . '</strong></td>
                                    <td><strong>' . htmlspecialchars($entry['subscriber_name']) . '</strong></td>
                                    <td><span class="action-badge ' . $actionClass . '">' . $actionText . '</span></td>
                                    <td>' . date('Y-m-d H:i:s', strtotime($entry['date_added'])) . '</td>
                                  </tr>';
                        }

                        echo '</tbody></table>';

                        // Pagination
                        if ($totalPages > 1) {
                            echo '<div class="pagination">';
                            
                            if ($page > 1) {
                                $prevParams = $_GET;
                                $prevParams['page'] = $page - 1;
                                echo '<a href="?' . http_build_query($prevParams) . '"><i class="fas fa-chevron-left"></i> Previous</a>';
                            }
                            
                            for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++) {
                                $pageParams = $_GET;
                                $pageParams['page'] = $i;
                                $class = $i == $page ? 'current' : '';
                                echo '<a href="?' . http_build_query($pageParams) . '" class="' . $class . '">' . $i . '</a>';
                            }
                            
                            if ($page < $totalPages) {
                                $nextParams = $_GET;
                                $nextParams['page'] = $page + 1;
                                echo '<a href="?' . http_build_query($nextParams) . '">Next <i class="fas fa-chevron-right"></i></a>';
                            }
                            
                            echo '</div>';
                        }

                        echo '<div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 10px; font-size: 0.9rem; color: #666; text-align: center;">
                                Showing ' . ($offset + 1) . ' to ' . min($offset + $perPage, $totalRecords) . ' of ' . $totalRecords . ' entries
                              </div>';
                    } else {
                        echo '<div class="no-data">
                                <i class="fas fa-history"></i>
                                <h3>No Audit Entries Found</h3>
                                <p>No audit entries match the current filters.</p>
                              </div>';
                    }
                } catch (PDOException $e) {
                    echo '<div class="no-data">
                            <i class="fas fa-exclamation-triangle"></i>
                            <h3>Database Error</h3>
                            <p>Unable to load audit data: ' . htmlspecialchars($e->getMessage()) . '</p>
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

            // Table row animations
            const tableRows = document.querySelectorAll('.audit-table tbody tr');
            tableRows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, index * 50);
            });
        });
    </script>
</body>
</html> 
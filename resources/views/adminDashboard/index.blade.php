<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Fee Management Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/image/fabicon.png') }}" type="image/x-icon" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <div class="app-layout">

        <!-- ================= Sidebar ================= -->
        <aside class="sidebar">

            <div class="sidebar-header">
                <div class="logo-box">
                    <span class="material-icons">account_balance</span>
                </div>
                <span class="logo-title">EduPay</span>
            </div>

            <nav class="nav-menu">
                <a href="#" class="nav-item active">
                    <span class="material-icons">dashboard</span>
                    Dashboard
                </a>

                <a href="#" class="nav-item">
                    <span class="material-icons">school</span>
                    Students
                </a>

                <a href="#" class="nav-item">
                    <span class="material-icons">payments</span>
                    Payments
                </a>

                <a href="#" class="nav-item">
                    <span class="material-icons">assessment</span>
                    Reports
                </a>

                <a href="#" class="nav-item">
                    <span class="material-icons">settings</span>
                    Settings
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="profile">
                    <img src="profile.jpg" alt="Admin">
                    <div>
                        <p class="profile-name">Alex Johnson</p>
                        <p class="profile-role">System Admin</p>
                    </div>
                </div>
            </div>

        </aside>

        <!-- ================= Main Content ================= -->
        <main class="main-content">

            <!-- Topbar -->
            <header class="topbar">
                <h2 class="page-title">Fee Management Dashboard</h2>

                <div class="topbar-actions">
                    <button class="icon-btn">
                        <span class="material-icons">notifications</span>
                        <span class="notification-dot"></span>
                    </button>

                    <button class="btn btn-primary">
                        <span class="material-icons">add</span>
                        Collect Fee
                    </button>
                </div>
            </header>

            <div class="content-wrapper">

                <!-- Stat Cards -->
                <div class="grid grid-3">

                    <div class="card stat-card">
                        <div>
                            <p class="card-subtitle">Total Revenue</p>
                            <h3>$245,892.00</h3>
                            <p class="stat-success">+12.5% from last month</p>
                        </div>
                        <span class="material-icons stat-icon primary">payments</span>
                    </div>

                    <div class="card stat-card">
                        <div>
                            <p class="card-subtitle">Pending Dues</p>
                            <h3 class="stat-danger">$18,450.50</h3>
                            <p>42 outstanding invoices</p>
                        </div>
                        <span class="material-icons stat-icon danger">hourglass_empty</span>
                    </div>

                    <div class="card stat-card">
                        <div>
                            <p class="card-subtitle">Total Students</p>
                            <h3>1,284</h3>
                            <p class="stat-success">+48 this semester</p>
                        </div>
                        <span class="material-icons stat-icon gray">group</span>
                    </div>

                </div>

                <!-- Transactions Table -->
                <div class="card mt-30">

                    <div class="card-header">
                        <h3>Recent Transactions</h3>
                        <input type="text" class="input" placeholder="Search student...">
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>ID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Emily Mitchell</td>
                                    <td>STU-1024</td>
                                    <td>$1,200.00</td>
                                    <td>Oct 24, 2023</td>
                                    <td><span class="badge badge-success">Paid</span></td>
                                    <td><span class="material-icons action-icon">more_vert</span></td>
                                </tr>
                                <tr>
                                    <td>James Rodriguez</td>
                                    <td>STU-1088</td>
                                    <td>$850.00</td>
                                    <td>Oct 23, 2023</td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td><span class="material-icons action-icon">more_vert</span></td>
                                </tr>
                                <tr>
                                    <td>Sarah Lewis</td>
                                    <td>STU-1121</td>
                                    <td>$1,500.00</td>
                                    <td>Oct 22, 2023</td>
                                    <td><span class="badge badge-danger">Overdue</span></td>
                                    <td><span class="material-icons action-icon">more_vert</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- Bottom Section -->
                <div class="grid grid-2 mt-30">

                    <div class="card">
                        <h4 class="card-title">Quick Actions</h4>
                        <div class="quick-grid">
                            <button class="quick-btn">Monthly Report</button>
                            <button class="quick-btn">Send Reminder</button>
                            <button class="quick-btn">Fee Structure</button>
                            <button class="quick-btn">New Student</button>
                        </div>
                    </div>

                    <div class="card">
                        <h4 class="card-title">Collection Progress</h4>

                        <div class="progress-item">
                            <div class="progress-info">
                                <span>Tuition Fees</span>
                                <span>85%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width:85%"></div>
                            </div>
                        </div>

                        <div class="progress-item">
                            <div class="progress-info">
                                <span>Library Fees</span>
                                <span>92%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar green" style="width:92%"></div>
                            </div>
                        </div>

                        <div class="progress-item">
                            <div class="progress-info">
                                <span>Transportation</span>
                                <span>64%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar orange" style="width:64%"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

</body>

</html>

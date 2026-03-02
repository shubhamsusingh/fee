<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Fee Portal | EduPay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/image/fabicon.png') }}" type="image/x-icon" />

    {{-- // <!-- Google Font --> --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- // <!-- Icons --> --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- // <!-- Student CSS --> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/student.css') }}">
</head>

<body>

    {{-- // <!-- ================= HEADER ================= --> --}}
    <header class="header">
        <div class="container header-flex">

            <div class="logo">
                <div class="logo-icon">
                    <span class="material-icons">account_balance</span>
                </div>
                <span class="logo-text">EduPay Portal</span>
            </div>

            <nav class="nav">
                <a href="#" class="nav-link active">Dashboard</a>
                <a href="#" class="nav-link">History</a>
                <a href="#" class="nav-link">Tax Documents</a>
            </nav>

            <div class="profile">
                <div class="profile-text">
                    <p class="student-name">{{ Auth::user()->name }}</p>
                    <p class="student-id">ID:{{ Auth::user()->email }}</p>
                </div>
                {{-- <img src="profile.jpg" class="profile-img"> --}}
                <form action="">
                    <button class="btn-primary">Logout</button>
                </form>
            </div>

        </div>
    </header>

    {{-- // <!-- ================= MAIN ================= --> --}}
    <main class="container main">

        <!-- Summary Cards -->
        <div class="grid-3">

            <div class="card balance-card">
                <p class="card-subtitle">Outstanding Balance</p>
                @if ($payment['amount_paid'] < $feeStructure['total_amount'])
                    <h2 class="balance-amount">₹{{ $feeStructure['total_amount'] - $payment['amount_paid'] }}</h2>
                    <div class="badge danger">
                        <span class="material-icons">priority_high</span>
                        Action Required
                    </div>
                @else
                    <div class="badge danger">
                        Completed
                    </div>
                @endif
            </div>

            <div class="card">
                <p class="card-subtitle">Next Due Date</p>
                @php
                    use Carbon\Carbon;

                    $dueDate = Carbon::parse($payment['due_date']);
                    $today = Carbon::today();
                    $daysLeft = $today->diffInDays($dueDate, false);
                @endphp

                @if ($payment['amount_paid'] < $feeStructure['total_amount'])
                    <h3>{{ $payment['due_date'] }}</h3>

                    @if ($daysLeft > 0)
                        <p class="small-text">{{ $daysLeft }} days remaining</p>
                    @elseif($daysLeft == 0)
                        <p class="small-text text-warning">Due Today</p>
                    @else
                        <p class="small-text text-danger">{{ abs($daysLeft) }} days overdue</p>
                    @endif
                @endif
            </div>

            <div class="card">
                <p class="card-subtitle">Last Payment</p>
                <h3>₹{{ $lastInstallment['amount'] }}</h3>
                <p class="small-text">Processed on {{ $lastInstallment['paid_date'] }}</p>
            </div>

        </div>

        <div class="layout-2">

            {{-- // <!-- LEFT SIDE --> --}}
            <div>

                {{-- // <!-- Fee Breakdown --> --}}
                {{-- <section class="section">
                    <div class="section-header">
                        <h2>Fee Breakdown - Semester 1</h2>
                        <button class="btn-link">Download PDF</button>
                    </div>

                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fee Component</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tuition Fees</td>
                                    <td>Core Academic Program</td>
                                    <td><span class="status unpaid">Unpaid</span></td>
                                    <td class="text-right">$2,000.00</td>
                                </tr>
                                <tr>
                                    <td>Lab Resources</td>
                                    <td>Science & Computing</td>
                                    <td><span class="status unpaid">Unpaid</span></td>
                                    <td class="text-right">$350.00</td>
                                </tr>
                                <tr>
                                    <td>Library Access</td>
                                    <td>Digital & Print Media</td>
                                    <td><span class="status unpaid">Unpaid</span></td>
                                    <td class="text-right">$100.00</td>
                                </tr>
                                <tr>
                                    <td>Registration Fee</td>
                                    <td>Annual Admin Fee</td>
                                    <td><span class="status paid">Paid</span></td>
                                    <td class="text-right line-through">$200.00</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"><strong>Total Payable</strong></td>
                                    <td class="text-right total">$2,450.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </section> --}}

                {{-- // <!-- Payment History --> --}}
                <section class="section">
                    <h2>Recent Payment History</h2>


                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Trans ID</th>
                                    <th>Method</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($installementList as $installement)
                                    <tr>
                                        <td>
                                            {{ \Carbon\Carbon::parse($installement->paid_date)->format('M d, Y') }}
                                        </td>

                                        <td>
                                            #{{ $installement->transaction_id }}
                                        </td>

                                        <td>
                                            {{ ucfirst($installement->payment_mode) }}
                                        </td>

                                        <td class="text-right">
                                            ₹{{ number_format($installement->amount, 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Installments Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>

            {{-- // <!-- RIGHT SIDE --> --}}
            <div class="sidebar-card">

                <div class="card payment-card">
                    <h3>Make a Payment</h3>
                    <p class="small-text">
                        Pay your outstanding balance securely using your preferred payment method.
                    </p>
                    <form action="payment" method="POST">
                        @csrf
                        <input type="hidden" name="price" value="70">
                        <button type="submit" class="btn-primary full-width">
                            <span class="material-icons">payments</span>
                            Pay Fees Online
                        </button>
                    </form>
                </div>

                <div class="card help-card">
                    <h4>Help & Support</h4>
                    <ul>
                        <li>Download Tax Receipts</li>
                        <li>Payment Plan Options</li>
                        <li>Contact Finance Office</li>
                    </ul>
                </div>

            </div>

        </div>

    </main>

    <footer class="footer">
        <p>© 2024 Institutional Fee Management System</p>
    </footer>

</body>

</html>

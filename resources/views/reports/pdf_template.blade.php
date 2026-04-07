<x-app-layout>

    <style>
        #default-sidebar {
            display: none;
        }

        #main {
            margin-top: 0px;
        }

        #nav-main {
            margin-left: 0px;
        }

        #header {
            display: none;
        }

        /* Custom layout & design tuned for PDF-like output */
        :root {
            --bg-page: #EFE4D2;
            --card-bg: #ffffff;
            --primary: #131D4F;
            --accent: #254D70;
            --muted: #6B7280;
            --danger: #DC2626;
            --radius: 20px;
            --gap: 28px;
            --max-width: 620px;
        }

        html, body {
            height: 100%;
            margin: 0;
            -webkit-text-size-adjust: 100%;
        }

        .page {
            min-height: 100vh;
            width: 100%;
            background: var(--bg-page);
            padding: 48px 24px;
            display: flex;
            justify-content: center;
            box-sizing: border-box;
        }

        /* Card inset and generous horizontal padding to mimic the PDF white panel */
        .card {
            width: 100%;
            max-width: var(--max-width);
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: 0 6px 18px rgba(17, 24, 39, 0.06);
            padding: 44px 64px; /* wider horizontal padding for PDF layout */
            box-sizing: border-box;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
        }

        .report-title {
            font-size: 2.25rem; /* larger to match PDF */
            font-weight: 700;
            color: var(--primary);
            margin: 0 0 8px 0;
            line-height: 1.06;
        }

        .report-subtitle {
            color: var(--muted);
            margin: 0;
            font-size: 1rem;
        }

        hr.divider {
            margin: 28px 0;
            border: 0;
            border-top: 1px solid #E6E8EB; /* slightly lighter for PDF */
        }

        /* Center the stats block and make it visually stacked (like the PDF) */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: var(--gap);
            text-align: center;
            margin: 0 auto;
            width: 64%; /* narrow the stats region and center it */
            align-items: center;
        }

        /* On print / narrow widths, stack vertically */
        @media (max-width: 900px) {
            .stats-grid {
                grid-template-columns: 1fr;
                width: 100%;
            }
        }

        .stat {
            padding: 8px 0;
        }

        .stat-label {
            color: var(--muted);
            margin: 0 0 8px 0;
            font-size: 1rem;
            font-weight: 500;
        }

        .stat-value {
            font-size: 2.75rem; /* larger numeric display */
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            line-height: 1;
        }

        .stat-small {
            font-size: 1.25rem;
        }

        .capitalize {
            text-transform: capitalize;
        }

        .section-title {
            font-size: 1.25rem; /* ~text-xl */
            font-weight: 700;
            color: var(--primary);
            margin-top: 40px;
            margin-bottom: 18px;
        }

        .table-wrapper {
            overflow-x: auto;
            margin-top: 12px;
        }

        table.report-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-sizing: border-box;
            margin-top: 8px;
        }

        /* Header row with rounded corners and strong background (full-width feel) */
        table.report-table thead th {
            padding: 14px 20px;
            text-align: center;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            font-size: 1rem;
        }

        /* give the header row a continuous background using thead row style */
        .thead-primary th,
        .thead-accent th {
            color: #ffffff;
        }

        .thead-primary th {
            background: var(--primary);
        }

        .thead-accent th {
            background: var(--accent);
        }

        /* rounded corners for the left-most and right-most header cells */
        table.report-table thead th:first-child {
            border-top-left-radius: 10px;
            padding-left: 28px;
            text-align: left;
        }

        table.report-table thead th:last-child {
            border-top-right-radius: 10px;
            padding-right: 28px;
            text-align: right;
        }

        /* Body rows */
        table.report-table tbody td {
            padding: 16px 20px;
            text-align: center;
            border-bottom: 1px solid #F1F3F5;
            font-size: 1rem;
            color: #111827;
        }

        table.report-table tbody td:first-child {
            text-align: left;
            padding-left: 28px;
        }

        table.report-table tbody td:last-child {
            text-align: right;
            padding-right: 28px;
        }

        /* Category percentage and amounts */
        .amount {
            color: inherit;
        }

        .amount-negative {
            color: var(--danger);
        }

        /* Insights box */
        .insights {
            background: var(--accent);
            color: #ffffff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(37, 77, 112, 0.08);
            line-height: 1.6;
            margin-top: 8px;
        }

        .footer-note {
            margin-top: 28px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        /* Print-friendly tweaks */
        @media print {
            .card {
                box-shadow: none;
                padding: 32px 48px;
            }

            .report-title {
                font-size: 2rem;
            }

            .stat-value {
                font-size: 2.5rem;
            }
        }
    </style>

   
    <div class="page">
            <div class="card">

                <div class="header-row">
                    <div>
                        <h1 class="report-title">
                            Monthly Expense Report – {{ $formattedMonth }} {{ $year }}
                        </h1>
                        <p class="report-subtitle">
                            A summary of your expenses for this month.
                        </p>
                    </div>
                </div>

                <hr class="divider">

                <div class="stats-grid">

                    <div class="stat">
                        <p class="stat-label">Total Spent</p>
                        <h2 class="stat-value">{{ number_format($totalSpent) ?? 0 }}</h2>
                    </div>

                    <div class="stat">
                        <p class="stat-label">Total Transactions</p>
                        <h2 class="stat-value stat-small">{{ $totalTransactions ?? 0 }}</h2>
                    </div>

                    <div class="stat">
                        <p class="stat-label">Top Spending Category</p>
                        <h2 class="stat-value stat-small capitalize">{{ $topSpendindCategory->name }}</h2>
                    </div>

                </div>

                <h3 class="section-title">Category Breakdown</h3>

                <div class="table-wrapper">
                    <table class="report-table">
                        <thead class="thead-primary">
                            <tr>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>% of Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoryBreakdown as $data)
                                <tr>
                                    <td class="capitalize">{{ $data['category_name'] }}</td>
                                    <td class="amount">{{ $data['amount'] }}</td>
                                    <td>{{ $data['percent'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h3 class="section-title">Recent Transactions</h3>

                <div class="table-wrapper">
                    <table class="report-table">
                        <thead class="thead-accent">
                            <tr>
                                <th>Date</th>
                                <th>Transaction</th>
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentTransaction as $data)
                                <tr>
                                    <td>{{ $data->created_at->format('M d, Y') }}</td>
                                    <td class="capitalize">{{ $data->title }}</td>
                                    <td class="capitalize">{{ $data->category->name }}</td>
                                    <td class="amount-negative">-{{ $data->amount }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <h3 class="section-title">Monthly Insights</h3>

                <div class="insights">
                    <p>
                        {!! nl2br(e($insights)) !!}
                    </p>
                </div>

                <p class="footer-note">
                    Report generated for month {{ $formattedMonth }} {{ $year }} by ExpenseTracker App.
                </p>

            </div>
    </div>

</x-app-layout>

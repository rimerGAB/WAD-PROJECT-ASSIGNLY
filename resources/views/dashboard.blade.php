@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
/* Modern Dashboard Styles - Consistent with Navigation */
.dashboard-container {
    padding: 0;
    background: radial-gradient(circle at top left, rgba(102, 126, 234, 0.14), transparent 28%),
                radial-gradient(circle at bottom right, rgba(124, 58, 237, 0.09), transparent 18%),
                #f8fafc;
    min-height: 100vh;
}

/* Welcome Section */
.welcome-section {
    background: linear-gradient(135deg, rgba(15, 23, 42, 0.78), rgba(59, 130, 246, 0.38)),
                url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1400&q=80');
    background-size: cover;
    background-position: center;
    margin: 0;
    padding: 4rem 2rem 3rem 2rem;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
}

.welcome-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(15, 23, 42, 0.6), rgba(59, 130, 246, 0.12));
    pointer-events: none;
}

.welcome-section::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.03);
    pointer-events: none;
}

.welcome-content {
    position: relative;
    z-index: 1;
    color: white;
    max-width: 980px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
    background: rgba(15, 23, 42, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 28px;
    box-shadow: 0 30px 80px rgba(15, 23, 42, 0.22);
}

.welcome-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.65rem 1rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.12);
    color: #dbeafe;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    margin-bottom: 1.25rem;
}

.welcome-title {
    font-size: 3.25rem;
    font-weight: 800;
    margin-bottom: 1rem;
    animation: fadeInUp 0.6s ease-out;
    line-height: 1.05;
}

.welcome-subtitle {
    font-size: 1.2rem;
    color: rgba(226, 232, 240, 0.92);
    margin-bottom: 2rem;
    animation: fadeInUp 0.8s ease-out;
    line-height: 1.7;
}

.welcome-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-welcome {
    padding: 1rem 1.8rem;
    border-radius: 999px;
    font-size: 0.98rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: transform 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
}

.btn-welcome-primary {
    background: #ffffff;
    color: #0f172a;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-welcome-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 35px rgba(15, 23, 42, 0.18);
}

.btn-welcome-secondary {
    background: rgba(255, 255, 255, 0.12);
    color: #dbeafe;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-welcome-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

/* Stats Cards Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.8rem;
    margin: 2rem 2rem 1.5rem 2rem;
    padding: 0;
}

.stat-card-modern {
    background: rgba(255, 255, 255, 0.72);
    border: 1px solid rgba(255, 255, 255, 0.72);
    backdrop-filter: blur(18px);
    border-radius: 28px;
    padding: 2rem;
    box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    animation: slideUp 0.6s ease-out;
}

.stat-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.stat-card-modern:hover {
    transform: translateY(-6px);
    box-shadow: 0 28px 70px rgba(15, 23, 42, 0.12);
}

.stat-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1rem;
}

.stat-info {
    flex: 1;
}

.stat-label {
    color: #475569;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    letter-spacing: 0.02em;
}

.stat-number {
    font-size: 2.75rem;
    font-weight: 800;
    color: #0f172a;
    line-height: 1;
    margin-bottom: 0.4rem;
}

.stat-change {
    font-size: 0.78rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.35rem 0.75rem;
    border-radius: 999px;
}

.stat-change.positive {
    color: #115e59;
    background: rgba(16, 185, 129, 0.14);
}

.stat-change.negative {
    color: #b91c1c;
    background: rgba(239, 68, 68, 0.14);
}

.stat-icon-modern {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-left: 1rem;
    box-shadow: inset 0 0 0 1px rgba(255,255,255,0.16);
}

.stat-icon-blue {
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.stat-icon-green {
    background: linear-gradient(135deg, #10b981, #059669);
}

.stat-icon-purple {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.stat-icon-orange {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

/* Charts Section */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.8rem;
    margin: 0 2rem 2rem 2rem;
}

.chart-card {
    background: rgba(255, 255, 255, 0.76);
    border: 1px solid rgba(255, 255, 255, 0.78);
    backdrop-filter: blur(20px);
    border-radius: 28px;
    padding: 2rem;
    box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
    animation: slideUp 0.8s ease-out;
    overflow: hidden;
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    gap: 1rem;
    flex-wrap: wrap;
}

.chart-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.chart-icon {
    width: 42px;
    height: 42px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: white;
    background: linear-gradient(135deg, #667eea, #764ba2);
    box-shadow: 0 12px 30px rgba(102, 126, 234, 0.12);
}

.chart-actions {
    display: flex;
    gap: 0.65rem;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.btn-chart-action {
    background: rgba(241, 245, 249, 0.92);
    border: 1px solid rgba(148, 163, 184, 0.25);
    border-radius: 14px;
    padding: 0.65rem;
    color: #475569;
    cursor: pointer;
    transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
}

.btn-chart-action:hover {
    background: rgba(255, 255, 255, 1);
    color: #0f172a;
    transform: translateY(-1px);
}

.chart-container {
    position: relative;
    width: 100%;
    max-width: 100%;
    height: 330px;
}

.chart-container canvas {
    display: block;
    width: 100% !important;
    height: 100% !important;
}

/* Lists Section */
.lists-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.8rem;
    margin: 0 2rem 2rem 2rem;
}

.list-card {
    background: rgba(255, 255, 255, 0.76);
    border: 1px solid rgba(255, 255, 255, 0.78);
    backdrop-filter: blur(20px);
    border-radius: 28px;
    padding: 2rem;
    box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
    animation: slideUp 1s ease-out;
}

.list-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.list-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.list-content {
    max-height: 420px;
    overflow-y: auto;
    padding-right: 0.25rem;
}

.list-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-radius: 18px;
    margin-bottom: 0.85rem;
    background: rgba(248, 250, 252, 0.88);
    transition: transform 0.25s ease, background 0.25s ease;
}

.list-item:hover {
    background: rgba(255, 255, 255, 0.95);
    transform: translateX(4px);
}

.list-item-left {
    display: flex;
    align-items: center;
    gap: 0.9rem;
}

.list-item-avatar {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 0.95rem;
}

.list-item-info {
    flex: 1;
    min-width: 0;
}

.list-item-name {
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.2rem;
}

.list-item-subtitle {
    font-size: 0.9rem;
    color: #64748b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 220px;
}

.list-item-right {
    text-align: right;
    min-width: 110px;
}

.list-item-badge {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 0.35rem 0.85rem;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    display: inline-block;
}

.list-item-time {
    font-size: 0.8rem;
    color: #64748b;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem;
    color: #64748b;
}

.empty-state-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.55;
}

.empty-state-text {
    font-size: 1rem;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 1200px) {
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }
    
    .charts-grid {
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    }
    
    .lists-grid {
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    }
}

@media (max-width: 768px) {
    .welcome-section {
        padding: 3rem 1.5rem 2rem 1.5rem;
    }
    
    .welcome-title {
        font-size: 2rem;
    }
    
    .welcome-subtitle {
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin: 1.5rem 1rem;
        padding: 0;
    }
    
    .stat-card-modern {
        padding: 1.5rem;
    }
    
    .charts-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin: 0 1rem 1.5rem 1rem;
    }
    
    .chart-card {
        padding: 1.5rem;
    }
    
    .chart-actions {
        justify-content: flex-start;
    }
    
    .lists-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin: 0 1rem 1.5rem 1rem;
    }
    
    .list-card {
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .chart-container {
        height: 260px;
    }
}

@media (max-width: 480px) {
    .welcome-title {
        font-size: 1.75rem;
    }
    
    .welcome-subtitle {
        font-size: 1rem;
    }
    
    .stat-icon-modern {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }
    
    .stat-number {
        font-size: 1.75rem;
    }
    
    .chart-container {
        height: 220px;
    }
    
    .chart-title {
        font-size: 1rem;
    }
    
    .btn-chart-action {
        padding: 0.45rem;
    }
}
</style>

<div class="dashboard-container">
    <!-- Welcome Section -->
    <section class="welcome-section">
        <div class="welcome-content">
            <div class="welcome-badge">
                <i class="fas fa-user-tie"></i>
                Executive Dashboard
            </div>
            <h1 class="welcome-title">Welcome back, {{ Auth::user()->name }}.</h1>
            <p class="welcome-subtitle">
                Your team, timelines, and key performance metrics are ready for review. Stay ahead with fast insights and clear next steps.
            </p>
            <div class="welcome-actions">
                <a href="{{ route('assignments.index') }}" class="btn-welcome btn-welcome-primary">
                    <i class="fas fa-tasks"></i>
                    View Assignments
                </a>
                <a href="{{ route('projects.index') }}" class="btn-welcome btn-welcome-secondary">
                    <i class="fas fa-project-diagram"></i>
                    Open Projects
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card-modern">
            <div class="stat-card-header">
                <div class="stat-info">
                    <div class="stat-label">Total Employees</div>
                    <div class="stat-number">{{ $totalEmployees }}</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        12% from last month
                    </div>
                </div>
                <div class="stat-icon-modern stat-icon-blue">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="stat-card-modern">
            <div class="stat-card-header">
                <div class="stat-info">
                    <div class="stat-label">Active Projects</div>
                    <div class="stat-number">{{ $totalProjects }}</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        8% from last month
                    </div>
                </div>
                <div class="stat-icon-modern stat-icon-green">
                    <i class="fas fa-project-diagram"></i>
                </div>
            </div>
        </div>

        <div class="stat-card-modern">
            <div class="stat-card-header">
                <div class="stat-info">
                    <div class="stat-label">Total Assignments</div>
                    <div class="stat-number">{{ $totalAssignments }}</div>
                    <div class="stat-change negative">
                        <i class="fas fa-arrow-down"></i>
                        3% from last month
                    </div>
                </div>
                <div class="stat-icon-modern stat-icon-purple">
                    <i class="fas fa-tasks"></i>
                </div>
            </div>
        </div>

        <div class="stat-card-modern">
            <div class="stat-card-header">
                <div class="stat-info">
                    <div class="stat-label">Total Budget</div>
                    <div class="stat-number">${{ number_format($totalBudget, 0) }}</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        15% from last month
                    </div>
                </div>
                <div class="stat-icon-modern stat-icon-orange">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div id="analytics"></div>
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <div class="chart-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    Employees by Department
                </div>
                <div class="chart-actions">
                    <button class="btn-chart-action">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="btn-chart-action">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="departmentChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <div class="chart-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    Top Projects by Budget
                </div>
                <div class="chart-actions">
                    <button class="btn-chart-action">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="btn-chart-action">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="budgetChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Lists Section -->
    <div class="lists-grid">
        <div class="list-card" id="reports">
            <div class="list-header">
                <div class="list-title">
                    <div class="chart-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    Top Performing Employees
                </div>
                <div class="chart-actions">
                    <button class="btn-chart-action">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>
            <div class="list-content">
                @forelse($topEmployees as $employee)
                    <div class="list-item">
                        <div class="list-item-left">
                            <div class="list-item-avatar">
                                {{ strtoupper(substr($employee->name, 0, 1)) }}
                            </div>
                            <div class="list-item-info">
                                <div class="list-item-name">{{ $employee->name }}</div>
                                <div class="list-item-subtitle">{{ $employee->department->name ?? 'No Dept' }}</div>
                            </div>
                        </div>
                        <div class="list-item-right">
                            <div class="list-item-badge">{{ $employee->assignments_sum_hours ?? 0 }} hrs</div>
                            <div class="list-item-time">This month</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="empty-state-text">No employee data available</div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="list-card">
            <div class="list-header">
                <div class="list-title">
                    <div class="chart-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    Recent Assignments
                </div>
                <div class="chart-actions">
                    <button class="btn-chart-action">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>
            <div class="list-content">
                @forelse($recentAssignments as $assignment)
                    <div class="list-item">
                        <div class="list-item-left">
                            <div class="list-item-avatar">
                                {{ strtoupper(substr($assignment->employee->name, 0, 1)) }}
                            </div>
                            <div class="list-item-info">
                                <div class="list-item-name">{{ $assignment->employee->name }}</div>
                                <div class="list-item-subtitle">→ {{ $assignment->project->title }}</div>
                            </div>
                        </div>
                        <div class="list-item-right">
                            <div class="list-item-badge">{{ $assignment->role }}</div>
                            <div class="list-item-time">{{ $assignment->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="empty-state-text">No recent assignments</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Project Hours Distribution -->
    <div id="time-tracking"></div>
    @if(count($hoursProjectNames) > 0)
    <div class="chart-card" style="margin: 0 2rem 2rem 2rem;">
        <div class="chart-header">
            <div class="chart-title">
                <div class="chart-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                Project Hours Distribution
            </div>
            <div class="chart-actions">
                <button class="btn-chart-action">
                    <i class="fas fa-download"></i>
                </button>
                <button class="btn-chart-action">
                    <i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="chart-container" style="height: 250px;">
            <canvas id="hoursChart"></canvas>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart.js global configuration
        Chart.defaults.font.family = 'Inter, sans-serif';
        Chart.defaults.color = '#64748b';
        
        // Department Chart
        const deptCtx = document.getElementById('departmentChart');
        if (deptCtx) {
            new Chart(deptCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($departmentNames) !!},
                    datasets: [{
                        data: {!! json_encode($departmentCounts) !!},
                        backgroundColor: [
                            '#667eea',
                            '#764ba2',
                            '#10b981',
                            '#f59e0b',
                            '#ef4444',
                            '#8b5cf6'
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(30, 41, 59, 0.9)',
                            titleFont: {
                                size: 14,
                                weight: '600'
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 12,
                            cornerRadius: 8
                        }
                    }
                }
            });
        }

        // Budget Chart
        const budgetCtx = document.getElementById('budgetChart');
        if (budgetCtx) {
            new Chart(budgetCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($projectNames) !!},
                    datasets: [{
                        label: 'Budget ($)',
                        data: {!! json_encode($projectBudgets) !!},
                        backgroundColor: 'rgba(102, 126, 234, 0.8)',
                        borderColor: '#667eea',
                        borderWidth: 0,
                        borderRadius: 8,
                        hoverBackgroundColor: '#667eea'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(100, 116, 139, 0.1)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                },
                                font: {
                                    size: 11
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                callback: function(value) {
                                    const label = this.getLabelForValue(value);
                                    return label.length > 12 ? label.slice(0, 12) + '…' : label;
                                },
                                maxRotation: 0,
                                minRotation: 0,
                                autoSkip: true,
                                maxTicksLimit: 6
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(30, 41, 59, 0.9)',
                            titleFont: {
                                size: 14,
                                weight: '600'
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return 'Budget: $' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        }

        // Hours Chart
        @if(count($hoursProjectNames) > 0)
        const hoursCtx = document.getElementById('hoursChart');
        if (hoursCtx) {
            new Chart(hoursCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($hoursProjectNames) !!},
                    datasets: [{
                        label: 'Total Hours',
                        data: {!! json_encode($hoursProjectTotals) !!},
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(100, 116, 139, 0.1)'
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                callback: function(value) {
                                    const label = this.getLabelForValue(value);
                                    return label.length > 12 ? label.slice(0, 12) + '…' : label;
                                },
                                maxRotation: 0,
                                minRotation: 0,
                                autoSkip: true,
                                maxTicksLimit: 6
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(30, 41, 59, 0.9)',
                            titleFont: {
                                size: 14,
                                weight: '600'
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 12,
                            cornerRadius: 8
                        }
                    }
                }
            });
        }
        @endif

        // Add interactive animations
        const statCards = document.querySelectorAll('.stat-card-modern');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Chart action buttons
        document.querySelectorAll('.btn-chart-action').forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 100);
            });
        });
    });
</script>
@endsection

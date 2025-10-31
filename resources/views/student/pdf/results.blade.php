<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tech Recommendations PDF</title>
    <style>
        @page {
            margin: 15px;
            size: A4;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            color: #222;
            background: #fff;
            font-size: 12px;
            line-height: 1.3;
        }
        .container {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 6px;
            padding: 16px;
            margin: 0 auto;
            width: 95%;
            max-height: calc(100vh - 40px);
        }
        .header {
            background: #667eea;
            color: #fff;
            padding: 16px 0 12px 0;
            text-align: center;
            border-radius: 6px 6px 0 0;
            margin-bottom: 12px;
        }
        .header h1 {
            font-size: 1.6em;
            margin: 0 0 4px 0;
            font-weight: bold;
        }
        .header .subtitle {
            font-size: 0.9em;
            margin-bottom: 8px;
        }
        .user-info {
            background: #e0e7ff;
            color: #222;
            padding: 4px 12px;
            border-radius: 12px;
            display: inline-block;
            font-size: 0.9em;
        }
        .content {
            padding: 8px 0;
        }
        .intro {
            text-align: center;
            margin-bottom: 12px;
            padding: 8px;
            background: #f8f9ff;
            border-radius: 4px;
            border-left: 3px solid #667eea;
        }
        .intro h2 {
            color: #4a5568;
            margin: 0 0 4px 0;
            font-size: 1em;
        }
        .intro p {
            color: #718096;
            margin: 0;
            font-size: 0.85em;
        }
        .stats-section {
            background: #f1f3f8;
            padding: 8px;
            border-radius: 4px;
            margin: 10px 0;
            text-align: center;
        }
        .stats-section h3 {
            margin: 0 0 6px 0;
            color: #4a5568;
            font-size: 1em;
        }
        .stats-grid {
            width: 100%;
            margin-top: 6px;
            display: table;
        }
        .stat-item {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }
        .stat-number {
            font-size: 1.1em;
            font-weight: bold;
            color: #667eea;
            display: block;
        }
        .stat-label {
            color: #6c757d;
            font-size: 0.75em;
            margin-top: 1px;
        }
        .recommendations-grid {
            margin-top: 10px;
        }
        .rec-card {
            background: #f8f9fa;
            border-radius: 4px;
            padding: 10px;
            border: 1px solid #e0e7ff;
            margin-bottom: 6px;
            position: relative;
        }
        .rank-indicator {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(0,0,0,0.1);
            color: #666;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.7em;
        }
        .rec-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }
        .field-name {
            font-size: 1em;
            font-weight: bold;
            color: #222;
            margin: 0;
            flex: 1;
            padding-right: 25px;
        }
        .score-badge {
            background: #667eea;
            color: #fff;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 0.8em;
            white-space: nowrap;
        }
        .progress-container {
            margin-top: 6px;
            background: #e9ecef;
            border-radius: 8px;
            height: 8px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            border-radius: 8px;
            transition: width 0.3s ease;
        }
        .progress-bar-1 {
            background: #4CAF50;
        }
        .progress-bar-2 {
            background: #36b8f4ff;
        }
        .progress-bar-3 {
            background: #FFC107;
        }

        .score-text {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75em;
            color: #666;
            margin-top: 2px;
        }
        .description {
            font-size: 0.85em;
            color: #555;
            margin-top: 4px;
            padding: 6px;
            background: #fff;
            border-radius: 3px;
            border-left: 2px solid #e0e7ff;
            line-height: 1.2;
        }
        .footer {
            background: #f8f9fa;
            padding: 8px;
            text-align: center;
            border-top: 1px solid #e0e7ff;
            margin-top: 10px;
            border-radius: 0 0 6px 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .powered-by {
            color: #6c757d;
            font-size: 0.8em;
            font-weight: bold;
        }
        .generation-date {
            color: #6c757d;
            font-size: 0.75em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Your Tech Recommendations</h1>
            <div class="subtitle">Personalized Career Path Analysis</div>
            <div class="user-info">
                Generated for: <strong>{{ Auth::user()->name }}</strong>
            </div>
        </div>

        <div class="content">
            <div class="intro">
                <h2>Your Personalized Tech Journey</h2>
                <p>Based on your answers and preferences, here are your top technology field matches.</p>
            </div>

            <div class="stats-section">
                <h3>Analysis Overview</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-number">{{ $recommendations->count() }}</span>
                        <div class="stat-label">Fields Analyzed</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ round($recommendations->take(3)->avg('score') * 100) }}%</span>
                        <div class="stat-label">Avg. Match Score</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">Top 3</span>
                        <div class="stat-label">Recommendations</div>
                    </div>
                </div>
            </div>

            <div class="recommendations-grid">
                @foreach($recommendations->take(3) as $index => $rec)
                    <div class="rec-card">
                        <div class="rank-indicator">#{{ $index + 1 }}</div>
                        <div class="rec-header">
                            <h3 class="field-name">{{ $rec->techField->name }}</h3>
                            <!-- <div class="score-badge">{{ round($rec->score * 100) }}%</div> -->
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar progress-bar-{{ $index + 1 }}" style="width: {{ round($rec->score * 100) }}%;"></div>
                        </div>
                        <div class="score-text">
                            <span>Match Score</span>
                            <span><strong>{{ round($rec->score * 100) }}% compatibility</strong></span>
                        </div>
                        <div class="description">
                            {{ $rec->techField->description }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="footer">
            <div class="powered-by">
                🎯 Powered by <strong>CSSuggest</strong>
            </div>
            <div class="generation-date">
                Generated on {{ date('M j') }}
            </div>
        </div>
    </div>
</body>
</html>
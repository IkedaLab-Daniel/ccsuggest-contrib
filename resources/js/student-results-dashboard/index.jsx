import React from 'react';
import { createRoot } from 'react-dom/client';
import ResultsAnalyticsDashboard from './ResultsAnalyticsDashboard';

function parseChartPayload(element) {
    const raw = element.dataset.chartPayload;
    if (!raw) {
        return {};
    }

    try {
        const parsed = JSON.parse(raw);
        return parsed && typeof parsed === 'object' ? parsed : {};
    } catch (error) {
        console.error('Could not parse chart payload data for dashboard.', error);
        return {};
    }
}

export function mountResultsAnalyticsDashboard() {
    const rootElement = document.getElementById('results-analytics-dashboard');
    if (!rootElement) {
        return;
    }

    const chartPayload = parseChartPayload(rootElement);
    const root = createRoot(rootElement);

    root.render(<ResultsAnalyticsDashboard chartPayload={chartPayload} />);
}

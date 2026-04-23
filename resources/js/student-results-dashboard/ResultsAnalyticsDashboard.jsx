import React, { useMemo, useState } from 'react';
import {
    sanitizeChartPayload,
} from './chartData';
import ChartCard from './components/ChartCard';
import TopMatchesBarChart from './components/TopMatchesBarChart';

export default function ResultsAnalyticsDashboard({ chartPayload = {} }) {
    const dashboardData = useMemo(() => sanitizeChartPayload(chartPayload), [chartPayload]);
    const {
        barData,
    } = dashboardData;

    const [selectedCareer, setSelectedCareer] = useState(barData[0]?.name || '');

    if (!barData.length) {
        return null;
    }

    return (
        <div className="mb-6 space-y-6">
            <ChartCard
                title="Recommendation Analytics"
                subtitle="Interactive comparison of your top technology career matches."
            >
                <TopMatchesBarChart
                    data={barData}
                    selectedCareer={selectedCareer}
                    onSelectCareer={setSelectedCareer}
                />
            </ChartCard>
        </div>
    );
}

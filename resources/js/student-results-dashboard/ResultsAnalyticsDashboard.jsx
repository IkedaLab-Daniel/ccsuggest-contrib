import React, { useMemo, useState } from 'react';
import {
    sanitizeChartPayload,
} from './chartData';
import ChartCard from './components/ChartCard';
import TopMatchesBarChart from './components/TopMatchesBarChart';
import RecommendationPieChart from './components/RecommendationPieChart';

export default function ResultsAnalyticsDashboard({ chartPayload = {} }) {
    const dashboardData = useMemo(() => sanitizeChartPayload(chartPayload), [chartPayload]);
    const {
        barData,
        donutData,
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

            <ChartCard
                title="Recommendation Distribution"
                subtitle="Overall recommendation share (Top 5 fields + Others) with visible percentages."
            >
                <RecommendationPieChart data={donutData} topLabel={`Top Match: ${barData[0]?.name || 'N/A'}`} />
            </ChartCard>
        </div>
    );
}

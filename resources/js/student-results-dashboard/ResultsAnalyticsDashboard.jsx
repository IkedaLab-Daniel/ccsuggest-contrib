import React, { useMemo, useState } from 'react';
import {
    MUTED_TEXT,
    getCareerByName,
    getColorForIndex,
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
        selectedCareerDetails,
    } = dashboardData;

    const [selectedCareer, setSelectedCareer] = useState(barData[0]?.name || '');
    const selectedCareerInfo = getCareerByName(selectedCareerDetails, selectedCareer);
    const selectedCareerColor = useMemo(() => {
        const selectedIndex = barData.findIndex((item) => item.name === selectedCareer);
        return getColorForIndex(selectedIndex >= 0 ? selectedIndex : 0);
    }, [barData, selectedCareer]);

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

            <ChartCard title={`Focused Insight: ${selectedCareerInfo?.name || 'Top Career'}`} subtitle="Click a bar above to filter and highlight details for that career.">
                <div
                    className="rounded-lg border p-4"
                    style={{ borderColor: selectedCareerColor, background: '#f8fafc' }}
                >
                    <p className="text-sm font-semibold" style={{ color: selectedCareerColor }}>
                        Match Score: {selectedCareerInfo?.score || 0}%
                    </p>
                    <p className="text-sm mt-2" style={{ color: MUTED_TEXT }}>
                        {selectedCareerInfo?.explanation || 'No additional details available yet.'}
                    </p>
                    <div className="mt-3">
                        <p className="text-xs font-semibold uppercase tracking-wide text-slate-500 mb-2">Why This Match</p>
                        <ul className="list-disc pl-5 text-sm text-slate-700 space-y-1">
                            {(selectedCareerInfo?.details || []).map((item) => (
                                <li key={item}>{item}</li>
                            ))}
                        </ul>
                    </div>
                </div>
            </ChartCard>
        </div>
    );
}

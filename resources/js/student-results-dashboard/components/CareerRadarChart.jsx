import React from 'react';
import {
    Legend,
    Radar,
    RadarChart,
    PolarAngleAxis,
    PolarGrid,
    PolarRadiusAxis,
    ResponsiveContainer,
    Tooltip,
} from 'recharts';

function RadarTooltip({ active, payload }) {
    if (!active || !payload || !payload.length) {
        return null;
    }

    const point = payload[0].payload;

    return (
        <div className="bg-white border border-slate-200 rounded-md shadow-sm p-3 max-w-xs">
            <p className="text-sm font-semibold text-slate-900">{point.axis}</p>
            <div className="mt-1 space-y-1">
                {payload.map((entry) => (
                    <p key={entry.dataKey} className="text-xs text-slate-700">
                        <span className="font-semibold" style={{ color: entry.color }}>
                            {entry.name}:
                        </span>{' '}
                        {entry.value}%
                    </p>
                ))}
            </div>
            <p className="text-xs text-slate-600 mt-2">{point.explanation}</p>
        </div>
    );
}

export default function CareerRadarChart({ data, series }) {
    if (!data.length || !series.length) {
        return <p className="text-sm text-slate-600">Complete the questionnaire to unlock radar insights.</p>;
    }

    return (
        <div className="w-full h-80">
            <ResponsiveContainer width="100%" height="100%">
                <RadarChart data={data} outerRadius="72%">
                    <PolarGrid stroke="#cbd5e1" />
                    <PolarAngleAxis dataKey="axis" tick={{ fill: '#334155', fontSize: 12 }} />
                    <PolarRadiusAxis angle={30} domain={[0, 100]} tick={{ fill: '#64748b', fontSize: 11 }} />
                    <Tooltip content={<RadarTooltip />} />
                    <Legend wrapperStyle={{ fontSize: '12px' }} />
                    {series.map((seriesItem) => (
                        <Radar
                            key={seriesItem.key}
                            name={seriesItem.label}
                            dataKey={seriesItem.key}
                            stroke={seriesItem.color}
                            fill={seriesItem.color}
                            fillOpacity={0.2}
                            strokeWidth={2}
                            isAnimationActive
                            animationDuration={900}
                        />
                    ))}
                </RadarChart>
            </ResponsiveContainer>
        </div>
    );
}

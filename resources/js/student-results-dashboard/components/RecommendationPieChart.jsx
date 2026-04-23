import React, { useMemo, useState } from 'react';
import { Cell, Pie, PieChart, ResponsiveContainer, Tooltip } from 'recharts';
import { getColorForIndex } from '../chartData';

const MAX_VISIBLE_FIELDS = 5;
const OTHERS_COLOR = '#94a3b8';

function PieTooltip({ active, payload }) {
    if (!active || !payload || !payload.length) {
        return null;
    }

    const item = payload[0].payload;

    return (
        <div className="bg-white border border-slate-200 rounded-md shadow-sm p-3 max-w-xs">
            <p className="text-sm font-semibold text-slate-900">{item.name}</p>
            <p className="text-sm text-slate-700">{item.score}% of recommendation weight</p>
            {item.explanation ? <p className="text-xs text-slate-600 mt-1">{item.explanation}</p> : null}
        </div>
    );
}

export default function RecommendationPieChart({ data, topLabel = '' }) {
    const [activeIndex, setActiveIndex] = useState(null);

    const chartData = useMemo(() => {
        const normalized = [...data]
            .map((item) => ({
                ...item,
                score: Number(item.score) || 0,
            }))
            .filter((item) => item.score > 0)
            .sort((a, b) => b.score - a.score);

        if (normalized.length <= MAX_VISIBLE_FIELDS) {
            return normalized;
        }

        const visible = normalized.slice(0, MAX_VISIBLE_FIELDS);
        const hidden = normalized.slice(MAX_VISIBLE_FIELDS);
        const othersScore = Math.round(hidden.reduce((sum, item) => sum + item.score, 0));

        return [
            ...visible,
            {
                name: 'Others',
                score: othersScore,
                explanation: `Combined share of ${hidden.length} additional recommendation fields.`,
            },
        ];
    }, [data]);

    if (!chartData.length) {
        return <p className="text-sm text-slate-600">No recommendation distribution available.</p>;
    }

    const topMatchLabel =
        topLabel ||
        (chartData[0]?.name === 'Game Development'
            ? 'Top Match: Game Dev'
            : `Top Match: ${chartData[0]?.name || 'N/A'}`);

    return (
        <div className="space-y-4">
            <div className="text-center">
                <p className="text-xs font-semibold tracking-wide text-slate-500 uppercase">Recommendation Split</p>
                <p className="text-sm font-semibold text-slate-900 mt-1">{topMatchLabel}</p>
            </div>

            <div className="w-full h-80 relative">
                <ResponsiveContainer width="100%" height="100%">
                    <PieChart>
                        <Tooltip content={<PieTooltip />} />
                        <Pie
                            data={chartData}
                            dataKey="score"
                            nameKey="name"
                            cx="50%"
                            cy="50%"
                            outerRadius={125}
                            paddingAngle={3}
                            labelLine={false}
                            label={({ percent }) => `${Math.round(percent * 100)}%`}
                            isAnimationActive
                            animationDuration={900}
                            onMouseLeave={() => setActiveIndex(null)}
                        >
                            {chartData.map((entry, index) => {
                                const fill = entry.name === 'Others' ? OTHERS_COLOR : getColorForIndex(index);
                                return (
                                    <Cell
                                        key={`${entry.name}-${index}`}
                                        fill={fill}
                                        fillOpacity={activeIndex === null || activeIndex === index ? 1 : 0.55}
                                        stroke="#ffffff"
                                        strokeWidth={2}
                                        onMouseEnter={() => setActiveIndex(index)}
                                        style={{ transition: 'all 180ms ease' }}
                                    />
                                );
                            })}
                        </Pie>
                    </PieChart>
                </ResponsiveContainer>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                {chartData.map((entry, index) => {
                    const isActive = activeIndex === null || activeIndex === index;
                    return (
                        <div
                            key={`${entry.name}-distribution`}
                            className={`rounded-md border px-3 py-2 transition-all duration-150 ${isActive ? 'border-slate-300 bg-slate-50' : 'border-slate-200 bg-white opacity-80'}`}
                        >
                            <div className="flex items-center justify-between">
                                <div className="flex items-center gap-2">
                                    <span
                                        className="inline-block w-2.5 h-2.5 rounded-full"
                                        style={{ backgroundColor: entry.name === 'Others' ? OTHERS_COLOR : getColorForIndex(index) }}
                                    ></span>
                                    <span className="text-sm font-medium text-slate-800">{entry.name}</span>
                                </div>
                                <span className="text-sm font-semibold text-slate-900">{entry.score}%</span>
                            </div>
                            <p className="text-xs text-slate-600 mt-1">{entry.explanation}</p>
                        </div>
                    );
                })}
            </div>
        </div>
    );
}
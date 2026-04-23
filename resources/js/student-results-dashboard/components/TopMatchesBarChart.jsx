import React from 'react';
import {
    Bar,
    BarChart,
    Cell,
    LabelList,
    ResponsiveContainer,
    Tooltip,
    XAxis,
    YAxis,
} from 'recharts';
import { NEUTRAL_COLOR, PRIMARY_COLOR, getColorForIndex } from '../chartData';

function BarTooltip({ active, payload }) {
    if (!active || !payload || !payload.length) {
        return null;
    }

    const item = payload[0].payload;

    return (
        <div className="bg-white border border-slate-200 rounded-md shadow-sm p-3 max-w-xs">
            <p className="text-sm font-semibold text-slate-900">{item.name}</p>
            <p className="text-sm text-slate-700">{item.score}% match</p>
            <p className="text-xs text-slate-600 mt-1">{item.explanation}</p>
        </div>
    );
}

export default function TopMatchesBarChart({ data, selectedCareer, onSelectCareer }) {
    if (!data.length) {
        return <p className="text-sm text-slate-600">No recommendation data available yet.</p>;
    }

    const maxScore = Math.max(...data.map((item) => item.score), 25);

    return (
        <div className="w-full h-72">
            <ResponsiveContainer width="100%" height="100%">
                <BarChart
                    data={data}
                    layout="vertical"
                    margin={{ top: 8, right: 40, left: 24, bottom: 8 }}
                >
                    <XAxis type="number" domain={[0, maxScore]} tick={{ fill: '#64748b', fontSize: 12 }} />
                    <YAxis
                        type="category"
                        dataKey="name"
                        tick={{ fill: '#0f172a', fontSize: 13 }}
                        width={130}
                    />
                    <Tooltip cursor={{ fill: '#f1f5f9' }} content={<BarTooltip />} />
                    <Bar
                        dataKey="score"
                        radius={[0, 8, 8, 0]}
                        isAnimationActive
                        animationDuration={900}
                        onClick={(entry) => onSelectCareer(entry.name)}
                        style={{ cursor: 'pointer' }}
                    >
                        <LabelList
                            dataKey="score"
                            position="right"
                            formatter={(value) => `${value}%`}
                            fill="#334155"
                            fontSize={12}
                        />
                        {data.map((item, index) => {
                            const isTop = index === 0;
                            const isSelected = selectedCareer === item.name;
                            const fill = isSelected
                                ? getColorForIndex(index)
                                : isTop
                                ? PRIMARY_COLOR
                                : NEUTRAL_COLOR;

                            return <Cell key={item.name} fill={fill} />;
                        })}
                    </Bar>
                </BarChart>
            </ResponsiveContainer>
        </div>
    );
}

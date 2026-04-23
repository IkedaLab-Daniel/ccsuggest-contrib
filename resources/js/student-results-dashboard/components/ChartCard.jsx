import React from 'react';

export default function ChartCard({ title, subtitle, children, extraClass = '' }) {
    return (
        <section className={`bg-white p-6 rounded-lg shadow ${extraClass}`}>
            <header className="mb-5">
                <h3 className="text-xl font-semibold text-slate-900">{title}</h3>
                {subtitle ? <p className="text-sm text-slate-600 mt-1">{subtitle}</p> : null}
            </header>
            {children}
        </section>
    );
}

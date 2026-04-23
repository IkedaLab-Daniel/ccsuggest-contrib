export const PRIMARY_COLOR = '#1d4ed8';
export const NEUTRAL_COLOR = '#cbd5e1';
export const MUTED_TEXT = '#475569';

const CHART_COLORS = ['#1d4ed8', '#3b82f6', '#1e3a8a', '#60a5fa', '#93c5fd', '#bfdbfe'];

function toPercent(value) {
    const numeric = Number(value);
    if (!Number.isFinite(numeric)) {
        return 0;
    }

    return Math.max(0, Math.min(100, Math.round(numeric)));
}

function normalizeItem(item) {
    return {
        name: item?.name || 'Unknown',
        score: toPercent(item?.score),
        explanation: item?.explanation || 'Computed from your questionnaire response pattern.',
        details: Array.isArray(item?.details) && item.details.length
            ? item.details
            : [
                  'This score comes from your latest questionnaire run and recommendation model output.',
                  'Use the charts to compare how this match performs across different competency dimensions.',
              ],
    };
}

export function getColorForIndex(index) {
    return CHART_COLORS[index % CHART_COLORS.length];
}

export function sanitizeChartPayload(payload = {}) {
    const barData = Array.isArray(payload.barData)
        ? payload.barData.map(normalizeItem).sort((a, b) => b.score - a.score)
        : [];

    const donutData = Array.isArray(payload.donutData)
        ? payload.donutData.map(normalizeItem).sort((a, b) => b.score - a.score)
        : [];

    const radarSeries = Array.isArray(payload.radarSeries)
        ? payload.radarSeries.map((series, index) => ({
              key: series?.key || `career_${index}`,
              label: series?.label || `Career ${index + 1}`,
              score: toPercent(series?.score),
              color: getColorForIndex(index),
          }))
        : [];

    const radarData = Array.isArray(payload.radarData)
        ? payload.radarData.map((row) => {
              const normalized = {
                  axis: row?.axis || 'Axis',
                  explanation: row?.explanation || 'Computed from your questionnaire responses.',
              };

              radarSeries.forEach((series) => {
                  normalized[series.key] = toPercent(row?.[series.key]);
              });

              return normalized;
          })
        : [];

    const selectedCareerDetails = Array.isArray(payload.selectedCareerDetails)
        ? payload.selectedCareerDetails.map(normalizeItem)
        : barData;

    return {
        barData,
        donutData,
        radarData,
        radarSeries,
        selectedCareerDetails,
    };
}

export function getCareerByName(details = [], name = '') {
    return details.find((item) => item.name === name) || details[0] || null;
}

export function getRadarStrengths(radarData = [], seriesKey = '') {
    if (!seriesKey) {
        return [];
    }

    return radarData
        .map((item) => ({
            axis: item.axis,
            value: toPercent(item[seriesKey]),
        }))
        .sort((a, b) => b.value - a.value);
}

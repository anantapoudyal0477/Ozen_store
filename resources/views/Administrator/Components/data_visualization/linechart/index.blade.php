<div class="bg-white rounded-2xl shadow-md p-6">
    @isset($title)
        <h3 class="text-gray-700 font-bold text-lg mb-4">{{ $title }}</h3>
    @endisset
    <canvas id="{{ $id ?? 'lineChart' }}"></canvas>

    <script>
        const lineData = @json($data);
        new Chart(document.getElementById('{{ $id ?? 'lineChart' }}'), {
            type: 'line',
            data: {
                labels: lineData.map(d => d.label),
                datasets: [{
                    label: '{{ $label ?? "Data" }}',
                    data: lineData.map(d => d.value),
                    borderColor: '{{ $color ?? "#6366F1" }}',
                    backgroundColor: '{{ $bgColor ?? "rgba(99, 102, 241, 0.2)" }}',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</div>

<div class="bg-white rounded-2xl shadow-md p-6">
    @isset($title)
        <h3 class="text-gray-700 font-bold text-lg mb-4">{{ $title }}</h3>
    @endisset
    <canvas id="{{ $id ?? 'barChart' }}"></canvas>

    <script>
        const barData = @json($data);
        new Chart(document.getElementById('{{ $id ?? 'barChart' }}'), {
            type: 'bar',
            data: {
                labels: barData.map(d => d.label),
                datasets: [{
                    label: '{{ $label ?? "Data" }}',
                    data: barData.map(d => d.value),
                    backgroundColor: '{{ $color ?? "rgba(99, 102, 241, 0.8)" }}',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }
                }
            }
        });
    </script>
</div>

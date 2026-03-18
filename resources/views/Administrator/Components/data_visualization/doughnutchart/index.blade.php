<div class="bg-white rounded-2xl shadow-md p-6">
    @isset($title)
        <h3 class="text-gray-700 font-bold text-lg mb-4">{{ $title }}</h3>
    @endisset
    <canvas id="{{ $id ?? 'doughnutChart' }}"></canvas>

    <script>
        const doughnutData = @json($data);
        new Chart(document.getElementById('{{ $id ?? 'doughnutChart' }}'), {
            type: 'doughnut',
            data: {
                labels: doughnutData.map(d => d.label),
                datasets: [{
                    data: doughnutData.map(d => d.value),
                    backgroundColor: doughnutData.map(d => d.color),
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#4B5563', padding: 20, font: { size: 14 } }
                    }
                }
            }
        });
    </script>
</div>

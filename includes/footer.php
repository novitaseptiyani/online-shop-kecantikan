        <footer class="text-center py-3">
            <p>&copy; 2025 VeeBeauté. Crafted with care, confidence, and a little shimmer.</p>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="assets/js/script.js"></script>

        <script>
            const ctx = document.getElementById('salesChart').getContext('2d');

            const chartLabels = <?= json_encode($chart_labels); ?>;
            const chartData = <?= json_encode($chart_values); ?>;

            const salesChart = new Chart(ctx, {
                type: 'line', 
                data: {
                    labels: chartLabels, 
                    datasets: [{
                        label: 'Jumlah Pesanan', 
                        data: chartData, 
                        borderColor: 'rgba(75, 192, 192, 1)', 
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', 
                        borderWidth: 2, 
                        tension: 0.3, 
                        fill: true 
                    }]
                },
                options: {
                    responsive: true, 
                    maintainAspectRatio: false, 
                    plugins: {
                        legend: {
                            display: true 
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        },
                        y: {
                            beginAtZero: true, 
                            title: {
                                display: true,
                                text: 'Jumlah Pesanan'
                            },
                            ticks: {
                                callback: function(value) {
                                    if (Number.isInteger(value)) {
                                        return value;
                                    }
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </body>
</html>

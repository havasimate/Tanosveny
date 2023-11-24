<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tanösvények eloszlása</h5>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Setup Block
    const park_names = <?php echo json_encode($viewData['uzenet']['park']) ?>;
    const park_count = <?php echo json_encode($viewData['uzenet']['darab']) ?>;
    const data = {
        labels: park_names,
        datasets: [{
            label: 'Tanösvények száma',
            data: park_count,
            borderWidth: 1,
            backgroundColor: 'blue',
        }]
    };

    // Config Block
    const config = {
        type: 'line',
        data,
        options: {
            plugins: {
                legend: {
                    title: {
                        padding: 10
                    },
                    labels: {
                        color: 'black',
                        font: {
                            size: 18
                        }
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        color: '#black',
                    },
                    beginAtZero: true,
                },
                x: {
                    ticks: {
                        color: '#black',
                    }
                }
            }
        },
    }

    // Render Block
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

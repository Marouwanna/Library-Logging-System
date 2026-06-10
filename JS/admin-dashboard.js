document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById("loginChart").getContext("2d");

    let loginChart;

    function loadChart() {

        fetch("../Assets/stats.php")
            .then(res => res.json())
            .then(data => {

                const adminCount = Number(data.admins) || 0;
                const visitorCount = Number(data.visitors) || 0;

                if (loginChart) loginChart.destroy();

                loginChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Admins', 'Visitors'],
                        datasets: [{
                            label: 'Total Logins',
                            data: [adminCount, visitorCount],
                            backgroundColor: ['#111827', '#3b82f6']
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });

            })
            .catch(err => console.error(err));

    }

    loadChart();
    setInterval(loadChart, 3000); 

});
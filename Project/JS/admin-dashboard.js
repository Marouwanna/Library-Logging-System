const tableBody = document.getElementById("log-table-body");

const ctx = document.getElementById("loginChart");

let loginChart;

function loadLogs(){

    let logs = JSON.parse(localStorage.getItem("libraryLogs")) || [];

    tableBody.innerHTML = "";

    let visitorCount = 0;
    let adminCount = 0;

    logs.forEach(log => {

        // TABLE
        const row = `
            <tr>
                <td>${log.type}</td>
                <td>${log.name}</td>
                <td>${log.time}</td>
            </tr>
        `;

        tableBody.innerHTML += row;

        // COUNT USERS
        if(log.type === "Visitor"){
            visitorCount++;
        }

        if(log.type === "Admin"){
            adminCount++;
        }

    });

    // DESTROY OLD CHART
    if(loginChart){
        loginChart.destroy();
    }

    // CREATE NEW CHART
    loginChart = new Chart(ctx, {

        type: 'bar',

        data: {

            labels: ['Visitors', 'Admins'],

            datasets: [{

                label: 'Total Logins',

                data: [visitorCount, adminCount],

                backgroundColor: [
                    '#4f46e5',
                    '#111827'
                ],

                borderRadius: 10

            }]

        },

        options: {

            responsive: true,

            plugins: {

                legend: {
                    display: false
                },

                title: {
                    display: true,
                    text: 'Library Login Statistics'
                }

            }

        }

    });

}

// LOAD
loadLogs();

// AUTO UPDATE
setInterval(loadLogs, 1000);
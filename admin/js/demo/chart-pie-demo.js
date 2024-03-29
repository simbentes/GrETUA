var xmlhttp2 = new XMLHttpRequest();
xmlhttp2.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {


        var total = JSON.parse(this.responseText);


        // Pie Chart
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Publicações", "Likes", "Comentários"],
                datasets: [{
                    data: total,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });


    }
};

xmlhttp2.open("GET", "scripts/sc_interacoes_mes.php", true);
xmlhttp2.send();


















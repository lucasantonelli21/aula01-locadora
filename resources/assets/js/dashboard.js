$("page-dashboard", function () {
    var $page = $(this);
    var $renteds = $page.find(".renteds");
    var $chart = $page.find("#myChart");

    var data = $renteds.data("renteds");
    var names = [];
    var rentedAmount = [];
    data.forEach((element) => {
        names.push(element.name);
        rentedAmount.push(element.rented);
    });

    var backgroundColor = [
        "rgba(255, 99, 132, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(255, 205, 86, 0.2)",
        "rgba(75, 192, 192, 0.2)",
        "rgba(54, 162, 235, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(201, 203, 207, 0.2)",
    ];

    var borderColor = [
        "rgb(255, 99, 132)",
        "rgb(255, 159, 64)",
        "rgb(255, 205, 86)",
        "rgb(75, 192, 192)",
        "rgb(54, 162, 235)",
        "rgb(153, 102, 255)",
        "rgb(201, 203, 207)",
    ];

    var datasets = [];
    var cont = 0;
    data.forEach((element) => {
        var dataset = [
            {
                label: `Number of Rents of ${element.name}`,
                data: element.rented,
                borderWidth: 1,
                backgroundColor: backgroundColor[cont],
                borderColor: borderColor[cont],
            },
        ];
      cont++ == 7 ? cont = 0 : cont++;
      datasets.push(dataset);
    });

    var chart = new Chart($chart, {
        type: "bar",
        data: {
            labels: names,
            datasets: [
                {
                    label: `Number of Rents of ${name}`,
                    data: rentedAmount,
                    borderWidth: 1,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 205, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(201, 203, 207, 0.2)",
                    ],
                    borderColor: [
                        "rgb(255, 99, 132)",
                        "rgb(255, 159, 64)",
                        "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)",
                        "rgb(54, 162, 235)",
                        "rgb(153, 102, 255)",
                        "rgb(201, 203, 207)",
                    ],
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
});

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
        <link rel="stylesheet" href="https://rawcdn.githack.com/Loopple/loopple-public-assets/ad60f16c8a16d1dcad75e176c00d7f9e69320cd4/argon-dashboard/css/nucleo/css/nucleo.css">


        <link rel="stylesheet" href="{{asset('/network/assets/css/theme.css')}}">
        <link rel="stylesheet" href="{{asset('/network/assets/css/loopple/loopple.css')}}">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia













        <script src="https://rawcdn.githack.com/Loopple/loopple-public-assets/5cef8f62939eeb089fa26d4c53a49198de421e3d/argon-dashboard/js/vendor/jquery.min.js"></script>
        <script src="https://rawcdn.githack.com/Loopple/loopple-public-assets/5cef8f62939eeb089fa26d4c53a49198de421e3d/argon-dashboard/js/vendor/bootstrap.bundle.min.js"></script>
        <script src="https://rawcdn.githack.com/Loopple/loopple-public-assets/5cef8f62939eeb089fa26d4c53a49198de421e3d/argon-dashboard/js/vendor/js.cookie.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script src="https://rawcdn.githack.com/Loopple/loopple-public-assets/5cef8f62939eeb089fa26d4c53a49198de421e3d/argon-dashboard/js/vendor/chart.extension.js"></script>
        <script src="https://rawcdn.githack.com/Loopple/loopple-public-assets/7bb803d2af2ab6d71d429b0cb459c24a4cd0fbb4/argon-dashboard/js/argon.min.js"></script>
        <script>
            if (document.querySelector(".chart-bar")) {
                var chartsBar = document.querySelectorAll(".chart-bar");

                chartsBar.forEach(function(chart) {
                    new Chart(chart, {
                        type: "bar",
                        data: {
                            labels: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            datasets: [
                                {
                                    label: "Sales",
                                    tension: 0.4,
                                    borderWidth: 0,
                                    pointRadius: 0,
                                    backgroundColor: "#fb6340",
                                    data: [25, 20, 30, 22, 17, 29],
                                    maxBarThickness: 10,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false,
                            },
                            tooltips: {
                                enabled: true,
                                mode: "index",
                                intersect: false,
                            },
                            scales: {
                                yAxes: [
                                    {
                                        gridLines: {
                                            borderDash: [2],
                                            borderDashOffset: [2],
                                            drawTicks: false,
                                            drawBorder: false,
                                            lineWidth: 1,
                                            zeroLineWidth: 0,
                                            zeroLineBorderDash: [0],
                                            zeroLineBorderDashOffset: [2],
                                        },
                                        ticks: {
                                            beginAtZero: true,
                                            padding: 10,
                                            fontSize: 13,
                                            lineHeight: 5,
                                            fontColor: "#8898aa",
                                            fontFamily: "Open Sans",
                                        },
                                    },
                                ],
                                xAxes: [
                                    {
                                        gridLines: {
                                            display: false,
                                            drawBorder: false,
                                            drawOnChartArea: false,
                                            drawTicks: false,
                                        },
                                        ticks: {
                                            padding: 20,
                                            fontSize: 13,
                                            fontColor: "#8898aa",
                                            fontFamily: "Open Sans",
                                        },
                                    },
                                ],
                            },
                        },
                    });
                });
            }

            if (document.querySelector(".chart-line")) {

                var chartsLine = document.querySelectorAll(".chart-line");

                chartsLine.forEach(function(chart) {

                    new Chart(chart, {
                        type: "line",
                        data: {
                            labels: ["May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            datasets: [{
                                label: "Performance",
                                tension: 0.4,
                                borderWidth: 4,
                                borderColor: "#5e72e4",
                                pointRadius: 0,
                                backgroundColor: "transparent",
                                data: [0, 20, 10, 30, 15, 40, 20, 60, 60],
                            }, ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false,
                            },
                            tooltips: {
                                enabled: true,
                                mode: "index",
                                intersect: false,
                            },
                            scales: {
                                yAxes: [{
                                    barPercentage: 1.6,
                                    gridLines: {
                                        drawBorder: false,
                                        color: "rgba(29,140,248,0.0)",
                                        zeroLineColor: "transparent",
                                    },
                                    ticks: {
                                        padding: 0,
                                        fontColor: "#8898aa",
                                        fontSize: 13,
                                        fontFamily: "Open Sans",
                                    },
                                }, ],
                                xAxes: [{
                                    barPercentage: 1.6,
                                    gridLines: {
                                        drawBorder: false,
                                        color: "rgba(29,140,248,0.0)",
                                        zeroLineColor: "transparent",
                                    },
                                    ticks: {
                                        padding: 10,
                                        fontColor: "#8898aa",
                                        fontSize: 13,
                                        fontFamily: "Open Sans",
                                    },
                                }, ],
                            },
                            layout: {
                                padding: 0,
                            },
                        },
                    });

                });
            }
        </script>
    </body>
</html>

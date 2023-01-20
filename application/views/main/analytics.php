<style>
.input-group-text {
    background: #FFEFBA;
    /* fallback for old browsers */
    background: -webkit-linear-gradient(to left, #FFFFFF, #FFEFBA);
    /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to left, #FFFFFF, #FFEFBA);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    color: orange;
    font-weight: 600;
}
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Analytics</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Analytics</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row g-2">
            <div class="col-md-3">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Date From</span>
                    <input type="date" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Date To</span>
                    <input type="date" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-sm">
                    <button class="btn btn-success btn-sm">Search</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Sort by Department</span>
                    <select class="form-select form-select-sm">
                        <option value="">Select Department...</option>
                        <option value="">Department A</option>
                        <option value="">Department B</option>
                        <option value="">Department C</option>
                        <option value="">Department D</option>
                        <option value="">Department E</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-7">
                <div class="row">

                    <!-- List Tickets -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Generate Reports Analytics</h5>
                                <div id="barChart"></div>

                                <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#barChart"), {
                                        series: [{
                                            data: [400, 430, 448, 470, 540, 580]
                                        }],

                                        chart: {
                                            type: 'bar',
                                            height: 315
                                        },
                                        plotOptions: {
                                            bar: {
                                                borderRadius: 4,
                                                horizontal: true,
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        xaxis: {
                                            categories: ['Criticals', 'High', 'Medium', 'Low',
                                                'Accomplished', 'AI Support'
                                            ],
                                        },

                                    }).render();
                                });
                                </script>
                            </div>
                        </div>


                    </div><!-- End list tickets -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-5">

                <!-- pie chart -->
                <div class="card info-card backlogs-card">
                    <div class="card-body">
                        <hr>
                        <div id="pieChart"></div>
                        <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new ApexCharts(document.querySelector("#pieChart"), {
                                series: [44, 55, 13, 43, 22],
                                chart: {
                                    height: 350,
                                    type: 'pie',
                                    toolbar: {
                                        show: true
                                    }
                                },
                                labels: ['Department A', 'Department B', 'Department C', 'Department D',
                                    'Department E'
                                ]
                            }).render();
                        });
                        </script>
                    </div>
                </div><!-- end pie chart -->

            </div><!-- End Right side columns -->

        </div>
    </section>

</main>
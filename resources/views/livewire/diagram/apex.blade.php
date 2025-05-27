<div>

    <div class="w-full grid gap-y-16 gap-x-10 md:grid-cols-2">
        <div id="chart1"></div>
        <div id="chart2"></div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        diagramLine = {
                        chart: {
                            type: 'line',
                            height: 350
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 10},
                        series: [
                            {
                                name: 'Rekon',
                                data: {!! json_encode(array_values($penerimaan)) !!}
                            }
                        ],
                        xaxis: {
                            categories: {!! json_encode(array_keys($penerimaan)) !!},
                            title: {
                                text: 'Tanggal'
                            },
                            labels: {
                                style: {
                                    colors: '#000000'
                                }
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Jumlah'
                            },
                            labels: {
                                style: {
                                    colors: '#000000'
                                }
                            }
                        }
                    };

        diagramBar = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    data: [{
                    x: 'Rekon',
                    y: {{ $totalTbDataRekon }}
                    }, {
                    x: 'BKUBUD',
                    y: {{ $totalTbDataBkubud }}
                    }]
                }]
                };

    var chart1 = new ApexCharts(document.querySelector("#chart1"), diagramLine);
    var chart2 = new ApexCharts(document.querySelector("#chart2"), diagramBar);

    chart1.render();
    chart2.render();
    </script>
    @endpush
</div>
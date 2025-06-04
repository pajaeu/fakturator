<div
    x-data='{
        chart: null,
        init() {
            const options = {
                chart: {
                    type: "line",
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                fill: {
                    colors: ["#155DFC"]
                },
                series: [
                    {
                        name: "{{ __('Total') }}",
                        type: "line",
                        data: @json($data)
                    },
                ],
                xaxis: {
                    categories: @json($labels)
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return Number(value).toLocaleString() + " Kč";
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                }
            };

            this.chart = new ApexCharts(this.$refs.container, options);
            this.chart.render();
        }
    }'
>
    <div x-ref="container"></div>
</div>
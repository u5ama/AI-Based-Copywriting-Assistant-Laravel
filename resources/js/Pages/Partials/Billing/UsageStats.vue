<template>
    <!--======= Usage ========-->
    <div class="billing-bg usage-graph">
        <h2>Usage</h2>
        <p>Words Generated in your Account Last 7 Days</p>
        <div class="graph" id="chartContainer">
            <apexchart ref="realtimeChart" type="line" height="350" :options="chartOptions" :series="series"></apexchart>
        </div>
        <div class="graph-content pt-4">
            <h2>Credits</h2>
            <p v-if="userSubscriptionsPlane != ''">Current package <strong v-if="userSubscriptionsPlane.plan.transform_usage != null">{{userSubscriptionsPlane.plan.transform_usage.divide_by}}</strong>, and You've generated <strong>{{trail_quantity_usage}}</strong> words since last month.</p>
<!--            <h2>Bonus Credits</h2>-->
<!--            <p>Available Bonus words in your account <strong>{{info.trail_bonus}}</strong>, and You've generated <strong>{{info.trail_bonus_usage}}</strong> Bonus words since last month.</p>-->
        </div>
    </div>
</template>
<script>
import VueApexCharts from "vue3-apexcharts";
import { defineComponent } from 'vue'
import {Head, Link} from "@inertiajs/inertia-vue3";

export default defineComponent( {
    name: "UsageStats",
    props:['statsDates', 'statsWordCounts', 'userSubscriptionsPlane','trail_quantity_usage'],
    components: {
        Head,
        Link,
        apexchart: VueApexCharts,
    },
    data() {
        return {
            searchTool: '',
            show_sidebar:false,
            chartOptions: {
                chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: false,
                    },
                    zoom:{
                        enabled: false,
                    }
                },
                stroke: {
                    width: 7,
                    curve: 'smooth'
                },
                xaxis: {
                    categories: this.statsDates,
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        type: 'horizontal',
                        //opacityFrom: 1,
                        //opacityTo: 1,
                        //stops: [0, 100, 100, 100],
                        colorStops: [
                            {
                                offset: 0,
                                color: "#FDD835",
                                opacity: 1
                            },{
                                offset: 20,
                                color: "#FFA41B",
                                opacity: 1
                            }, {
                                offset: 60,
                                color: "#ffa406",
                                opacity: 1
                            },{
                                offset: 100,
                                color: "#eb6e2d",
                                opacity: 1
                            },
                        ]
                    },
                },
                markers: {
                    size: 4,
                    colors: ["#FFA41B"],
                    strokeColors: "#FFA41B",
                    strokeWidth: 0,
                    hover: {
                        size: 7,
                    }
                },
                theme: {
                    mode: 'light',
                    palette: 'palette1',
                    monochrome: {
                        enabled: false,
                        color: '#FDD835',
                        shadeTo: 'light',
                        shadeIntensity: 0
                    },
                },
                yaxis: {
                    show: false,
                    title: {
                        text: 'Words',
                    },
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    }
                }
            },
            series: [{
                name: 'Words',
                data: this.statsWordCounts,
            }]
        }
    },
    mounted() {
        console.log(this.userSubscriptionsPlane.plan)
    }
})

</script>

<style scoped>

</style>

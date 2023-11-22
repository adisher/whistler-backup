<?php
$dk = array_keys($dates);
?>
<?php $__env->startSection('extra_css'); ?>
<style type="text/css">
    .info-box-4 .icon {
        position: absolute;
        right: 10px;
        bottom: 2px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .info-box-4 .icon.zoom-effect:hover {
        transform: scale(1.15);
        transition: transform 0.3s ease;
    }

    .fa-truck.active {
        animation: moveBackAndForth 2s infinite;
    }

    @keyframes moveBackAndForth {
        0% {
            transform: translateX(0);
        }

        50% {
            transform: translateX(-10px);
        }

        100% {
            transform: translateX(0);
        }
    }

    .info-box-4 {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        height: 80px;
        display: flex;
        cursor: default;
        background-color: #fff;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .info-box-4.hover-zoom-effect .icon i {
        -moz-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    .info-box-4 .icon i {
        color: rgba(3, 66, 255, 0.5);
        font-size: 60px;
    }

    .info-box-4 .content {
        display: inline-block;
        padding: 7px 16px;
    }

    .info-box-4 .content .text {
        font-size: 18px;
        margin-top: 11px;
        color: #555;
    }

    .info-box-4 .content .number {
        font-weight: normal;
        font-size: 26px;
        margin-top: -4px;
        color: #555;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-chevron-down mr-2" data-toggle="collapse" data-target="#shift-yield"></i>
                <h5 class="card-title mb-0">Shift Yield Production</h5>
            </div>
            <div class="card-body collapse show" id="shift-yield">
                <div class="chart">
                    <canvas id="shiftProduction" width="800" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-chevron-down mr-2" data-toggle="collapse" data-target="#work-hours"></i>
                <h5 class="card-title mb-0">Fleet Work Hours</h5>
            </div>

            <div class="card-body collapse show" id="work-hours">
                <div class="chart">
                    <canvas id="workHours" width="800" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    

</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/cdn/Chart.bundle.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/cdn/canvasjs.min.js')); ?>"></script>


<script type="text/javascript">
    // Function to toggle icons
        function toggleIcons() {
            $('[data-toggle="collapse"]').on('click', function() {
                var icon = $(this);
                icon.toggleClass('fa-chevron-down fa-chevron-up');
            });
        }

        // Function to handle year change
        function handleYearChange() {
            $("#year").on("change", function() {
                var year = this.value;
                window.location = "<?php echo e(url('admin/')); ?>" + "?year=" + year;
            });
        }

        // Function to initialize a line chart
        function initLineChart(canvasId, config) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            return new Chart(ctx, config);
        }

        // Function to initialize a bar chart
        function initBarChart(canvasId, config) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            return new Chart(ctx, {
                type: 'bar',
                ...config
            });
        }

        // // Function to get data and configuration for the Daily Production chart
        // function getDailyProductionConfig(daily) {
        //     // Handle the daily data
        //     let dailyLabels = Object.keys(daily).map(String);
        //     let dailyData = Object.values(daily);

        //     // Create a configuration for the weekly production chart
        //     const dailyConfig = {
        //         labels: dailyLabels,
        //         datasets: [{
        //             label: 'Daily Production (kg)',
        //             borderColor: 'rgb(255, 99, 132)',
        //             data: dailyData
        //         }]
        //     };
        //     return {
        //         data: dailyConfig,
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //         }
        //     };
        // }

        // function getWeeklyProductionConfig(weekly) {
        //     // Handle the weekly data
        //     let weeklyLabels = Object.keys(weekly).map(String).map(label => {
        //         const [year, week] = label.split('-');
        //         return `${year}\nWeek-${week}`;
        //     });
        //     let weeklyData = Object.values(weekly);

        //     // Create a configuration for the weekly production chart
        //     const weeklyConfig = {
        //         labels: weeklyLabels,
        //         datasets: [{
        //             label: 'Weekly Production (kg)',
        //             borderColor: 'rgb(255, 99, 132)',
        //             data: weeklyData
        //         }]
        //     };

        //     return {
        //         type: 'line',
        //         data: weeklyConfig,
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //         }
        //     };
        // }

        // // Function to get data and configuration for the Yearly Production chart
        // function getYearlyProductionConfig(yearly) {

        //     // Handle the yearly data
        //     let yearlyLabels = Object.keys(yearly).map(String);
        //     let yearlyData = Object.values(yearly);

        //     // Create a configuration for the weekly production chart
        //     const yearlyConfig = {
        //         labels: yearlyLabels,
        //         datasets: [{
        //             label: 'Daily Production (kg)',
        //             borderColor: 'rgb(255, 99, 132)',
        //             data: yearlyData
        //         }]
        //     };
        //     return {
        //         type: 'line',
        //         data: yearlyConfig,
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //         }
        //     };
        // }

        function getShiftProductionConfig(shifts) {
            const dates = Object.keys(shifts);
            const morningData = dates.map(date => shifts[date].morning || 0);
            const eveningData = dates.map(date => shifts[date].evening || 0);

            // Format dates for the x-axis
            const formattedDates = dates.map(date => date.split('-').reverse().join('-'));

            var barChartData = {
                labels: formattedDates, // These would be the dates
                datasets: [{
                        label: "Morning Shift",
                        xAxisID: 'xAxis1',
                        backgroundColor: "#FF0000",
                        categoryPercentage: 1,
                        barPercentage: 0.8,
                        data: morningData, // Data for the morning shifts
                    },
                    {
                        label: "Evening Shift",
                        xAxisID: 'xAxis1',
                        backgroundColor: "#0000FF",
                        categoryPercentage: 1,
                        barPercentage: 0.8,
                        data: eveningData, // Data for the evening shifts
                    }
                ]
            };

            // Function to calculate the total, weekly, and monthly yields
            function calculateYieldValues(shifts, dates) {
                const now = new Date();
                const today = now.toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
                const currentWeekNumber = getWeekNumber(now);
                const currentMonth = now.getMonth(); // January is 0!
                let dailyYield = 0;
                let weeklyYield = 0;
                let monthlyYield = 0;

                dates.forEach(date => {
                    const shiftDate = new Date(date);
                    const weekNumber = getWeekNumber(shiftDate);
                    const month = shiftDate.getMonth(); // January is 0!
                    const formattedShiftDate = shiftDate.toISOString().split('T')[0]; // Format to YYYY-MM-DD

                    const dailyTotal = (shifts[date].morning || 0) + (shifts[date].evening || 0);

                    if (weekNumber === currentWeekNumber) {
                        weeklyYield += dailyTotal;
                    }

                    if (month === currentMonth) {
                        monthlyYield += dailyTotal;
                    }

                    // Check if the date from the shifts is the same as today's date
                    if (formattedShiftDate === today) {
                        dailyYield = dailyTotal;
                    }
                });

                // Sum the daily, weekly, and monthly yields for total yield
                let totalYield = dailyYield + weeklyYield + monthlyYield;

                return {
                    dailyYield,
                    weeklyYield,
                    monthlyYield,
                    totalYield
                };
            }

            // Function to get week number of the year
            function getWeekNumber(d) {
                d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
                d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));
                const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
                const weekNo = Math.ceil(((d - yearStart) / 86400000 + 1) / 7);
                return weekNo;
            }

            // Calculate yield values
            const yields = calculateYieldValues(shifts, Object.keys(shifts));

            const config = {
                type: "bar",
                data: barChartData,
                options: {
                    scales: {
                        xAxes: [{
                            id: 'xAxis1',
                            type: 'category',
                            offset: true,
                            gridLines: {
                                offsetGridLines: true
                            },
                            ticks: {
                                autoSkip: false,
                                maxRotation: 0,
                                minRotation: 0,
                                callback: function(value, index, values) {
                                    // This callback will alternate between showing the date and shift name.
                                    return ['Morning \t\t\t\t\t\t\t\t\t\t Evening', value];
                                }
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: "Shift Production",
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false,
                    },
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    animation: {
                        duration: 500,
                        onProgress: function(animation) {
                            var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                            ctx.font = Chart.helpers.fontString('20', 'normal',
                                Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';
                            ctx.fontWeight = 'bold';
                            ctx.fillStyle = '#000';

                            this.data.datasets.forEach(function(dataset, i) {
                                var meta = chartInstance.controller.getDatasetMeta(i);
                                meta.data.forEach(function(bar, index) {
                                    var data = dataset.data[index];
                                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                                });
                            });
                        }
                    }
                },
                plugins: [{
                    id: 'custom-corner-text',
                    beforeDraw: (chart) => {
                        const ctx = chart.ctx;
                        ctx.save();
                        const chartArea = chart.chartArea;
                        const width = chart.width;
                        const fontSize = 18; // Adjust as needed
                        const padding = 10; // Add more padding if needed
                        ctx.font = `${fontSize}px sans-serif`;
                        ctx.textAlign = 'right';
                        ctx.textBaseline = 'top';
                        const textSpace = fontSize +
                            padding; // Calculate space needed for each line of text

                        // Set the y position to be just above the chart area
                        let yPos = chartArea.top - textSpace *
                            4; // Adjust multiplier based on the number of lines

                        // If the calculated y position is less than zero, reset it to a small padding from the top
                        yPos = yPos < 0 ? padding : yPos;

                        // Use the full width of the canvas minus padding for the x-coordinate
                        const xPos = width - padding;

                        ctx.fillText(`Today: ${yields.dailyYield} gms`, xPos, yPos);
                        ctx.fillText(`Weekly: ${yields.weeklyYield} gms`, xPos, yPos + textSpace);
                        ctx.fillText(`Monthly: ${yields.monthlyYield} gms`, xPos, yPos + textSpace * 2);
                        ctx.fillText(`Total: ${yields.totalYield} gms`, xPos, yPos + textSpace * 3);
                        ctx.restore();
                    }
                }]

            };

            return config;
        }

        function getWorkHrsChartConfig(shiftsData) {
            const organizedData = reorganizeData(shiftsData);
            const chartData = createChartData(organizedData);

            return {
                type: 'bar',
                data: chartData,
                options: {
                    scales: {
                        xAxes: [{
                            id: 'xAxis1',
                            type: 'category',
                            offset: true,
                            gridLines: {
                                offsetGridLines: true
                            },
                            ticks: {
                                autoSkip: false,
                                maxRotation: 0,
                                minRotation: 0,
                                callback: function(value, index, values) {
                                    // Access the arrays by index to get the correct labels for the current tick
                                    const dateLabel = chartData.labels[index]; // This should be the primary label for the date
                                    const vehicleIds = chartData.vehicleLabels[index] || []; // Default to empty array if undefined
                                    const shifts = chartData.shiftLabels[index] || []; // Default to empty array if undefined

                                    // Construct the label string, including vehicle IDs and shifts
                                    // Join the vehicle IDs with a line break between each
                                    const vehicleLabel = vehicleIds.join('\n');
                                    // Join the shift labels with a tab between each (though there should only be two)
                                    const shiftLabelWithTabs = shifts.join('\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t');

                                    const shiftLabel = shiftLabelWithTabs;

                                    // Return the combined label
                                    return [shiftLabel, dateLabel, vehicleLabel];
                                }
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                let label = data.datasets[tooltipItem.datasetIndex].label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += convertDecimalToTime(tooltipItem.yLabel);
                                return label;
                            }
                        }
                    },
                    animation: {
                        duration: 500,
                        onProgress: function(animation) {
                            var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                            ctx.font = Chart.helpers.fontString('20', 'normal',
                                Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';
                            ctx.fontWeight = 'bold';
                            ctx.fillStyle = '#000';

                            this.data.datasets.forEach(function(dataset, i) {
                                var meta = chartInstance.controller.getDatasetMeta(i);
                                meta.data.forEach(function(bar, index) {
                                    var data = dataset.data[index];
                                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                                });
                            });
                        }
                    }
                    
                    // ... other options
                }
            };
        }

        function createChartData(organizedData) {
            const dateLabels = []; // For x-axis: Dates
            const shiftLabels = []; // Sub-labels for shifts
            const vehicleLabels = []; // Sub-labels for vehicle IDs
            const morningData = [];
            const eveningData = [];

            Object.entries(organizedData).forEach(([date, vehicles], index) => {
                dateLabels.push(date); // Add the date to the primary labels array
                shiftLabels[index] = ['Morning', 'Evening']; // Set shift labels for this index
                vehicleLabels[index] = []; // Initialize an array for vehicle IDs at this index

                Object.entries(vehicles).forEach(([vehicleId, shifts]) => {
                    // Push the total data for morning and evening shifts into their respective arrays
                    morningData.push(parseTimeToDecimal(shifts.morning));
                    eveningData.push(parseTimeToDecimal(shifts.evening));

                    // Push the vehicle ID into the array for vehicle IDs at this index
                    vehicleLabels[index].push(vehicleId);
                });
                
            });
            console.log("morningData:", morningData);
            console.log("eveningData:", eveningData);
            console.log("dateLabels:", dateLabels);
            console.log("shiftLabels:", shiftLabels);
            console.log("vehicleLabels:", vehicleLabels);

            return {
                labels: dateLabels, // Primary labels are the dates
                shiftLabels, // Shift labels for each date
                vehicleLabels, // Vehicle IDs for each date
                datasets: [
                    {
                        label: 'Morning Shift',
                        backgroundColor: "#FF0000",
                        data: morningData,
                    },
                    {
                        label: 'Evening Shift',
                        backgroundColor: "#0000FF",
                        data: eveningData,
                    }
                ]
            };
        }

        function parseTimeToDecimal(timeStr) {
            const [hours, minutes] = timeStr.split(':').map(Number);
            return hours + minutes / 60; // Convert to decimal hours
        }

        function parseTimeToDecimal(timeStr) {
            const [hours, minutes] = timeStr.split(':').map(Number);
            return parseFloat((hours + minutes / 60).toFixed(2)); // Convert to decimal hours and round to two decimal places
        }

        function convertDecimalToTime(decimalTime) {
            const hours = Math.floor(decimalTime);
            const minutes = Math.round((decimalTime - hours) * 60);
            return `${hours}:${minutes.toString().padStart(2, '0')}`; // Pads the minute to ensure two digits
        }

        function reorganizeData(shiftsData) {
            const organizedData = {};
            
            // Organizing data by date, then vehicle, then shift
            for (const [key, shiftHours] of Object.entries(shiftsData)) {
                // Example key format: '3-2023-08-28'
                const parts = key.split('-');
                // const vehicleId = parts[0];
                // Extract the date parts (last three elements)
                const dateParts = parts.slice(-3);
                const date = dateParts.join('-'); // YYYY-MM-DD
                
                // Remove the date parts and join the rest for the vehicle name
                const vehicleId = parts.slice(0, -3).join('-'); // Make-Model-Plate
                
                // Formatting date to 'd-m-y'
                const formattedDate = formatDate(new Date(date));
                console.log("formattedDate:", formattedDate);
                
                if (!organizedData[formattedDate]) {
                    organizedData[formattedDate] = {};
                }
                if (!organizedData[formattedDate][vehicleId]) {
                    organizedData[formattedDate][vehicleId] = { morning: '', evening: '' };
                }
                
                organizedData[formattedDate][vehicleId].morning += shiftHours.morning;
                organizedData[formattedDate][vehicleId].evening += shiftHours.evening;
            }
            
            return organizedData;
        }

        function formatDate(date) {
            const day = date.getDate();
            const month = date.getMonth() + 1; // Months start at 0!
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }



        // Initialize everything when the document is ready
        document.addEventListener('DOMContentLoaded', function() {
            toggleIcons();
            handleYearChange();

            $.ajax({
                url: "<?php echo e(route('production')); ?>",
                method: 'GET',
                success: function(response) {
                    // Parse the JSON data received from the server
                    console.log(response);
                    const data = response;

                    // // Initialize Daily Production Chart
                    // initBarChart('dailyProduction', getDailyProductionConfig(data.daily));

                    // // Initialize Weekly Production Chart
                    // initLineChart('weeklyProduction', getWeeklyProductionConfig(data.weekly));

                    // // Initialize Yearly Production Chart
                    // initLineChart('yearlyProduction', getYearlyProductionConfig(data.yearly));

                    // Initialize Shift Production Chart
                    var shiftChartCanvas = document.getElementById('shiftProduction').getContext('2d');
                    var shiftProductionChart = new Chart(shiftChartCanvas, getShiftProductionConfig(data
                        .shifts));

                },
                error: function(error) {
                    console.log("Error fetching data:", error);
                }
            });


            // Fetch Vehicle Work Hours Data
            $.ajax({
                url: "<?php echo e(route('work_hours')); ?>",
                method: 'GET',
                success: function(response) {
                    console.log("Vehicle Work Hours Data:", response);
                    const vehicleData = response;
                    console.log("Vehicle Data:", vehicleData);

                    var workHrsChartCanvas = document.getElementById('workHours').getContext('2d');
                    var workHrsChart = new Chart(workHrsChartCanvas, getWorkHrsChartConfig(vehicleData
                        .shifts));
                },
                error: function(error) {
                    console.log("Error fetching vehicle work hours data:", error);
                }
            });
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/home.blade.php ENDPATH**/ ?>
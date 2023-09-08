
<?php $__env->startSection('extra_css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>">
    <style>
        .card-padding {
            padding: 5.25rem 0;
        }

        .no-shadow {
            box-shadow: none !important
        }

        li.selected {
            background-color: #ccc;
            /* Change as desired */
        }

        li:hover {
            cursor: pointer;
        }

        .invalid {
            border: 1px solid red !important;
        }

        .check-size {
            width: 20px;
            height: 20px;
        }

        /* Custom modal size */
        .modal-xxl {
            max-width: 1200px;
        }

        /* Responsive modal size */
        @media (max-width: 1200px) {
            .modal-xxl {
                max-width: 90%;
            }
        }

        @media (max-width: 992px) {
            .modal-xxl {
                max-width: 80%;
            }
        }

        @media (max-width: 768px) {
            .modal-xxl {
                max-width: 100%;
            }
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('reports.template')); ?>">Report</a></li>
    <li class="breadcrumb-item active">Generate Report</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        Generate Report
                    </h3>
                </div>

                <div class="card-body">
                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    
                    
                    
                    <div class="form-group">
                        <?php echo Form::label(
                            'date_bracket',
                            __('From/To (Date)') . ' <span class="text-danger">*</span>',
                            ['class' => 'form-label'],
                            false,
                        ); ?>

                        <div id="reportrange" class="form-control">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span>
                            <input type="hidden" name="daterange" id="daterange">
                        </div>
                    </div>
                    <?php echo $__env->make('reports.includes.report_lists', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <br />
                    <button class="btn btn-success mt-3" id="viewButton">View Report</button>

                    <br />
                    <hr />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label(
                                    'report_format',
                                    __('Report Format') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="report_format" name="report_format" class="form-control">
                                    <option value="pdf">PDF</option>
                                    <option value="csv">CSV</option>
                                    <option value="XSL">XSL</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <?php echo Form::label(
                                    'name',
                                    __('Report Name') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <?php echo Form::text('name', null, ['class' => 'form-control', 'id' => 'name']); ?>

                            </div>

                            <div class="form-group">
                                <?php echo Form::label(
                                    'frequency',
                                    __('Select Frequency') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="frequency" name="frequency" class="form-control">
                                    <option value="" disabled>Select Shift</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php echo Form::label(
                                    'delivery_end_date',
                                    __('Delivery End Date') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <?php echo Form::date('date', null, ['class' => 'form-control']); ?>

                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label(
                                    'recipient',
                                    __('Email Report Recipients') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="recipient" name="recipients[]" multiple="multiple" class="form-control">
                                    <option value="">-</option>
                                    <?php $__currentLoopData = $recipients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($recipient->id); ?>"><?php echo e($recipient->email); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php echo Form::label(
                                    'subject',
                                    __('Email Subject Line') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <?php echo Form::text('subject', null, ['class' => 'form-control']); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('email_body', __('Email Content'), ['class' => 'form-label']); ?>

                                <?php echo Form::textarea('email_body', null, ['class' => 'form-control', 'rows' => '4']); ?>

                            </div>
                        </div>

                    </div>
                    <br />

                    <div class="row">
                        <div class="col-md-12">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report View Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xxl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="download">Download</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#recipient').select2({
                placeholder: "Select Recipients"
            });
            $('#siteList').select2({
                placeholder: "Select Site"
            });
            $('#report_format').select2({
                placeholder: "Select Report Format"
            });
            $('#frequency').select2({
                placeholder: "Select Frequency"
            });

            $('#created_on').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                if (start && end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    $test = $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
                }
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                autoUpdateInput: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                    'All Time': [moment().subtract(5, 'years'), moment()]
                }
            }, cb);

            cb(start, end);

            var urlSites = "<?php echo e(route('reports.get_sites')); ?>";
            $.get(urlSites, function(site) {
                console.log(site);
                // select the list
                var siteList = $('#siteList');

                // clear the list
                siteList.empty();

                // iterate through the data and append a list item for each object
                $.each(site, function(index, site) {
                    siteList.append('<option value="' + site.id + '">' +
                        site.site_name + '</option>');
                });
            });

            var urlFleet = "<?php echo e(route('reports.get_fleet')); ?>";
            $.get(urlFleet, function(fleetNo) {
                // console.log(fleetNo);
                // select the list
                var fleetNoList = $('#fleetnolist');

                // clear the list
                fleetNoList.empty();

                // iterate through the data and append a list item for each object
                $.each(fleetNo, function(index, vehicle) {
                    fleetNoList.append('<li class="list-group-item" id="' + vehicle.id + '">' +
                        vehicle.fleet_no + '</li>');
                });
            });

            var urlParts = "<?php echo e(route('reports.get_parts')); ?>";
            $.get(urlParts, function(parts) {
                // console.log(parts);
                // select the list
                var partsList = $('#partslist');

                // clear the list
                partsList.empty();

                // iterate through the data and append a list item for each object
                $.each(parts, function(index, vendor) {
                    partsList.append('<li class="list-group-item" id="' + vendor.id + '">' +
                        vendor.name + '</li>');
                });
            });

            var urlFuel = "<?php echo e(route('reports.get_fuel')); ?>";
            $.get(urlFuel, function(fuel) {
                // console.log(fuel);
                // select the list
                var fuelList = $('#fuellist');

                // clear the list
                fuelList.empty();

                // iterate through the data and append a list item for each object
                $.each(fuel, function(index, vendor) {
                    fuelList.append('<li class="list-group-item" id="' + vendor.id + '">' +
                        vendor.name + '</li>');
                });
            });

            $('#deploymentToggle').change(function() {
                if ($(this).is(":checked")) {
                    $('#deploymentMenu').slideDown();
                } else {
                    $('#deploymentMenu').slideUp();

                    // Clear the multiple select for sites
                    $('#siteList').val(null).trigger('change');

                    // Uncheck the checkboxes for shifts
                    $('#morningShift').prop('checked', false);
                    $('#eveningShift').prop('checked', false);
                }
            });

            $('#maintenanceToggle').change(function() {
                if ($(this).is(":checked")) {
                    $('#maintenanceMenu').slideDown();
                } else {
                    $('#maintenanceMenu').slideUp();
                    $('#correctiveMaintenance').prop('checked', false);
                    $('#preventiveMaintenance').prop('checked', false);
                }
            });


            function setupAccordionToggle(buttonId) {
                $(buttonId).on('click', function() {
                    var icon = $(this).find('i');
                    var isExpanded = $(this).attr('aria-expanded') == 'false';
                    if (isExpanded) {
                        icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                        // Remove 'disabled' class from all buttons
                        $('#moveAllLeftButton, #moveLeftButton, #moveRightButton, #moveAllRightButton')
                            .removeClass('disabled');
                    } else {
                        icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                        // Add 'disabled' class to all buttons
                        $('#moveAllLeftButton, #moveLeftButton, #moveRightButton, #moveAllRightButton')
                            .addClass('disabled');
                    }
                });
            }

            // Use the function for each button
            setupAccordionToggle('#fleetno');
            setupAccordionToggle('#partsCost');
            setupAccordionToggle('#fuelCost');

            // dynamic function for search
            function setupSearch(inputId, listId) {
                $(inputId).on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $(listId + " li").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });
                });
            }

            setupSearch("#searchInput", "#fleetnolist");
            setupSearch("#searchfuel", "#fuellist");
            setupSearch("#searchparts", "#fuellist");
            setupSearch("#searchRightList", "#rightContainerList");

            var selectedItemsArrayFleet = [];
            var selectedItemsArrayFuel = [];
            var selectedItemsArrayParts = [];

            $("#fuellist, #partslist, #fleetnolist").on('click', 'li', function() {
                $(this).toggleClass("selected");
            });


            $("#rightContainerList").on('click', 'li', function() {
                $(this).toggleClass("selected");
            });

            // On 'move right' button click, capture ids of moved items
            $("#moveRightButton").click(function() {
                if ($(this).hasClass('disabled')) {
                    return;
                }

                // Determine which list to use based on the visible collapse content
                var selectedList;
                var itemCount;
                var selectedItemsArray;
                var origin;

                if ($('#fleetCollapse').hasClass('show')) {
                    selectedList = $("#fleetnolist");
                    itemCount = '#asset_count';
                    selectedItemsArray = selectedItemsArrayFleet;
                    origin = 'fleet';
                } else if ($('#partsCollapse').hasClass('show')) {
                    selectedList = $("#partslist");
                    itemCount = '#asset_count_parts';
                    selectedItemsArray = selectedItemsArrayParts;
                    origin = 'parts';
                } else if ($('#fuelCollapse').hasClass('show')) {
                    selectedList = $("#fuellist");
                    itemCount = '#asset_count_fuel';
                    selectedItemsArray = selectedItemsArrayFuel;
                    origin = 'fuel';
                } else {
                    // No list is visible, so return
                    return;
                }

                // Select all 'selected' items in the visible list
                var selectedItems = selectedList.find(".selected");

                // Get ids of selected items and add them to the array
                selectedItems.each(function() {
                    var itemId = $(this).attr('id');
                    if (!selectedItemsArray.includes(itemId)) {
                        selectedItemsArray.push(itemId);
                    }

                    // Add data-origin attribute indicating the origin list
                    $(this).attr('data-origin', origin);
                });

                console.log('selectedItemsArray: ', selectedItemsArray);

                // Move selected items to the right container
                selectedItems.appendTo("#rightContainerList").removeClass('selected');

                // Update count of selected assets
                $(itemCount).text('Selected Assets: ' + selectedItemsArray.length);
            });

            // On 'move left' button click, remove ids of moved items from the array
            $("#moveLeftButton").click(function() {
                if ($(this).hasClass('disabled')) {
                    return;
                }
                // select all 'selected' items in the right container
                var selectedItems = $("#rightContainerList .selected");

                // get ids of selected items and remove them from the array
                selectedItems.each(function() {
                    var itemId = $(this).attr('id');
                    var origin = $(this).data(
                        'origin'); // get the origin from the data-origin attribute

                    if (origin === 'fleet') {
                        selectedItemsArrayFleet = selectedItemsArrayFleet.filter(item => item !==
                            itemId);
                        // move selected items back to the fleet list
                        $(this).appendTo("#fleetnolist").removeClass('selected');
                        // update count of selected assets
                        $('#asset_count').text('Selected Assets: ' + selectedItemsArrayFleet
                            .length);
                    } else if (origin === 'parts') {
                        selectedItemsArrayParts = selectedItemsArrayParts.filter(item => item !==
                            itemId);
                        // move selected items back to the parts list
                        $(this).appendTo("#partslist").removeClass('selected');
                        // update count of selected assets
                        $('#asset_count_parts').text('Selected Assets: ' + selectedItemsArrayParts
                            .length);
                    } else if (origin === 'fuel') {
                        selectedItemsArrayFuel = selectedItemsArrayFuel.filter(item => item !==
                            itemId);
                        // move selected items back to the fuel list
                        $(this).appendTo("#fuellist").removeClass('selected');
                        // update count of selected assets
                        $('#asset_count_fuel').text('Selected Assets: ' + selectedItemsArrayFuel
                            .length);
                    }
                });
            });


            $("#moveAllRightButton").click(function() {
                if ($(this).hasClass('disabled')) {
                    return;
                }

                // Determine which menu is open
                let openMenuId;
                let selectedItemsArray;
                if ($('#fleetCollapse').hasClass('show')) {
                    openMenuId = '#fleetnolist';
                    selectedItemsArray = selectedItemsArrayFleet;
                } else if ($('#partsCollapse').hasClass('show')) {
                    openMenuId = '#partslist';
                    selectedItemsArray = selectedItemsArrayParts;
                } else if ($('#fuelCollapse').hasClass('show')) {
                    openMenuId = '#fuellist';
                    selectedItemsArray = selectedItemsArrayFuel;
                } else {
                    return;
                }

                // get all items in the open menu
                var allItems = $(openMenuId + " li");

                // add all item ids to the respective array
                allItems.each(function() {
                    var itemId = $(this).attr('id');
                    selectedItemsArray.push(itemId);
                });

                // add data-origin attribute to all items
                allItems.attr('data-origin', openMenuId);

                // move all items to the right container
                allItems.appendTo("#rightContainerList").removeClass('selected');

                // Since there's no explicit array for selected items, 
                // we're just updating the count of total moved items.
                $('#asset_count').text('Moved Assets: ' + $("#rightContainerList li").length);
            });

            $("#moveAllLeftButton").click(function() {
                if ($(this).hasClass('disabled')) {
                    return;
                }

                // Determine which menu the items originally came from
                var allItems = $("#rightContainerList li");
                allItems.each(function() {
                    var itemId = $(this).attr('id');
                    var originMenuId = $(this).attr('data-origin');

                    if (originMenuId == '#fleetnolist') {
                        selectedItemsArrayFleet = selectedItemsArrayFleet.filter(item => item !==
                            itemId);
                    } else if (originMenuId == '#partslist') {
                        selectedItemsArrayParts = selectedItemsArrayParts.filter(item => item !==
                            itemId);
                    } else if (originMenuId == '#fuellist') {
                        selectedItemsArrayFuel = selectedItemsArrayFuel.filter(item => item !==
                            itemId);
                    }

                    // move all items back to the left container
                    $(this).appendTo(originMenuId).removeClass('selected');
                });

                // update count of selected assets
                $('#asset_count').text('Moved Assets: ' + $("#rightContainerList li").length);
            });

            // $('#viewButton').click(function(e) {
            //     e.preventDefault();

            //     console.log('here');
            //     var data = [{
            //             fleet_details: "Fleet 1",
            //             date: "2023-07-03",
            //             site_shift: [{
            //                     site: "Site 1",
            //                     shift: "Morning"
            //                 },
            //                 {
            //                     site: "Site 1",
            //                     shift: "Evening"
            //                 }
            //             ],
            //             rental_data: "$100.00"
            //         },
            //         {
            //             fleet_details: "Fleet 2",
            //             date: "2023-07-03",
            //             site_shift: [{
            //                     site: "Site 2",
            //                     shift: "Morning"
            //                 },
            //                 {
            //                     site: "Site 2",
            //                     shift: "Evening"
            //                 }
            //             ],
            //             rental_data: "$120.00"
            //         },
            //         {
            //             fleet_details: "Fleet 3",
            //             date: "2023-07-04",
            //             site_shift: [{
            //                 site: "Site 3",
            //                 shift: "Morning"
            //             }],
            //             rental_data: "$130.00"
            //         }
            //     ];

            //     // Create table
            //     var table = $('<table></table>').addClass('table table-bordered');
            //     var tbody = $('<tbody></tbody>');
            //     var prevDate = "";

            //     $.each(data, function(i, item) {
            //         $.each(item.site_shift, function(j, shiftData) {
            //             var row = $('<tr></tr>');

            //             // Fleet details column
            //             if (j === 0) {
            //                 row.append($('<td rowspan="' + item.site_shift.length +
            //                     '"></td>').text(item.fleet_details));
            //             }

            //             // Date column
            //             if (item.date !== prevDate) {
            //                 prevDate = item.date;
            //                 row.append($('<td rowspan="' + item.site_shift.length +
            //                     '"></td>').text(item.date));
            //             }

            //             // Site and shift column
            //             row.append($('<td></td>').text(shiftData.site + ' ' + shiftData
            //                 .shift));

            //             // Rental data column
            //             if (j === 0) {
            //                 row.append($('<td rowspan="' + item.site_shift.length +
            //                     '"></td>').text(item.rental_data));
            //             }

            //             tbody.append(row);
            //         });
            //     });

            //     table.append(tbody);

            //     // Insert the table into the modal body
            //     $('#reportModal .modal-body').empty().append(table);

            //     // Show the modal
            //     $('#reportModal').modal('show');
            // });

            function appendCell(row, value, rowspan = 1, isHtml = false) {
                var cell = $('<td></td>');
                if (isHtml) {
                    cell.html(value); // Use .html() method to set HTML content
                } else {
                    cell.text(value); // Use .text() method to set plain text
                }
                if (rowspan > 1) {
                    cell.attr('rowspan', rowspan);
                }
                row.append(cell);
            }

            // Function to generate headers config
            function generateHeadersConfig(fleetCheck, correctiveMaintenance, shiftDetailsCheck) {
                var config = [
                    fleetCheck ? {
                        title: 'Fleet ID',
                        colspan: 1
                    } : null,
                    {
                        title: 'Date',
                        colspan: 1
                    }
                ];

                if (correctiveMaintenance && fleetCheck) {
                    config.push({
                        title: 'Corrective Maintenance',
                        colspan: 4
                    });
                } else {
                    config.push({
                        title: 'Deployment',
                        colspan: 4
                    });
                }

                if (shiftDetailsCheck) {
                    config.push({
                        title: 'Shift Details',
                        colspan: 6
                    });
                }

                // Add more headers as needed
                // ...

                return config.filter(header => header); // Filter out null values
            }



            $('#viewButton').click(function(e) {
                e.preventDefault();
                $('#reportModal .modal-body').empty();
                // Check all required inputs and select elements
                let isValid = true;
                $(':input[required]').each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('invalid');
                        $(this).focus();
                        isValid = false;
                    } else {
                        $(this).removeClass('invalid');
                    }
                });

                if (!isValid) {
                    alert('Please fill all required fields');
                } else {
                    var url = "<?php echo e(route('reports.fleet_data')); ?>";
                    var selectedSites = $("#siteList").val();
                    var selectedShifts = [];
                    if ($("#morningShift").is(':checked')) selectedShifts.push(1);
                    if ($("#eveningShift").is(':checked')) selectedShifts.push(2);
                    $.ajax({
                        type: "POST",
                        url: url, // Modify with your URL
                        data: {
                            fleet_ids: JSON.stringify(selectedItemsArrayFleet),
                            parts_ids: JSON.stringify(selectedItemsArrayParts),
                            fuel_ids: JSON.stringify(selectedItemsArrayFuel),
                            date_range: $('#daterange').val(),
                            rental_checked: $('#rental').is(':checked'),
                            shift_checked: $('#shiftDetails').is(':checked'),
                            deployment_checked: $('#deploymentToggle').is(':checked'),
                            sites: JSON.stringify(selectedSites),
                            shifts: JSON.stringify(selectedShifts),
                            corrective_maintenance: $('#correctiveMaintenance').is(':checked'),
                            preventive_maintenance: $('#preventiveMaintenance').is(':checked'),
                        },
                        success: function(response) {
                            console.log('response: ', response);

                            var fleetCheck = response['fleet_ids'] && response['fleet_ids']
                                .length !== 0;

                            var correctiveMaintenance = response.check_corrective_maintenance ==
                                "true";
                            console.log('correctiveMaintenance: ', correctiveMaintenance);

                            var shiftDetailsCheck = response.shift_checked == "true";

                            var headersConfig = generateHeadersConfig(fleetCheck,
                                correctiveMaintenance, shiftDetailsCheck);

                            function groupShiftDetails(shiftDetails) {
                                var groupedDetails = {};

                                if (response.shift_checked == 'true') {

                                    shiftDetails.forEach(function(shift) {
                                        var vehicleId = shift.vehicle_id;
                                        var date = shift.date;
                                        var siteId = shift.site_id;

                                        if (!groupedDetails[vehicleId]) {
                                            groupedDetails[vehicleId] = {};
                                        }
                                        if (!groupedDetails[vehicleId][date]) {
                                            groupedDetails[vehicleId][date] = {};
                                        }
                                        if (!groupedDetails[vehicleId][date][siteId]) {
                                            groupedDetails[vehicleId][date][
                                                siteId
                                            ] = [];
                                        }

                                        groupedDetails[vehicleId][date][siteId].push(
                                            shift);
                                    });

                                    return groupedDetails;
                                }
                            }

                            var table = $('<table></table>').addClass('table table-bordered');

                            // Add table headers
                            var thead = $('<thead></thead>');

                            var headerRow1 = $('<tr></tr>');
                            var headerRow2 = $('<tr></tr>');

                            headersConfig.forEach(function(header) {
                                headerRow1.append($('<th></th>').attr('colspan', header
                                    .colspan).text(header.title));

                                if (header.title === 'Fleet ID' || header.title ===
                                    'Date') {
                                    headerRow2.append(
                                        '<th></th>'); // Empty cell for Fleet ID or Date
                                } else if (header.title === 'Deployment') {
                                    headerRow2.append('<th>Site</th>');
                                    headerRow2.append('<th>Shift</th>');
                                    if (fleetCheck) {
                                        headerRow2.append('<th>Driver/Operator</th>');
                                        headerRow2.append('<th>Meter</th>');
                                        headerRow2.append('<th>Work Hrs</th>');
                                    }
                                    if (response.rental_checked == 'true' &&
                                        fleetCheck) {
                                        headerRow2.append('<th>Rental</th>');
                                    }
                                } else if (header.title === 'Shift Details') {
                                    headerRow2.append(
                                        '<th>Shift Quantity (grams)</th>');
                                    headerRow2.append(
                                        '<th>Shift Quantity (pounds)</th>');
                                    headerRow2.append('<th>Net Weight (grams)</th>');
                                    headerRow2.append('<th>Net Weight (pounds)</th>');
                                    headerRow2.append('<th>Wastage (grams)</th>');
                                    headerRow2.append(
                                        '<th>Yield Quality (carats)</th>');
                                } else if (header.title === 'Corrective Maintenance') {
                                    headerRow2.append('<th>Subject</th>');
                                    headerRow2.append('<th>Description</th>');
                                }
                            });

                            thead.append(headerRow1);
                            thead.append(headerRow2);
                            table.append(thead);


                            var tbody = $('<tbody></tbody>');

                            var data = response['rental'];
                            var totalRentalCost = 0;

                            // Skip if data does not exist or is an empty object
                            if (fleetCheck && !correctiveMaintenance) {
                                headersConfig.push({
                                    title: 'Fleet ID',
                                    colspan: 1,
                                    field: 'vehicle.fleet_no'
                                });
                                $.each(data, function(vehicleId, dates) {
                                    var fleetCell = null;

                                    $.each(dates, function(date, items) {
                                        var dateCell = null;

                                        // Grouping items by site
                                        var siteGroup = items.reduce(function(
                                            acc, item) {
                                            (acc[item.site_id] = acc[
                                                item.site_id] || [])
                                            .push(item);
                                            return acc;
                                        }, {});

                                        $.each(siteGroup, function(siteId,
                                            siteItems) {
                                            var siteCell = null;
                                            var siteRows = 0;

                                            $.each(siteItems, function(
                                                i, item) {
                                                var row = $(
                                                    '<tr></tr>'
                                                );

                                                // If Fleet ID is present, append it
                                                if (
                                                    fleetCheck
                                                ) {
                                                    appendCell(
                                                        row,
                                                        item
                                                        .vehicle
                                                        .fleet_no
                                                    );
                                                }

                                                // Append date cell
                                                appendCell(row,
                                                    date);



                                                // Corrective Maintenance, Deployment (Site and Shift), Rental Cost, and Shift Details handling goes here
                                                // Corrective Maintenance (if applicable)

                                                // Deployment (Site and Shift)
                                                var siteName =
                                                    item.sites
                                                    .site_name; // Assuming this field exists
                                                var shift = item
                                                    .shift_id ===
                                                    1 ?
                                                    'Morning' :
                                                    'Evening'; // Shift handling
                                                var driver =
                                                    item
                                                    .assigned_driver
                                                    .name;
                                                var workHours =
                                                    item
                                                    .work_hours;
                                                var meter =
                                                    'Start: ' +
                                                    item
                                                    .start_meter +
                                                    '\nEnd: ' +
                                                    item
                                                    .end_meter;
                                                appendCell(row,
                                                    siteName
                                                );
                                                appendCell(row,
                                                    shift);
                                                appendCell(row,
                                                    driver);
                                                appendCell(row,
                                                    meter,
                                                    1, true
                                                );
                                                appendCell(row,
                                                    workHours
                                                );


                                                if (response
                                                    .rental_checked ==
                                                    'true') {
                                                    // Rental Cost
                                                    var rentalCost =
                                                        parseFloat(
                                                            item
                                                            .price
                                                        );
                                                    appendCell(
                                                        row,
                                                        '$' +
                                                        rentalCost
                                                    );

                                                    totalRentalCost
                                                        +=
                                                        rentalCost;
                                                }

                                                // Call the function and assign the result to the variable
                                                var groupedShiftDetails =
                                                    groupShiftDetails(
                                                        response
                                                        .shift_details
                                                    );
                                                // Shift Details (if applicable)
                                                if (response
                                                    .shift_checked ==
                                                    'true' &&
                                                    groupedShiftDetails[
                                                        vehicleId
                                                    ] &&
                                                    groupedShiftDetails[
                                                        vehicleId
                                                    ][
                                                        date
                                                    ] &&
                                                    groupedShiftDetails[
                                                        vehicleId
                                                    ][date][
                                                        siteId
                                                    ]) {
                                                    var detailsForThisCombination =
                                                        groupedShiftDetails[
                                                            vehicleId
                                                        ][
                                                            date
                                                        ][
                                                            siteId
                                                        ];
                                                    detailsForThisCombination
                                                        .forEach(
                                                            function(
                                                                shiftDetail
                                                            ) {
                                                                appendCell
                                                                    (row,
                                                                        shiftDetail
                                                                        .shift_quantity_grams
                                                                    );
                                                                appendCell
                                                                    (row,
                                                                        shiftDetail
                                                                        .shift_quantity_pounds
                                                                    );
                                                                appendCell
                                                                    (row,
                                                                        shiftDetail
                                                                        .net_weight_grams
                                                                    );
                                                                appendCell
                                                                    (row,
                                                                        shiftDetail
                                                                        .net_weight_pounds
                                                                    );
                                                                appendCell
                                                                    (row,
                                                                        shiftDetail
                                                                        .wastage
                                                                    );
                                                                appendCell
                                                                    (row,
                                                                        shiftDetail
                                                                        .yield_quality
                                                                    );
                                                            });
                                                }


                                                tbody.append(
                                                    row);
                                                siteRows++;
                                            });

                                            // Update rowspan for the site cell
                                            if (siteCell) siteCell.attr(
                                                'rowspan', siteRows);
                                        });
                                    });

                                    // Update rowspan for the fleet details cell
                                    if (fleetCell) fleetCell.attr('rowspan',
                                        rowsCreated);
                                });
                            }
                            if (response.shift_checked == 'true' && !fleetCheck) {
                                response.shift_details.forEach(function(shiftDetail) {
                                    // Create a new row
                                    var row = $('<tr></tr>');

                                    // Append date
                                    appendCell(row, shiftDetail.date);

                                    // Append site (assuming you have site name information)
                                    var
                                        siteName = shiftDetail.site.site_name;
                                    appendCell(row, siteName);

                                    // Append shift
                                    var shift = shiftDetail.shift_id === 1 ? 'Morning' :
                                        'Evening';
                                    appendCell(row, shift);


                                    // Append other details
                                    appendCell(row, shiftDetail.shift_quantity_grams);
                                    appendCell(row, shiftDetail.shift_quantity_pounds);
                                    appendCell(row, shiftDetail.net_weight_grams);
                                    appendCell(row, shiftDetail.net_weight_pounds);
                                    appendCell(row, shiftDetail.wastage);
                                    appendCell(row, shiftDetail.yield_quality);

                                    // Append the row to the tbody
                                    tbody.append(row);
                                });
                            }

                            if (response.rental_checked == 'true' && fleetCheck) {
                                var totalRow = $('<tr></tr>');
                                totalRow.append(
                                    '<td colspan="7">Total Rental Cost</td>'); // Adjust colspan
                                totalRow.append($('<td></td>').text('$' + totalRentalCost
                                    .toFixed(2))); // Format total
                                tbody.append(totalRow); // Append total row to the table (3)
                            }

                            if (fleetCheck && correctiveMaintenance) {

                                // Dynamically access the corrective_maintenance data
                                var corrective_maintenance_data = response
                                    .corrective_maintenance;

                                // Iterate through the keys (e.g., '2', '2023-08-17') to access the arrays
                                for (var key in corrective_maintenance_data) {
                                    var date_key_data = corrective_maintenance_data[key];

                                    // Iterate through the keys again for the given date (e.g., '2023-08-17')
                                    for (var date_key in date_key_data) {
                                        var date_data = date_key_data[date_key];

                                        // Now date_data is an array; you can iterate through it
                                        date_data.forEach(function(item) {
                                            // Create a new row
                                            var row = $('<tr></tr>');

                                            // Append cells to the row using the appendCell function
                                            appendCell(row, item.vehicle.fleet_no);
                                            appendCell(row, item.date);
                                            appendCell(row, item.subject);
                                            appendCell(row, item.description);
                                            // Add more cells as needed

                                            // Append the row to the table body
                                            tbody.append(row);
                                        });
                                    }
                                }
                            }

                            table.append(tbody);

                            // Insert the table into the modal body
                            $('#reportModal .modal-body').empty().append(table);

                            // Show the modal
                            $('#reportModal').modal('show');
                        },

                        error: function(jqXHR, textStatus, errorThrown) {
                            // You can handle errors here
                            console.log(textStatus, errorThrown);
                        }
                    });

                }
            });

            $('#download').click(function() {
                console.log('clicked');
                // Extract the report data from the table inside the modal
                var reportData = [];
                var headers = [];
                var subheaders = [];

                // Extract headers
                $('#reportModal .modal-body table thead tr').eq(0).find('th').each(function(index, cell) {
                    headers.push($(cell).text());
                });

                // Extract subheaders
                $('#reportModal .modal-body table thead tr').eq(1).find('th').each(function(index, cell) {
                    subheaders.push($(cell).text());
                });

                // Add headers and subheaders to report data
                reportData.push(headers);
                reportData.push(subheaders);

                // Extract rows
                $('#reportModal .modal-body table tbody tr').each(function(rowIndex, row) {
                    var rowData = [];
                    $(this).find('td').each(function(index, cell) {
                        rowData.push($(cell).text());
                    });
                    reportData.push(rowData);
                });


                // Send the data to the server via AJAX
                $.ajax({
                    url: "<?php echo e(route('reports.download')); ?>",
                    method: 'POST',
                    data: {
                        report: reportData,
                        _token: "<?php echo e(csrf_token()); ?>" // Include CSRF token for security
                    },
                    xhrFields: {
                        responseType: 'blob' // to handle binary data
                    },
                    success: function(blob) {
                        // Create a blob URL and link
                        var url = window.URL.createObjectURL(blob);
                        var a = document.createElement('a');
                        a.href = url;
                        a.download = 'report_' + (new Date()).toISOString().split('T')[0] +
                            '.xlsx'; // specify the file name
                        a.click(); // trigger the download
                        window.URL.revokeObjectURL(url); // clean up
                    },
                    error: function(error) {
                        // Handle error
                        console.error(error);
                    }
                });
            });

        });
    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/reports/template.blade.php ENDPATH**/ ?>
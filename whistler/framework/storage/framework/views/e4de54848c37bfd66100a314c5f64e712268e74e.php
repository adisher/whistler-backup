
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

                    <?php echo Form::open(['route' => 'reports.generate', 'method' => 'post']); ?>

                    <?php echo Form::hidden('user_id', Auth::user()->id); ?>

                    <?php echo Form::hidden('type', 'Created'); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label(
                                    'report_format',
                                    __('Report Format') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="report_format" name="report_format" class="form-control" required>
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

                                <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'id' => 'name']); ?>

                            </div>

                            <div class="form-group">
                                <?php echo Form::label(
                                    'frequency',
                                    __('Select Frequency') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="frequency" name="frequency" class="form-control" required>
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

                                <?php echo Form::date('date', null, ['class' => 'form-control', 'required']); ?>

                            </div>
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

                        </div>
                        <input type="hidden" name="expense_amount" id="expense_amount" value="0">
                        <div class="col-md-6">
                            <div class="form-group" id="work_hours_div">
                                <?php echo Form::label(
                                    'recipient',
                                    __('Email Report Recipients') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="recipient" name="recipients[]" multiple="multiple" class="form-control"
                                    required>
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

                                <?php echo Form::text('subject', null, ['class' => 'form-control', 'required']); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('email_body', __('Email Content'), ['class' => 'form-label']); ?>

                                <?php echo Form::textarea('email_body', null, ['class' => 'form-control', 'rows' => '4']); ?>

                            </div>
                        </div>

                    </div>
                    <br />
                    <?php echo $__env->make('reports.includes.report_lists', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Form::submit(__('View'), ['class' => 'btn btn-success', 'id' => 'viewButton']); ?>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report View Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Schedule</button>
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
                }
            });

            $('#maintenanceToggle').change(function() {
                if ($(this).is(":checked")) {
                    $('#maintenanceMenu').slideDown();
                } else {
                    $('#maintenanceMenu').slideUp();
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
                            sites: JSON.stringify(selectedSites),
                            shifts: JSON.stringify(selectedShifts),
                        },
                        success: function(response) {
                            console.log('response: ', response);

                            // Create table for each data type
                            ['rental', 'parts', 'fuel', 'deployment'].forEach(function(type) {
                                var data = response[type];
                                // Skip if data does not exist or is an empty array
                                if (!data || data.length === 0) return;

                                // Add table
                                var table = $('<table></table>').addClass('table');

                                // Add table title
                                var title = $('<h3 class="text-center"></h3>').text(type
                                    .toUpperCase());
                                $('#reportModal .modal-body').append(title);

                                // Add table header
                                var thead = $('<thead></thead>');
                                var headerRow = $('<tr></tr>');

                                switch (type) {
                                    case 'rental':
                                        headerRow.append('<th>Image</th>');
                                        headerRow.append('<th>Fleet No</th>');
                                        headerRow.append('<th>Fleet Details</th>');
                                        headerRow.append('<th>Site</th>');
                                        headerRow.append('<th>Shift</th>');
                                        headerRow.append('<th>Rental Cost</th>');
                                        headerRow.append('<th>Date</th>');
                                        break;
                                    case 'parts':
                                        headerRow.append('<th>Vendor</th>');
                                        headerRow.append('<th>Cost</th>');
                                        headerRow.append('<th>Date</th>');
                                        break;
                                    case 'fuel':
                                        headerRow.append('<th>Vendor</th>');
                                        headerRow.append('<th>Cost</th>');
                                        headerRow.append('<th>Date</th>');
                                        break;
                                    case 'deployment':
                                        headerRow.append('<th>Fleet Details</th>');
                                        headerRow.append('<th>Site</th>');
                                        headerRow.append('<th>Shift</th>');
                                        headerRow.append('<th>Date</th>');
                                        break;
                                }
                                thead.append(headerRow);
                                table.append(thead);

                                // Add table body
                                var tbody = $('<tbody></tbody>');
                                $.each(data, function(i, item) {
                                    var row = $('<tr></tr>');
                                    var totalPrice = 0;

                                    var date = new Date(item.created_at);
                                    var formattedDate = date.toLocaleDateString(
                                        'en-GB', {
                                            day: '2-digit',
                                            month: '2-digit',
                                            year: 'numeric'
                                        });

                                    switch (type) {
                                        case 'rental':
                                            // Add image to row
                                            // item.work_orders.forEach(function(
                                            //     work_order) {
                                            //     totalPrice +=
                                            //         parseFloat(
                                            //             work_order.price
                                            //         );
                                            // });
                                            var imagePath;
                                            var baseURL =
                                                'https://apis.ideationtec.com/whistler';
                                            if (item.vehicle.vehicle_image !== null) {
                                                imagePath = baseURL +
                                                    '/uploads/' + item
                                                    .vehicle.vehicle_image;
                                            } else {
                                                imagePath =
                                                    '/assets/images/vehicle.jpeg';
                                            }
                                            var img = $('<img>').attr({
                                                src: imagePath,
                                                height: 70,
                                                width: 70
                                            });
                                            row.append($('<td>').append(img));
                                            row.append('<td>' + item.vehicle.fleet_no +
                                                '</td>');
                                            row.append('<td>' + item
                                                .vehicle.vehicle_data.make +
                                                ' ' +
                                                item.vehicle.vehicle_data
                                                .model +
                                                '<br><strong>License Plate:</strong> ' +
                                                item.vehicle.license_plate +
                                                '</td>'
                                            );

                                            row.append('<td>' + item.sites
                                                .site_name + '</td>');
                                            row.append('<td>' + (item
                                                    .shift_id == 1 ?
                                                    'Morning' : 'Evening') +
                                                '</td>');

                                            row.append('<td>$' + item.price
                                                .toLocaleString(
                                                    'en-US', {
                                                        minimumFractionDigits: 2
                                                    }) +
                                                '</td>');

                                            row.append('<td>' + formattedDate +
                                                '</td>');

                                            break;
                                        case 'parts':
                                            row.append('<td>' + item.vendor
                                                .name +
                                                '</td>');
                                            row.append('<td>$' + (item
                                                    .unit_cost * item.stock)
                                                .toLocaleString(
                                                    'en-US', {
                                                        minimumFractionDigits: 2
                                                    }) +
                                                '</td>');
                                            row.append('<td>' + formattedDate +
                                                '</td>');
                                            break;
                                        case 'fuel':
                                            row.append('<td>' + item.vendor
                                                .name +
                                                '</td>');
                                            row.append('<td>$' + (item
                                                .cost_per_unit * item
                                                .qty).toLocaleString(
                                                'en-US', {
                                                    minimumFractionDigits: 2
                                                }) + '</td>');

                                            row.append('<td>' + item.date +
                                                '</td>');
                                            break;
                                        case 'deployment':
                                            row.append('<td>' + item
                                                .vehicle.vehicle_data.make +
                                                ' ' +
                                                item.vehicle.vehicle_data
                                                .model +
                                                '<br><strong>License Plate:</strong> ' +
                                                item.vehicle.license_plate +
                                                '</td>'
                                            );
                                            row.append('<td>' + item.sites
                                                .site_name + '</td>');
                                            row.append('<td>' + (item
                                                    .shift_id == 1 ?
                                                    'Morning' : 'Evening') +
                                                '</td>');
                                            row.append('<td>' + formattedDate +
                                                '</td>');
                                            break;
                                    }

                                    tbody.append(row);
                                });
                                table.append(tbody);

                                // Insert the table into the modal body
                                $('#reportModal .modal-body').append(table);
                            });

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

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/reports/generate.blade.php ENDPATH**/ ?>
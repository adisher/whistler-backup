@extends('layouts.app')
@section('extra_css')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
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
        max-width: 1350px;
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
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('reports.template') }}">Report</a></li>
<li class="breadcrumb-item active">Generate Report</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    Generate Report
                </h3>
            </div>

            <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- {!! Form::open(['route' => 'reports.generate', 'method' => 'post']) !!} --}}
                {{-- {!! Form::hidden('user_id', Auth::user()->id) !!} --}}
                {{-- {!! Form::hidden('type', 'Created') !!} --}}
                <div class="form-group">
                    {!! Form::label(
                    'date_bracket',
                    __('From/To (Date)') . ' <span class="text-danger">*</span>',
                    ['class' => 'form-label'],
                    false,
                    ) !!}
                    <div id="reportrange" class="form-control">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span>
                        <input type="hidden" name="daterange" id="daterange">
                    </div>
                </div>
                @include('reports.includes.report_lists')
                <br />
                <button class="btn btn-success mt-3" id="viewButton">View Report</button>

                <br />
                <hr />
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label(
                            'report_format',
                            __('Report Format') . ' <span class="text-danger">*</span>',
                            ['class' => 'form-label'],
                            false,
                            ) !!}
                            <select id="report_format" name="report_format" class="form-control" disabled>
                                {{-- <option value="pdf">PDF</option> --}}
                                {{-- <option value="csv">CSV</option> --}}
                                <option value="xlsx">Excel</option>
                            </select>
                        </div>

                        <div class="form-group">
                            {!! Form::label(
                            'name',
                            __('Report Name') . ' <span class="text-danger">*</span>',
                            ['class' => 'form-label'],
                            false,
                            ) !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label(
                            'frequency',
                            __('Select Frequency') . ' <span class="text-danger">*</span>',
                            ['class' => 'form-label'],
                            false,
                            ) !!}
                            <select id="frequency" name="frequency" class="form-control">
                                <option value="" disabled>Select Shift</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            {!! Form::label(
                            'delivery_end_date',
                            __('Delivery End Date') . ' <span class="text-danger">*</span>',
                            ['class' => 'form-label'],
                            false,
                            ) !!}
                            {!! Form::date('date', null, ['class' => 'form-control']) !!}
                        </div> --}}


                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label(
                            'recipient',
                            __('Email Report Recipients') . ' <span class="text-danger">*</span>',
                            ['class' => 'form-label'],
                            false,
                            ) !!}
                            <select id="recipient" name="recipients[]" multiple="multiple" class="form-control">
                                <option value="">-</option>
                                @foreach ($recipients as $recipient)
                                <option value="{{ $recipient->id }}">{{ $recipient->email }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            {!! Form::label(
                            'subject',
                            __('Email Subject Line') . ' <span class="text-danger">*</span>',
                            ['class' => 'form-label'],
                            false,
                            ) !!}
                            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email_body', __('Email Content'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('email_body', null, ['class' => 'form-control', 'rows' => '4']) !!}
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success mt-3" id="schedule">Schedule Email</button>
                        {{-- {!! Form::submit(__('Schedule Email'), ['class' => 'btn btn-success']) !!} --}}
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
                {{-- <img src="{{ asset('assets/images/sample-fleet-rental.png') }}" class="img-fluid"
                    alt="Sample Image"> --}}
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="download">Download</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script src="{{ asset('assets/js/moment.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#fuel_allocation').change(function() {
            if($(this).is(":checked")) {
                console.log('checked');

                $('#maintenanceMenu').slideUp();
                $('#correctiveMaintenance').prop('checked', false);
                $('#preventiveMaintenance').prop('checked', false);
                
                $('#deploymentMenu').slideUp();
                
                // Clear the multiple select for sites
                $('#siteList').val(null).trigger('change');
                
                // Uncheck the checkboxes for shifts
                $('#morningShift').prop('checked', false);
                $('#eveningShift').prop('checked', false);

                $('#parts_allocation').prop('checked', false);
                $('#maintenanceToggle').prop('checked', false);
                $('#deploymentToggle').prop('checked', false);
                $('#maintenanceToggle').prop('checked', false);
                $('#shiftDetails').prop('checked', false);
            } else {
                console.log('unchecked');
            }
        });

        $('#parts_allocation').change(function() {
            if($(this).is(":checked")) {
                console.log('checked');

                $('#maintenanceMenu').slideUp();
                $('#correctiveMaintenance').prop('checked', false);
                $('#preventiveMaintenance').prop('checked', false);

                $('#deploymentMenu').slideUp();
                
                // Clear the multiple select for sites
                $('#siteList').val(null).trigger('change');
                
                // Uncheck the checkboxes for shifts
                $('#morningShift').prop('checked', false);
                $('#eveningShift').prop('checked', false);
                
                $('#fuel_allocation').prop('checked', false);
                $('#maintenanceToggle').prop('checked', false);
                $('#deploymentToggle').prop('checked', false);
                $('#maintenanceToggle').prop('checked', false);
                $('#shiftDetails').prop('checked', false);
            } else {
                console.log('unchecked');
            }
        });

        $('#deploymentToggle').change(function() {
            if ($(this).is(":checked")) {
                $('#maintenanceMenu').slideUp();
                $('#correctiveMaintenance').prop('checked', false);
                $('#preventiveMaintenance').prop('checked', false);

                $('#deploymentMenu').slideDown();
                $('#fuel_allocation').prop('checked', false);
                $('#parts_allocation').prop('checked', false);
                $('#maintenanceToggle').prop('checked', false);
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
                console.log('checked');
                $('#deploymentMenu').slideUp();
                // Clear the multiple select for sites
                $('#siteList').val(null).trigger('change');
                
                // Uncheck the checkboxes for shifts
                $('#morningShift').prop('checked', false);
                $('#eveningShift').prop('checked', false);

                $('#maintenanceMenu').slideDown();
                $('#fuel_allocation').prop('checked', false);
                $('#deploymentToggle').prop('checked', false);
                $('#parts_allocation').prop('checked', false);
                $('#rental').prop('checked', false);
                $('#shiftDetails').prop('checked', false);

                $('#correctiveMaintenance').prop('checked', true);
                $('#preventiveMaintenance').change(function() {
                    if ($(this).is(":checked")) {
                        $('#correctiveMaintenance').prop('checked', false);
                    }
                });
                
                $('#correctiveMaintenance').change(function() {
                    if ($(this).is(":checked")) {
                        $('#preventiveMaintenance').prop('checked', false);
                    }
                });
                
            } else {
                console.log('unchecked');
                $('#maintenanceMenu').slideUp();
                $('#correctiveMaintenance').prop('checked', false);
                $('#preventiveMaintenance').prop('checked', false);
            }
        });

        $('#shiftDetails').change(function() {
            if ($(this).is(":checked")) {
                console.log('checked');

                // Get all existing items in the right container
                var existingItems = $("#rightContainerList li");
                
                existingItems.each(function() {
                    var itemId = $(this).attr('id');
                    var originMenuId = $(this).attr('data-origin');
                    
                    // If the origin is not 'fleet', move the item back to its original container
                    if (originMenuId !== '#fleetnolist') {
                        // Update the respective selected items array to remove the item ID
                        if (originMenuId === '#partslist') {
                            selectedItemsArrayParts = selectedItemsArrayParts.filter(item => item !== itemId);
                        } else if (originMenuId === '#fuellist') {
                            selectedItemsArrayFuel = selectedItemsArrayFuel.filter(item => item !== itemId);
                        }
                        
                        // Move the item back to its original container
                        $(this).appendTo(originMenuId).removeClass('selected');
                    }
                });
                
                // Update the counter for moved assets
                $('#asset_count').text('Moved Assets: ' + $("#rightContainerList li").length);

                $('#maintenanceMenu').slideUp();
                $('#maintenanceToggle').prop('checked', false);
                $('#correctiveMaintenance').prop('checked', false);
                $('#preventiveMaintenance').prop('checked', false);

                $('#fuel_allocation').prop('checked', false);
                $('#parts_allocation').prop('checked', false);
                
            } else {
                console.log('unchecked');
            }
        });
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

            var urlSites = "{{ route('reports.get_sites') }}";
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

            var urlFleet = "{{ route('reports.get_fleet') }}";
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

            var urlParts = "{{ route('reports.get_parts') }}";
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

            var urlFuel = "{{ route('reports.get_fuel') }}";
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

            
            function setupAccordionToggle(buttonId) {
                $(buttonId).on('click', function() {
                    var icon = $(this).find('i');
                    var isExpanded = $(this).attr('aria-expanded') == 'false';
                    if (isExpanded) {
                        icon.removeClass('fa-chevron-left').addClass('fa-chevron-down');
                        // Remove 'disabled' class from all buttons
                        $('#moveAllLeftButton, #moveLeftButton, #moveRightButton, #moveAllRightButton')
                            .removeClass('disabled');
                    } else {
                        icon.removeClass('fa-chevron-down').addClass('fa-chevron-left');
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

                // Before appending new items, check if they are from 'fuel'
                if (origin === 'fuel') {
                    console.log('origin is fuel');
                    // Get all items currently in the right container
                    var existingItems = $("#rightContainerList li");
                    
                    // Move existing items back to their original containers
                    existingItems.each(function() {
                        var itemId = $(this).attr('id');
                        var originMenuId = $(this).attr('data-origin');
                        
                        // Remove the id from the respective selected items array
                        if (originMenuId === '#fleetnolist') {
                            selectedItemsArrayFleet = selectedItemsArrayFleet.filter(item => item !== itemId);
                        } else if (originMenuId === '#partslist') {
                            selectedItemsArrayParts = selectedItemsArrayParts.filter(item => item !== itemId);
                        } else if (originMenuId === '#fuellist') {
                            selectedItemsArrayFuel = selectedItemsArrayFuel.filter(item => item !== itemId);
                        }
                        
                        // Move the item back to its original container
                        $(this).appendTo(originMenuId).removeClass('selected');
                    });
                }

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
                    var origin = $(this).data('origin'); // get the origin from the data-origin attribute

                    if (origin === 'fleet') {
                        selectedItemsArrayFleet = selectedItemsArrayFleet.filter(item => item !== itemId);
                        // move selected items back to the fleet list
                        $(this).appendTo("#fleetnolist").removeClass('selected');
                        // update count of selected assets
                        $('#asset_count').text('Selected Assets: ' + selectedItemsArrayFleet.length);
                    } else if (origin === 'parts') {
                        selectedItemsArrayParts = selectedItemsArrayParts.filter(item => item !== itemId);
                        // move selected items back to the parts list
                        $(this).appendTo("#partslist").removeClass('selected');
                        // update count of selected assets
                        $('#asset_count_parts').text('Selected Assets: ' + selectedItemsArrayParts.length);
                    } else if (origin === 'fuel') {
                        selectedItemsArrayFuel = selectedItemsArrayFuel.filter(item => item !== itemId);
                        // move selected items back to the fuel list
                        $(this).appendTo("#fuellist").removeClass('selected');
                        // update count of selected assets
                        $('#asset_count_fuel').text('Selected Assets: ' + selectedItemsArrayFuel.length);
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

                // If the Fuel Inventory menu is open, move all existing items back to their original containers
                if (openMenuId === '#fuellist' || openMenuId === '#partslist' || openMenuId === '#fleetnolist') {
                    var existingItems = $("#rightContainerList li");
                    
                    existingItems.each(function() {
                        var itemId = $(this).attr('id');
                        var originMenuId = $(this).attr('data-origin');
                        
                        // Remove the id from the respective selected items array
                        if (originMenuId === '#fleetnolist') {
                            selectedItemsArrayFleet = selectedItemsArrayFleet.filter(item => item !== itemId);
                        } else if (originMenuId === '#partslist') {
                            selectedItemsArrayParts = selectedItemsArrayParts.filter(item => item !== itemId);
                        } else if (originMenuId === '#fuellist') {
                            selectedItemsArrayFuel = selectedItemsArrayFuel.filter(item => item !== itemId);
                        }
                        
                        // Move the item back to its original container
                        $(this).appendTo(originMenuId).removeClass('selected');
                    });
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
            function generateHeadersConfig(fleetCheck, correctiveMaintenance, preventiveMaintenance,
                shiftDetailsCheck, fuel, parts, fuel_allocation, parts_allocation) {
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

                if (!fuel && correctiveMaintenance && fleetCheck) {
                    config.push({
                        title: 'Corrective Maintenance',
                        colspan: 7
                    });
                } else if (!fuel && !correctiveMaintenance && fleetCheck && preventiveMaintenance) {
                    config.push({
                        title: 'Preventive Maintenance',
                        colspan: 9
                    });
                }

                if (!fuel && !parts && !correctiveMaintenance && !preventiveMaintenance && !fuel_allocation && !parts_allocation && fleetCheck && !shiftDetailsCheck) {
                    config.push({
                        title: 'Deployment',
                        colspan: 6
                    });
                }

                if (!fuel && !parts && !correctiveMaintenance && !preventiveMaintenance && !fuel_allocation && !parts_allocation && shiftDetailsCheck && fleetCheck) {
                    config.push({
                        title: 'Deployment',
                        colspan: 5
                    });
                }

                if (!fuel && shiftDetailsCheck && !correctiveMaintenance && !preventiveMaintenance) {
                    config.push({
                        title: 'Shift Details',
                        colspan: 10
                    });
                }
                if (fuel_allocation && !fuel && !shiftDetailsCheck && !correctiveMaintenance && !
                    preventiveMaintenance) {
                    config.push({
                        title: 'Fuel Allocation',
                        colspan: 6
                    });
                }
                if (parts_allocation && !fuel_allocation && !fuel && !shiftDetailsCheck && !correctiveMaintenance && !
                    preventiveMaintenance) {
                    config.push({
                        title: 'Spare & Tools Allocation',
                        colspan: 6
                    });
                }

                if (fuel && !correctiveMaintenance && !preventiveMaintenance && !shiftDetailsCheck && !fleetCheck) {
                    config.push({
                        title: 'Fuel Inventory',
                        colspan: 5
                    });
                }

                if (parts && !fuel && !correctiveMaintenance && !preventiveMaintenance && !shiftDetailsCheck && !
                    fleetCheck) {
                    config.push({
                        title: 'Spare & Tools Inventory',
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
                    var url = "{{ route('reports.fleet_data') }}";
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
                            fuel_allocation_checked: $('#fuel_allocation').is(':checked'),
                            parts_allocation_checked: $('#parts_allocation').is(':checked'),
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
                            var preventiveMaintenance = response.check_preventive_maintenance ==
                                "true";
                            console.log('preventiveMaintenance: ', preventiveMaintenance);

                            var shiftDetailsCheck = response.shift_checked == "true";

                            var fuel_allocation = response.fuel_allocation_checked == "true";
                            if (fuel_allocation) {
                                console.log('fuel_allocation: ', fuel_allocation);
                            } else {
                                console.log('fuel_allocation empty: ', fuel_allocation);
                            }
                            var parts_allocation = response.parts_allocation_checked == "true";
                            if (parts_allocation) {
                                console.log('parts_allocation: ', parts_allocation);
                            } else {
                                console.log('parts_allocation empty: ', parts_allocation);
                            }

                            var fuel = response['fuel'] != '';
                            if (fuel) {
                                console.log('fuel: ', fuel);
                            } else {
                                console.log('fuel not empty: ', fuel);
                            }

                            var parts = response['parts'] != '';
                            if (parts) {
                                console.log('parts: ', parts);
                            } else {
                                console.log('parts not empty: ', parts);
                            }

                            var headersConfig = generateHeadersConfig(fleetCheck,
                                correctiveMaintenance, preventiveMaintenance,
                                shiftDetailsCheck, fuel, parts, fuel_allocation, parts_allocation);

                            function appendRowWithDate(date, data, tbody) {
                                var row = $('<tr></tr>');
                                appendCell(row, date); // Append Date first

                                // Append other cells based on data
                                data.forEach(function(item) {
                                    appendCell(row, item);
                                });

                                // Append the row to the table body
                                tbody.append(row);
                            }

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
                                        headerRow2.append('<th>Driver/ Operator</th>');
                                        headerRow2.append('<th>Meter</th>');
                                        headerRow2.append('<th>Work Hrs</th>');
                                    }
                                    if (response.rental_checked == 'true' &&
                                        fleetCheck) {
                                        headerRow2.append('<th>Rental</th>');
                                    }
                                } else if (header.title === 'Shift Details') {
                                    if(!fleetCheck && shiftDetailsCheck){
                                        headerRow2.append('<th>Site</th>');
                                        headerRow2.append('<th>Shift</th>');
                                    }
                                    headerRow2.append(
                                        '<th>Shift Quantity (grams)</th>');
                                    headerRow2.append(
                                        '<th>Shift Quantity (pounds)</th>');
                                    headerRow2.append(
                                        '<th>Shift Quantity (kgs)</th>');
                                    headerRow2.append('<th>Net Weight (grams)</th>');
                                    headerRow2.append('<th>Net Weight (pounds)</th>');
                                    headerRow2.append('<th>Net Weight (kgs)</th>');
                                    headerRow2.append('<th>Wastage (grams)</th>');
                                    headerRow2.append(
                                        '<th>Yield Quality (carats)</th>');
                                } else if (header.title === 'Corrective Maintenance') {
                                    headerRow2.append('<th>Subject</th>');
                                    headerRow2.append('<th>Meter</th>');
                                    headerRow2.append('<th>Part/Item</th>');
                                    headerRow2.append('<th>Vendor</th>');
                                    headerRow2.append('<th>Quantity</th>');
                                    headerRow2.append('<th>Cost</th>');
                                    headerRow2.append('<th>Description</th>');
                                } else if (header.title === 'Preventive Maintenance') {
                                    headerRow2.append('<th>Service</th>');
                                    headerRow2.append('<th>Last Performed</th>');
                                    headerRow2.append('<th>Next Planned</th>');
                                    headerRow2.append('<th>Deviation</th>');
                                    headerRow2.append('<th>Part/Item</th>');
                                    headerRow2.append('<th>Vendor</th>');
                                    headerRow2.append('<th>Quantity</th>');
                                    headerRow2.append('<th>Cost</th>');
                                    headerRow2.append('<th>Email To</th>');
                                } else if (header.title === 'Fuel Inventory') {
                                    headerRow2.append('<th>Vendor</th>');
                                    headerRow2.append('<th>Purchased Qty</th>');
                                    headerRow2.append('<th>Unit Cost</th>');
                                    headerRow2.append('<th>Total Cost</th>');
                                    headerRow2.append('<th>Remaining Qty</th>');
                                } else if (header.title === 'Spare & Tools Inventory') {
                                    headerRow2.append('<th>Item</th>');
                                    headerRow2.append('<th>Vendor</th>');
                                    headerRow2.append('<th>Purchased Qty</th>');
                                    headerRow2.append('<th>Unit Cost</th>');
                                    headerRow2.append('<th>Total Cost</th>');
                                    headerRow2.append('<th>Remaining Qty</th>');
                                } else if (header.title === 'Fuel Allocation') {
                                    headerRow2.append('<th>Quantity (Ltr)</th>');
                                    headerRow2.append('<th>Meter/Hours</th>');
                                } else if (header.title === 'Spare & Tools Allocation') {
                                    headerRow2.append('<th>Item</th>');
                                    headerRow2.append('<th>Quantity</th>');
                                    headerRow2.append('<th>Total Price</th>');
                                }
                            });

                            thead.append(headerRow1);
                            thead.append(headerRow2);
                            table.append(thead);


                            var tbody = $('<tbody></tbody>');

                            var data = response['rental'];
                            var totalRentalCost = 0;
                            var totalWorkHrs = 0;
                            let totalHours = 0;
                            let totalMinutes = 0;
                            var totalWorkHrsAppended = false; // Flag to ensure totalWorkHrs is appended only once
                            var totalRow = $('<tr></tr>');
                            var totals = {
                                shift_quantity_grams: 0,
                                shift_quantity_pounds: 0,
                                shift_quantity_kgs: 0,
                                net_weight_grams: 0,
                                net_weight_pounds: 0,
                                net_weight_kgs: 0,
                                wastage: 0,
                            };

                            // Skip if data does not exist or is an empty object
                            if (fleetCheck && !correctiveMaintenance && !
                                preventiveMaintenance && !fuel_allocation && !parts_allocation) {
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
                                            // Reset total hours and minutes for each site
                                            // totalHours = 0;
                                            // totalMinutes = 0;

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
                                                // Step 1: Break down the hours and minutes
                                                let [hours, minutes] = item.work_hours.split(':').map(Number);
                                                
                                                // Step 2: Add them to the total
                                                totalHours += hours;
                                                totalMinutes += minutes;
                                                console.log('workHours: ', workHours);
                                                console.log('hours: ', hours);
                                                console.log('minutes: ', minutes);
                                                console.log('totalHours: ', totalHours);
                                                console.log('totalMinutes: ', totalMinutes);

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
                                                                        .shift_quantity_kgs
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
                                                                        .net_weight_kgs
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
                                                                    // Update totals
                                                                    totals.shift_quantity_grams += parseFloat(shiftDetail.shift_quantity_grams);
                                                                    totals.shift_quantity_pounds += parseFloat(shiftDetail.shift_quantity_pounds);
                                                                    totals.shift_quantity_kgs += parseFloat(shiftDetail.shift_quantity_kgs);
                                                                    totals.net_weight_grams += parseFloat(shiftDetail.net_weight_grams);
                                                                    totals.net_weight_pounds += parseFloat(shiftDetail.net_weight_pounds);
                                                                    totals.net_weight_kgs += parseFloat(shiftDetail.net_weight_kgs);
                                                                    totals.wastage += parseFloat(shiftDetail.wastage);
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
                                    if (!totalWorkHrsAppended) {
                                        // var totalRow = $('<tr></tr>');
                                        // Step 3: Convert total minutes to hours and remaining minutes
                                        totalHours += Math.floor(totalMinutes / 60);
                                        totalMinutes %= 60;
                                        
                                        // Convert back to HH:MM format
                                        let totalWorkHrs = `${String(totalHours).padStart(2, '0')}:${String(totalMinutes).padStart(2, '0')}`;
                                        
                                        // Skip the first 5 columns to directly place the values starting from the 6th column
                                        for (var i = 0; i < 6; i++) totalRow.append('<td></td>');
                                            
                                            // Append the totalWorkHrs to the 6th column, properly formatted
                                            totalRow.append($('<td></td>').text(totalWorkHrs));
                                            if(shiftDetailsCheck){
                                                totalRow.append($('<td></td>').text(totals.shift_quantity_grams));
                                                totalRow.append($('<td></td>').text(totals.shift_quantity_pounds));
                                                totalRow.append($('<td></td>').text(totals.shift_quantity_kgs));
                                                totalRow.append($('<td></td>').text(totals.net_weight_grams));
                                                totalRow.append($('<td></td>').text(totals.net_weight_pounds));
                                                totalRow.append($('<td></td>').text(totals.net_weight_kgs));
                                                totalRow.append($('<td></td>').text(totals.wastage));
                                                totalRow.append($('<td></td>').text(totals.yield_quality));
                                            }
                                        
                                            // Append total row to the table
                                            tbody.append(totalRow);
                                        
                                            totalWorkHrsAppended = true; // Set the flag to true
                                    }
                                    totalWorkHrsAppended = false;
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
                                    appendCell(row, shiftDetail.shift_quantity_kgs);
                                    appendCell(row, shiftDetail.net_weight_grams);
                                    appendCell(row, shiftDetail.net_weight_pounds);
                                    appendCell(row, shiftDetail.net_weight_kgs);
                                    appendCell(row, shiftDetail.wastage);
                                    appendCell(row, shiftDetail.yield_quality);

                                    // Update totals
                                    totals.shift_quantity_grams += parseFloat(shiftDetail.shift_quantity_grams);
                                    totals.shift_quantity_pounds += parseFloat(shiftDetail.shift_quantity_pounds);
                                    totals.shift_quantity_kgs += parseFloat(shiftDetail.shift_quantity_kgs);
                                    totals.net_weight_grams += parseFloat(shiftDetail.net_weight_grams);
                                    totals.net_weight_pounds += parseFloat(shiftDetail.net_weight_pounds);
                                    totals.net_weight_kgs += parseFloat(shiftDetail.net_weight_kgs);
                                    totals.wastage += parseFloat(shiftDetail.wastage);
                                    

                                    // Append the row to the tbody
                                    tbody.append(row);
                                });

                                if(shiftDetailsCheck){
                                    
                                    totalRow.find('td').eq(0).text('Totals');
                                    for (var i = 0; i < 3; i++) totalRow.append('<td></td>');
                                        totalRow.append($('<td></td>').text((totals.shift_quantity_grams || 0).toFixed(2)));
                                        totalRow.append($('<td></td>').text((totals.shift_quantity_pounds || 0).toFixed(2)));
                                        totalRow.append($('<td></td>').text((totals.shift_quantity_kgs || 0).toFixed(2)));
                                        totalRow.append($('<td></td>').text((totals.net_weight_grams || 0).toFixed(2)));
                                        totalRow.append($('<td></td>').text((totals.net_weight_pounds || 0).toFixed(2)));
                                        totalRow.append($('<td></td>').text((totals.net_weight_kgs || 0).toFixed(2)));
                                        totalRow.append($('<td></td>').text((totals.wastage || 0).toFixed(2)));
                                }
                                tbody.append(totalRow);
                            }

                            if (response.rental_checked == 'true' && fleetCheck) {
                                totalRow.find('td').eq(0).text('Totals');
                                if (!shiftDetailsCheck) {
                                    // Your existing logic for when shiftDetailsCheck is false
                                    totalRow.append($('<td></td>').text('$' + totalRentalCost.toFixed(2)));
                                } else {
                                    // When shiftDetailsCheck is true, add total rental cost next to total work hours
                                    // Assuming totalWorkHrs is at the 6th column (0-based index)
                                    totalRow.find('td').eq(6).after($('<td></td>').text('$' + totalRentalCost.toFixed(2)));
                                }
                                
                                // Append total row to the table
                                tbody.append(totalRow);
                            }

                            var totalFuelAllocationQuantity = 0;

                            if (fuel_allocation && fleetCheck && !parts_allocation) {
                                // Iterate through vehicle IDs
                                for (var vehicle_id in response.fuel_allocation) {
                                    var date_data = response.fuel_allocation[vehicle_id];

                                    // Iterate through the dates for each vehicle ID
                                    for (var date_key in date_data) {
                                        var allocations = date_data[date_key];

                                        // Now, allocations is an array; you can iterate through it
                                        allocations.forEach(function(allocation) {
                                            // Create a new row
                                            var row = $('<tr></tr>');

                                            // Append cells to the row
                                            appendCell(row, allocation.vehicle_data.fleet_no);
                                            appendCell(row, allocation.date);
                                            appendCell(row, allocation.qty);
                                            
                                            var lastCellContent;
                                            if (allocation.time === "0:00") {
                                                lastCellContent = allocation.meter;
                                            } else if (allocation.meter == 0) {
                                                lastCellContent = allocation.time;
                                            } else {
                                                lastCellContent = "N/A"; // Replace with what you want
                                            }
                                            appendCell(row, lastCellContent);

                                            totalFuelAllocationQuantity += parseFloat(allocation.qty);

                                            // Append the row to the table body
                                            tbody.append(row);
                                        });
                                    }
                                }
                                // Create and append the totals row after the loop
                                totalRow.append('<td colspan="2">Totals</td>'); // Adjust colspan as needed
                                totalRow.append($('<td></td>').text(totalFuelAllocationQuantity.toFixed(2)));
                                tbody.append(totalRow);
                            }
                            var totalPartsAllocationQuantity = 0;
                            var totalPartsAllocationPrice = 0;
                            if (parts_allocation && fleetCheck) {
                                // Iterate through vehicle IDs
                                for (var vehicle_id in response.parts_allocation) {
                                    var date_data = response.parts_allocation[vehicle_id];

                                    // Iterate through the dates for each vehicle ID
                                    for (var date_key in date_data) {
                                        var allocations = date_data[date_key];

                                        // Now, allocations is an array; you can iterate through it
                                        allocations.forEach(function(allocation) {
                                            // Create a new row
                                            var row = $('<tr></tr>');

                                            // Append cells to the row
                                            appendCell(row, allocation.vehicle.fleet_no);
                                            appendCell(row, allocation.date);
                                            appendCell(row, allocation.parts.title);
                                            appendCell(row, allocation.quantity);
                                            appendCell(row, allocation.price);

                                            // Accumulate totals
                                            totalPartsAllocationQuantity += parseFloat(allocation.quantity);
                                            totalPartsAllocationPrice += parseFloat(allocation.price);
                                            

                                            // Append the row to the table body
                                            tbody.append(row);
                                        });
                                    }
                                }
                                // Create and append the totals row after the loop
                                totalRow.append('<td colspan="3">Totals</td>'); // Adjust colspan as needed
                                totalRow.append($('<td></td>').text(totalPartsAllocationQuantity.toFixed(2)));
                                totalRow.append($('<td></td>').text(totalPartsAllocationPrice.toFixed(2)));
                                tbody.append(totalRow);
                            }

                            if (fleetCheck && correctiveMaintenance && !preventiveMaintenance) {

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
                                            appendCell(row, item.meter);
                                            appendCell(row, item.parts.title);
                                            appendCell(row, item.parts.vendor.name);
                                            appendCell(row, item.quantity);
                                            appendCell(row, item.price);
                                            appendCell(row, item.description);
                                            // Add more cells as needed

                                            // Append the row to the table body
                                            tbody.append(row);
                                        });
                                    }
                                }
                            }
                            if (fleetCheck && !correctiveMaintenance && preventiveMaintenance) {

                                // Dynamically access the preventive_maintenance data
                                var preventive_maintenance_data = response
                                    .preventive_maintenance;

                                // Iterate through the keys (e.g., '2', '2023-08-17') to access the arrays
                                for (var key in preventive_maintenance_data) {
                                    var date_key_data = preventive_maintenance_data[key];

                                    // Iterate through the keys again for the given date (e.g., '2023-08-17')
                                    for (var date_key in date_key_data) {
                                        var date_data = date_key_data[date_key];

                                        // Now date_data is an array; you can iterate through it
                                        date_data.forEach(function(item) {
                                            // Create a new row
                                            var row = $('<tr></tr>');
                                            // Replace all commas with line breaks
                                            var email = item.email_to ? item.email_to
                                                .replace(/,/g, '\n ') : 'N/A';
                                            var emailToFormatted = email.replace(/,/g,
                                                '\n');

                                            // Append cells to the row using the appendCell function
                                            appendCell(row, item.vehicle.fleet_no);
                                            appendCell(row, item.date);
                                            appendCell(row, item.services.description);
                                            appendCell(row, item.last_performed);
                                            appendCell(row, item.next_planned);
                                            appendCell(row, item.deviation ?? 'N/A');
                                            appendCell(row, item.parts.title);
                                            appendCell(row, item.parts.vendor.name);
                                            appendCell(row, item.quantity);
                                            appendCell(row, item.price);
                                            appendCell(row, emailToFormatted);
                                            // Add more cells as needed

                                            // Append the row to the table body
                                            tbody.append(row);
                                        });
                                    }
                                }
                            }
                            if (fuel && !correctiveMaintenance && !preventiveMaintenance && !
                                shiftDetailsCheck && !fleetCheck) {

                                // Dynamically access the preventive_maintenance data
                                var fuel_data = response
                                    .fuel;

                                // Iterate through the keys (e.g., '2', '2023-08-17') to access the arrays
                                for (var key in fuel_data) {
                                    var date_key_data = fuel_data[key];

                                    // Iterate through the keys again for the given date (e.g., '2023-08-17')
                                    for (var date_key in date_key_data) {
                                        var date_data = date_key_data[date_key];

                                        // Now date_data is an array; you can iterate through it
                                        date_data.forEach(function(item) {
                                            var total_cost = item.qty * item
                                                .cost_per_unit;
                                            appendRowWithDate(
                                                item.date,
                                                [item.vendor.name, item.qty, item
                                                    .cost_per_unit, total_cost, item
                                                    .remaining_qty
                                                ],
                                                tbody
                                            );
                                        });
                                    }
                                }
                            }
                            if (parts && !fuel && !correctiveMaintenance && !
                                preventiveMaintenance && !shiftDetailsCheck && !fleetCheck) {

                                // Dynamically access the preventive_maintenance data
                                var parts_data = response
                                    .parts;

                                // Iterate through the keys (e.g., '2', '2023-08-17') to access the arrays
                                for (var key in parts_data) {
                                    var date_key_data = parts_data[key];

                                    // Iterate through the keys again for the given date (e.g., '2023-08-17')
                                    for (var date_key in date_key_data) {
                                        var date_data = date_key_data[date_key];

                                        // Now date_data is an array; you can iterate through it
                                        date_data.forEach(function(item) {
                                            var total_cost = item.stock * item
                                            .unit_cost;
                                            appendRowWithDate(
                                                item.date,
                                                [item.title, item.vendor.name, item
                                                    .stock, item.unit_cost,
                                                    total_cost, item.remaining_qty
                                                ],
                                                tbody
                                            );
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
                    url: "{{ route('reports.download') }}",
                    method: 'POST',
                    data: {
                        report: reportData,
                        _token: "{{ csrf_token() }}" // Include CSRF token for security
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
@endsection


{{-- @extends('layouts.app')
@php($date_format_setting = Hyvikk::get('date_format') ? Hyvikk::get('date_format') : 'd-m-Y')
@section('extra_css')
<style>
    .border-btn {
        background-color: transparent;
        border: 1px solid #ddd;
    }

    .custom-item i {
        margin-right: 10px;
    }

    .custom-item:hover {
        background-color: #ddd;
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: bolder;
        margin-bottom: 1rem;
        text-align: center;
        float: none;
    }

    .text-icon {
        color: #3f51b5 !important
    }

    .image-container {
        position: relative;
        display: inline-block;
    }

    .image-container .img-fluid {
        width: 100%;
        height: auto;
    }

    .overlay-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: rgb(255, 254, 254);
        font-size: 2em;
        text-shadow: 2px 2px 4px rgb(255, 255, 255);
        background-color: #3f51b5;
        border-radius: 5px;
        padding: 5px;
    }
</style>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">@lang('menu.reports')</a></li>
<li class="breadcrumb-item active">Reports Template</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="card-title">Cost Analysis - Fleet Rental</h2>
                <p class="card-text">The Fleet Rental Report offers a comprehensive analysis of the rental expenses for
                    each selected asset by calculating
                    the cost based on shift work hours and the rental amount.</p>
                <div class="mt-5 mb-3">
                    <a href="#" class="card-link" data-toggle="modal" data-target="#modal1">View Sample</a>
                </div>
                <div class="dropdown mt-1">
                    <button class="btn border-btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Email Report
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <a class="dropdown-item custom-item" href="{{ route('reports.generate') }}"><i
                                class="fa fa-file-excel text-icon"></i>CSV</a>
                        <a class="dropdown-item custom-item" href="#"><i class="fa fa-file-pdf text-icon"></i>PDF</a>
                        <a class="dropdown-item custom-item" href="#"><i class="fa fa-file text-icon"></i>XLS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Repeat the above column for the second and third columns -->
</div>

<!-- Modals -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="image-container">
                    <img src="{{ asset('assets/images/sample-fleet-rental.PNG') }}" class="img-fluid"
                        alt="Sample Image">
                    <div class="overlay-text">SAMPLE</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Repeat for other modals -->
@endsection --}}
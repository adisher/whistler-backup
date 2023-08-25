@extends('layouts.app')
@section('extra_css')
<style type="text/css">
    .modal {
        overflow: auto;
        overflow-y: hidden;
    }

    /* .modal-open {
                                margin-left: -250px
                            } */

    .custom_padding {
        padding: .3rem !important;
    }

    .checkbox,
    #chk_all {
        width: 20px;
        height: 20px;
    }

    #loader {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        color: #555;
    }
</style>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">@lang('menu.reports')</a></li>
<li class="breadcrumb-item active">Fleet Report</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Fleet Report
                </h3>
            </div>

            <div class="card-body">
                {!! Form::open(['route' => 'reports.fleet_report', 'method' => 'post', 'class' => 'form-inline']) !!}
                @csrf
                <div class="row">
                    <div class="form-group" style="margin-right: 10px">
                        {{-- {!! Form::label('year', __('Date: '), ['class' => 'form-label']) !!} --}}
                        <div id="reportrange" class="form-control">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                            <input type="hidden" name="daterange" id="daterange">
                        </div>
                    </div>
                    <div class="form-group" style="margin-right: 10px">
                        {{-- {!! Form::label('vehicle', __('fleet.vehicles'), ['class' => 'form-label']) !!} --}}
                        <select id="vehicle_id" name="vehicle_id" class="form-control vehicles" style="width: 250px;">
                            <option value="">@lang('fleet.selectVehicle')</option>
                            @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle['id'] }}" @if ($vehicle['id']==$vehicle_id) selected @endif>
                                {{ $vehicle->make_name }}-{{ $vehicle->model_name }}-{{ $vehicle['license_plate'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin-right: 10px">
                        {{-- {!! Form::label('site_name', __('Sites'), ['class' => 'form-label']) !!} --}}
                        <select id="site_name" name="site_name" class="form-control vehicles" style="width: 250px;">
                            <option value="">Select Site</option>
                            @foreach ($sites as $s)
                            <option value="{{ $s['site_name'] }}" @if ($s['site_name']==$site) selected @endif>
                                {{ $s->site_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info"
                        style="margin-right: 10px">@lang('fleet.generate_report')</button>
                    <button type="submit" formaction="{{ url('admin/print-fuel-report') }}" class="btn btn-danger"><i
                            class="fa fa-print"></i> @lang('fleet.print')</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Fleet Report
                </h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table" id="myTable" style="padding-bottom: 25px">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Index</th>
                            <th>Image</th>
                            <th nowrap>Make - Model - Engine</th>
                            <th>License Plate</th>
                            <th>In Service?</th>
                            <th>Assigned Driver</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <th>Index</th>
                            <th disabled>Image</th>
                            <th>Make - Model - Engine - Color - Condition</th>
                            <th>License Plate</th>
                            <th>In Service?</th>
                            <th>Assigned Driver</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('assets/js/cdn/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/vfs_fonts.js') }}"></script>
<script type="text/javascript">
    $(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                // Update the hidden input field's value
                $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
            $("#vehicle_id").select2();
            $("#site_name").select2();

            $('form').on('submit', function(e) {
                e.preventDefault(); // prevent form from submitting normally

                // get form data
                var formData = $(this).serialize();

                // First, destroy the existing table if it exists
                if ($.fn.DataTable.isDataTable('#myTable')) {
                    $('#myTable').DataTable().destroy();
                }

                // Empty the body of the table
                $('#myTable tbody').empty();

                var table = $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "initComplete": function() {
                    this.api().columns().every(function() {
                    var column = this;
                    var title = $(column.footer()).text();
                    $(column.footer()).html('<input type="text" placeholder="' + title + '" />');
                    });
                    },
                    "drawCallback": function() {
                    this.api().columns().every(function() {
                    var that = this;
                    $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                    that.search(this.value).draw();
                    }
                    });
                    });
                    },
                    ajax: function(data, callback, settings) {
                        // Make the AJAX request
                        $.ajax({
                            url: "{{ route('reports.fleet_report') }}",
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                // Pass the data to DataTables
                                callback(response);

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                // handle any errors
                                console.error(textStatus, errorThrown);
                            }
                        });
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'vehicle_image',
                            name: 'vehicle_image',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'make',
                            name: 'vehicles.make_name'
                        },
                        {
                            data: 'license_plate',
                            name: 'license_plate'
                        },
                        {
                            data: 'in_service',
                            name: 'in_service'
                        },
                        {
                            data: 'assigned_driver',
                            name: 'assigned_driver',
                            render: function(data, type, row, meta) {
                                if (!data) {
                                    return 'N/A';
                                } else {
                                    return data;
                                }
                            }
                        },
                    ],
                    order: [
                        [1, 'desc']
                    ],
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: [{
                                extend: 'excel',
                                exportOptions: {
                                    columns: [2, 3, 4, 5, 6, 7, 8, 9]
                                },
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    columns: [2, 3, 4, 5, 6, 7, 8, 9]
                                },
                            },
                            {
                                extend: 'pdf',
                                exportOptions: {
                                    columns: [2, 3, 4, 5, 6, 7, 8, 9]
                                },
                            }
                        ]
                    }],
                    "language": {
                        "url": '{{ asset('assets/datatables/') . '/' . __('fleet.datatable_lang') }}',
                    }
                });

            });
        });
</script>
@endsection
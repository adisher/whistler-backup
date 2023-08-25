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
                        <select id="site_id" name="site_id" class="form-control vehicles" style="width: 250px;">
                            <option value="">Select Site</option>
                            @foreach ($sites as $s)
                            <option value="{{ $s['id'] }}" @if ($s['id']==$site_id) selected @endif>
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
@if(isset($fleet_result))
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
                            <th nowrap>Make - Model - Engine</th>
                            <th>License Plate</th>
                            <th>In Service?</th>
                            <th>Assigned Driver</th>
                            <th>Assigned Site</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($yield as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->make_name }} - {{ $item->model_name }} - {{ $item->engine_type }}
                            <br /><strong>Type: </strong>{{ $item->types->displayname }}
                            <br/><strong>Color: </strong>{{ $item->color_name }} 
                            <br /><strong>Condition: </strong>{{ $item->fleet_condition}}
                            </td>
                            <td>{{ $item->license_plate }}</td>
                            <td>{{ $item->in_service? 'YES' : 'NO' }}</td>
                            <td>
                                @if($item->drivers->isEmpty())
                                N/A
                                @else
                                @foreach($item->drivers as $driver)
                                {{ $driver->name }}
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if($item->sites->isEmpty())
                                N/A
                                @else
                                @foreach ($item->sites as $s)
                                {{ $s->site_name }}
                                @endforeach
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Index</th>
                            <th>Make - Model - Engine - Color - Condition</th>
                            <th>License Plate</th>
                            <th>In Service?</th>
                            <th>Assigned Driver</th>
                            <th>Assigned Site</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('assets/js/cdn/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/vfs_fonts.js') }}"></script>
<script type="text/javascript">
    $(function() {
            var start = '{{ $start_date }}' ? moment('{{ $start_date }}') : moment().subtract(29, 'days');
            var end = '{{ $end_date }}' ? moment('{{ $end_date }}') : moment();

            function cb(start, end) {
            if(start && end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            } else {
            $('#reportrange span').html('All Time');
            $('#daterange').val(''); // send an empty string for "All Time"
            }
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
                        'month').endOf('month')],
                        'All Time': ['', ''],
                }
            }, cb);

            cb(start, end);
            $("#vehicle_id").select2();
            $("#site_id").select2();

           $('#myTable tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="'+title+'" />' );
            });
            var myTable = $('#myTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [{
            extend: 'collection',
            text: 'Export',
            buttons: [
            'copy',
            'excel',
            'csv',
            'pdf',
            ]}
            ],
            
            "language": {
            "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}',
            },
            "initComplete": function() {
            myTable.columns().every(function () {
            var that = this;
            console.log(that);
            $('input', this.footer()).on('keyup change', function () {
            that.search(this.value).draw();
            });
            });
            }
            });
            });
</script>
@endsection
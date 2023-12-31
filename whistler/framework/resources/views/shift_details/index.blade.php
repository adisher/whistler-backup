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

    .nowrap {
        white-space: nowrap;
    }
</style>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item active">Yield Details</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Manage Yield Details &nbsp; @can('ProductYields add')
                    <a href="{{ route('shift-details.create') }}" class="btn btn-success"
                        title="@lang('fleet.addNew')"><i class="fa fa-plus"></i></a>
                    @endcan
                    {{-- @can('Vehicles import')<button data-toggle="modal" data-target="#import"
                        class="btn btn-warning">@lang('fleet.import')</button>@endcan --}}
                </h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table" id="ajax_data_table" style="padding-bottom: 25px">
                    <thead class="thead-inverse">
                        <tr>
                            <th>
                                <input type="checkbox" id="chk_all">
                            </th>
                            {{-- <th>#</th> --}}
                            {{-- <th>@lang('fleet.date')</th> --}}
                            <th>@lang('fleet.site_name')</th>
                            <th>Shift Name</th>
                            <th>Date</th>
                            <th>Shift Yield Details</th>
                            <th>Shift Quantity<br>(grams)</th>
                            <th>Shift Quantity<br>(pounds)</th>
                            <th>Shift Quantity<br>(kgs)</th>
                            <th>Yield Quality<br>(carats)</th>
                            <th>Wastage<br>(grams)</th>
                            <th>Net Weight<br>(grams)</th>
                            <th>Net Weight<br>(pounds)</th>
                            {{-- <th>Status</th> --}}
                            <th>@lang('fleet.action')</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>

                                @can('Vehicles delete')
                                <button class="btn btn-danger" id="bulk_delete" data-toggle="modal"
                                    data-target="#bulkModal" disabled title="@lang('fleet.delete')"><i
                                        class="fa fa-trash"></i></button>
                                @endcan
                            </th>
                            {{-- <th>Index</th> --}}
                            {{-- <th>@lang('fleet.date')</th> --}}
                            <th>@lang('fleet.site_name')</th>
                            <th>Shift Name</th>
                            <th>Date</th>
                            <th>Shift Yield Details</th>
                            <th>Shift Quantity<br>(grams)</th>
                            <th>Shift Quantity<br>(pounds)</th>
                            <th>Shift Quantity<br>(kgs)</th>
                            <th>Yield Quality<br>(carats)</th>
                            <th>Wastage<br>(grams)</th>
                            <th>Net Weight<br>(grams)</th>
                            <th>Net Weight<br>(pounds)</th>
                            {{-- <th>Status</th> --}}
                            {{-- <th>@lang('fleet.assigned_driver')</th> --}}
                            <th>@lang('fleet.action')</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="import" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('fleet.importVehicles')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'admin/import-vehicles', 'method' => 'POST', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('excel', __('fleet.importVehicles'), ['class' => 'form-label']) !!}
                    {!! Form::file('excel', ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    <a href="{{ asset('assets/samples/vehicles.xlsx') }}">@lang('fleet.downloadSampleExcel')</a>
                </div>
                <div class="form-group">
                    <h6 class="text-muted">@lang('fleet.note'):</h6>
                    <ul class="text-muted">
                        <li>@lang('fleet.vehicleImportNote1')</li>
                        <li>@lang('fleet.vehicleImportNote2')</li>
                        <li>@lang('fleet.excelNote')</li>
                        <li>@lang('fleet.fileTypeNote')</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="submit">@lang('fleet.import')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div id="bulkModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('fleet.delete')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'admin/delete-vehicles', 'method' => 'POST', 'id' => 'form_delete']) !!}
                <div id="bulk_hidden"></div>
                <p>@lang('fleet.confirm_bulk_delete')</p>
            </div>
            <div class="modal-footer">
                <button id="bulk_action" class="btn btn-danger" type="submit"
                    data-submit="">@lang('fleet.delete')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('fleet.delete')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>@lang('fleet.confirm_delete')</p>
            </div>
            <div class="modal-footer">
                <button id="del_btn" class="btn btn-danger" type="button" data-submit="">@lang('fleet.delete')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!--model 2 -->
<div id="myModal2" class="modal  fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('fleet.vehicle')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div id="loader">
                    Loading data...
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    @lang('fleet.close')
                </button>
            </div>
        </div>
    </div>
</div>
<!--model 2 -->
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('assets/js/cdn/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/buttons.html5.min.js') }}"></script>
<script type="text/javascript">
    $("#del_btn").on("click", function() {
            var id = $(this).data("submit");
            $("#form_" + id).submit();
        });

        $('#myModal').on('show.bs.modal', function(e) {
            var id = e.relatedTarget.dataset.id;
            $("#del_btn").attr("data-submit", id);
        });

        // $(document).on('click', '.openBtn', function() {
        //     // alert($(this).data("id"));
        //     var id = $(this).attr("data-id");
        //     $('#myModal2 .modal-body').load('{{ url('admin/vehicle/event') }}/' + id, function(result) {
        //         $('#myModal2').modal({
        //             show: true
        //         });
        //     });
        // });
        $(document).on('click', '.openBtn', function() {
            var id = $(this).attr("data-id");
            $('#myModal2 .modal-body').html('<div id="loader">Loading data...</div>');
            $('#myModal2').modal({
                show: true
            });
            $.ajax({
                url: '{{ url('admin/vehicle/event') }}/' + id,
                type: 'GET',
                success: function(result) {
                    $('#myModal2 .modal-body').html(result);
                },
                error: function() {
                    $('#myModal2 .modal-body').html('Error loading data.');
                },
                complete: function() {
                    $('#loader').hide();
                }
            });
        });


        $(function() {

            var table = $('#ajax_data_table').DataTable({
                "language": {
                    "url": '{{ asset('assets/datatables/') . '/' . __('fleet.datatable_lang') }}',
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('admin/shift-details-fetch') }}",
                    type: 'POST',
                    data: {}
                },
                columns: [{
                        data: 'check',
                        name: 'check',
                        searchable: false,
                        orderable: false
                    },
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    // {
                    //     data: 'created_at',
                    //     name: 'shift_details.created_at',
                    //     render: function(data, type, row) {
                    //         let date = new Date(data);
                    //         let formattedDate = date.getFullYear()+'-'+('0' + (date.getMonth()+1)).slice(-2)+'-'+('0' + date.getDate()).slice(-2);
                    //         return formattedDate;
                    //     }
                    // },
                    {
                        data: 'site_name',
                        name: 'site_name'
                    },
                    {
                        data: 'shift_name',
                        name: 'shift_details.shift_name'
                    },
                    {
                        data: 'date',
                        name: 'shift_details.date'
                    },
                    {
                        data: 'shift_yield_details',
                        name: 'shift_details.shift_yield_details'
                    },
                    {
                        data: 'shift_quantity_grams',
                        name: 'shift_details.shift_quantity_grams'
                    },
                    {
                        data: 'shift_quantity_pounds',
                        name: 'shift_details.shift_quantity_pounds'
                    },
                    {
                        data: 'yield_quality',
                        name: 'shift_details.yield_quality'
                    },
                    {
                        data: 'wastage',
                        name: 'shift_details.wastage'
                    },
                    {
                        data: 'net_weight_grams',
                        name: 'shift_details.net_weight_grams'
                    },
                    {
                        data: 'net_weight_pounds',
                        name: 'shift_details.net_weight_pounds'
                    },
                    {
                        data: 'net_weight_kgs',
                        name: 'shift_details.net_weight_kgs'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }
                ],
                order: [
                    [1, 'desc']
                ],
                "initComplete": function() {
                    table.columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function() {
                            // console.log($(this).parent().index());
                            that.search(this.value).draw();
                        });
                    });
                }
            });
        });
        $(document).on('click', 'input[type="checkbox"]', function() {
            if (this.checked) {
                $('#bulk_delete').prop('disabled', false);

            } else {
                if ($("input[name='ids[]']:checked").length == 0) {
                    $('#bulk_delete').prop('disabled', true);
                }
            }

        });
        $('#bulk_delete').on('click', function() {
            // console.log($( "input[name='ids[]']:checked" ).length);
            if ($("input[name='ids[]']:checked").length == 0) {
                $('#bulk_delete').prop('type', 'button');
                new PNotify({
                    title: 'Failed!',
                    text: "@lang('fleet.delete_error')",
                    type: 'error'
                });
                $('#bulk_delete').attr('disabled', true);
            }
            if ($("input[name='ids[]']:checked").length > 0) {
                // var favorite = [];
                $.each($("input[name='ids[]']:checked"), function() {
                    // favorite.push($(this).val());
                    $("#bulk_hidden").append('<input type=hidden name=ids[] value=' + $(this).val() + '>');
                });
                // console.log(favorite);
            }
        });

        $('#chk_all').on('click', function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    $('.checkbox').prop("checked", true);
                });
            } else {
                $('.checkbox').each(function() {
                    $('.checkbox').prop("checked", false);
                });
                $('#bulk_delete').prop('disabled', true);
            }
        });

        // Checkbox checked
        function checkcheckbox() {
            // Total checkboxes
            var length = $('.checkbox').length;
            // Total checked checkboxes
            var totalchecked = 0;
            $('.checkbox').each(function() {
                if ($(this).is(':checked')) {
                    totalchecked += 1;
                }
            });
            // console.log(length+" "+totalchecked);
            // Checked unchecked checkbox
            if (totalchecked == length) {
                $("#chk_all").prop('checked', true);
            } else {
                $('#chk_all').prop('checked', false);
            }
        }

        $(document).ready(function() {
            $('#myTable tfoot th').each(function() {
                if ($(this).index() != 0 && $(this).index() != $('#data_table tfoot th').length - 1) {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="' + title + '" />');
                }
            });
            var myTable = $('#myTable').DataTable({
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
                },
                // individual column search
                "initComplete": function() {
                    myTable.columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function() {
                            that.search(this.value).draw();
                        });
                    });
                }
            });
        });
</script>
@endsection
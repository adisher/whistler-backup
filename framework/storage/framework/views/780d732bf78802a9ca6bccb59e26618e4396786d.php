<?php $__env->startSection('extra_css'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active">Manage Shifts</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Manage Shifts &nbsp; <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ProductYields add')): ?>
                    
                    <?php endif; ?>
                    
                </h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table" id="ajax_data_table" style="padding-bottom: 25px">
                    <thead class="thead-inverse">
                        <tr>
                            <th>
                                <input type="checkbox" id="chk_all">
                            </th>
                            <th>#</th>
                            <th><?php echo app('translator')->get('fleet.site_name'); ?></th>
                            <th>Shift Name</th>
                            <th><?php echo app('translator')->get('fleet.shift_incharge_id'); ?></th>
                            <th><?php echo app('translator')->get('fleet.shift_details'); ?></th>
                            
                            
                            <th><?php echo app('translator')->get('fleet.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vehicles delete')): ?>
                                <button class="btn btn-danger" id="bulk_delete" data-toggle="modal"
                                    data-target="#bulkModal" disabled title="<?php echo app('translator')->get('fleet.delete'); ?>"><i
                                        class="fa fa-trash"></i></button>
                                <?php endif; ?>
                            </th>
                            <th>Index</th>
                            <th><?php echo app('translator')->get('fleet.site_name'); ?></th>
                            <th>Shift Name</th>
                            <th><?php echo app('translator')->get('fleet.shift_incharge_id'); ?></th>
                            <th><?php echo app('translator')->get('fleet.shift_details'); ?></th>
                            
                            
                            
                            
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
                <h4 class="modal-title"><?php echo app('translator')->get('fleet.importVehicles'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php echo Form::open(['url' => 'admin/import-vehicles', 'method' => 'POST', 'files' => true]); ?>

                <div class="form-group">
                    <?php echo Form::label('excel', __('fleet.importVehicles'), ['class' => 'form-label']); ?>

                    <?php echo Form::file('excel', ['class' => 'form-control', 'required']); ?>

                </div>
                <div class="form-group">
                    <a href="<?php echo e(asset('assets/samples/vehicles.xlsx')); ?>"><?php echo app('translator')->get('fleet.downloadSampleExcel'); ?></a>
                </div>
                <div class="form-group">
                    <h6 class="text-muted"><?php echo app('translator')->get('fleet.note'); ?>:</h6>
                    <ul class="text-muted">
                        <li><?php echo app('translator')->get('fleet.vehicleImportNote1'); ?></li>
                        <li><?php echo app('translator')->get('fleet.vehicleImportNote2'); ?></li>
                        <li><?php echo app('translator')->get('fleet.excelNote'); ?></li>
                        <li><?php echo app('translator')->get('fleet.fileTypeNote'); ?></li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="submit"><?php echo app('translator')->get('fleet.import'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('fleet.close'); ?></button>
            </div>
            <?php echo Form::close(); ?>

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
                <h4 class="modal-title"><?php echo app('translator')->get('fleet.delete'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php echo Form::open(['url' => 'admin/delete-vehicles', 'method' => 'POST', 'id' => 'form_delete']); ?>

                <div id="bulk_hidden"></div>
                <p><?php echo app('translator')->get('fleet.confirm_bulk_delete'); ?></p>
            </div>
            <div class="modal-footer">
                <button id="bulk_action" class="btn btn-danger" type="submit"
                    data-submit=""><?php echo app('translator')->get('fleet.delete'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('fleet.close'); ?></button>
            </div>
            <?php echo Form::close(); ?>

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
                <h4 class="modal-title"><?php echo app('translator')->get('fleet.delete'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p><?php echo app('translator')->get('fleet.confirm_delete'); ?></p>
            </div>
            <div class="modal-footer">
                <button id="del_btn" class="btn btn-danger" type="button" data-submit=""><?php echo app('translator')->get('fleet.delete'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('fleet.close'); ?></button>
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
                <h4 class="modal-title"><?php echo app('translator')->get('fleet.vehicle'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div id="loader">
                    Loading data...
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo app('translator')->get('fleet.close'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
<!--model 2 -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/vfs_fonts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/buttons.html5.min.js')); ?>"></script>
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
        //     $('#myModal2 .modal-body').load('<?php echo e(url('admin/vehicle/event')); ?>/' + id, function(result) {
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
                url: '<?php echo e(url('admin/vehicle/event')); ?>/' + id,
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
                    "url": '<?php echo e(asset('assets/datatables/') . '/' . __('fleet.datatable_lang')); ?>',
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(url('admin/shifts-fetch')); ?>",
                    type: 'POST',
                    data: {}
                },
                columns: [{
                        data: 'check',
                        name: 'check',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'site_name',
                        name: 'shifts.site_name'
                    },
                    {
                        data: 'shift_name',
                        name: 'shifts.shift_name'
                    },
                    {
                        data: 'shift_incharge_id',
                        name: 'shifts.shift_incharge_id'
                    },
                    {
                        data: 'shift_details',
                        name: 'shifts.shift_details'
                    },
                    // {
                    //     data: 'date',
                    //     name: 'shifts.date'
                    // },
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
                    text: "<?php echo app('translator')->get('fleet.delete_error'); ?>",
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
                    "url": '<?php echo e(asset('assets/datatables/') . '/' . __('fleet.datatable_lang')); ?>',
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/shifts/index.blade.php ENDPATH**/ ?>
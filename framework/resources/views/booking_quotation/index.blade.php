@extends('layouts.app')
@php($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y')

@section('extra_css')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.min.css')}}">
<style type="text/css">
  .checkbox,
  #chk_all {
    width: 20px;
    height: 20px;
  }
</style>
@endsection
@section("breadcrumb")
<li class="breadcrumb-item active">@lang('fleet.booking_quotes')</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header with-border">
        <h3 class="card-title"> @lang('fleet.manageBookingQuotations') &nbsp;
          @can('BookingQuotations add')<a href="{{route('booking-quotation.create')}}" class="btn btn-success"
            title="@lang('fleet.add_quote')"><i class="fa fa-plus"></i></a>@endcan
        </h3>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-responsive display" id="ajax_data_table" style="padding-bottom: 35px; width: 100%">
            <thead class="thead-inverse">
              <tr>
                <th>
                  <input type="checkbox" id="chk_all">
                </th>
                <th style="width: 10% !important">@lang('fleet.customer')</th>
                <th style="width: 10% !important">@lang('fleet.vehicle')</th>
                <th style="width: 10% !important">@lang('fleet.pickup_addr')</th>
                <th style="width: 10% !important">@lang('fleet.dropoff_addr')</th>
                <th style="width: 10% !important">@lang('fleet.pickup')</th>
                <th style="width: 10% !important">@lang('fleet.dropoff')</th>
                <th style="width: 10% !important">@lang('fleet.passengers')</th>
                <th style="width: 10% !important">@lang('fleet.total') @lang('fleet.amount')</th>
                <th>@lang('fleet.approve')/@lang('fleet.reject') </th>
                <th style="width: 10% !important">@lang('fleet.action')</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <th>
                  @can('BookingQuotations delete')<button class="btn btn-danger" id="bulk_delete" data-toggle="modal"
                    data-target="#bulkModal" disabled title="@lang('fleet.delete')"><i
                      class="fa fa-trash"></i></button>@endcan
                </th>
                <th>@lang('fleet.customer')</th>
                <th>@lang('fleet.vehicle')</th>
                <th>@lang('fleet.pickup_addr')</th>
                <th>@lang('fleet.dropoff_addr')</th>
                <th>@lang('fleet.pickup')</th>
                <th>@lang('fleet.dropoff')</th>
                <th>@lang('fleet.passengers')</th>
                <th>@lang('fleet.total') @lang('fleet.amount')</th>
                <th>@lang('fleet.approve')/@lang('fleet.reject')</th>
                <th>@lang('fleet.action')</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

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
        {!! Form::open(['url'=>'admin/delete-quotes','method'=>'POST','id'=>'form_delete']) !!}
        <div id="bulk_hidden"></div>
        <p>@lang('fleet.confirm_bulk_delete')</p>
      </div>
      <div class="modal-footer">
        <button id="bulk_action" class="btn btn-danger" type="submit" data-submit="">@lang('fleet.delete')</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
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

{{-- reject modal --}}
<div id="rejectModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('fleet.reject') @lang('fleet.bookingQuote')</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>@lang('fleet.confirm_reject')</p>
      </div>
      <div class="modal-footer">
        <button id="del_btn2" class="btn btn-danger" type="button" data-submit="">@lang('fleet.reject')</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section("script")

<script src="{{ asset('assets/js/moment.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
  @if(Session::get('msg'))
    new PNotify({
        title: 'Success!',
        text: '{{ Session::get('msg') }}',
        type: 'success'
      });
  @endif

  $(document).ready(function() {
    $('#date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
  });
</script>
<script type="text/javascript">
  $("#del_btn").on("click",function(){
    var id=$(this).data("submit");
    $("#book_"+id).submit();
  });

  $("#del_btn2").on("click",function(){
    var id=$(this).data("submit");
    $("#reject_"+id).submit();
  });

  $('#myModal').on('show.bs.modal', function(e) {
    var id = e.relatedTarget.dataset.id;
    $("#del_btn").attr("data-submit",id);
  });

  $('#rejectModal').on('show.bs.modal', function(e) {
    var id = e.relatedTarget.dataset.id;
    $("#del_btn2").attr("data-submit",id);
  });
</script>

<script type="text/javascript" language="javascript">
  $(document).on('click','input[type="checkbox"]',function(){
    if(this.checked){
      $('#bulk_delete').prop('disabled',false);

    }else { 
      if($("input[name='ids[]']:checked").length == 0){
        $('#bulk_delete').prop('disabled',true);
      } 
    } 
    
  });

  $(function(){
    
    var table = $('#ajax_data_table').DataTable({      
      "language": {
          "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}',
      },
      processing: true,
      serverSide: true,
      ajax: {
        url: "{{ url('admin/booking-quotation-fetch') }}",
        type: 'POST',
        data:{}
      },
      columns: [
        {data: 'check',   name: 'check', searchable:false, orderable:false},
        {data: 'customer',   name: 'customer.name'},
        {data: 'vehicle', name: 'vehicle'},
        {data: 'pickup_addr',    name: 'pickup_addr'},
        {data: 'dest_addr',    name: 'dest_addr'},
        {name: 'pickup',data: {_: 'pickup.display',sort: 'pickup.timestamp'}},
        {name: 'dropoff',data: {_: 'dropoff.display',sort: 'dropoff.timestamp'}},
        {data: 'travellers',  name: 'travellers'},
        {data: 'tax_total',  name: 'tax_total'},
        {data: 'status',  name: 'status'},
        {data: 'action',  name: 'action', searchable:false, orderable:false}
      ],
      order: [[1, 'desc']],
      "initComplete": function() {
        table.columns().every(function () {
          var that = this;
          $('input', this.footer()).on('keyup change', function () {
            // console.log($(this).parent().index());
              that.search(this.value).draw();
          });
        });
      }
    });
  });

  $('#bulk_delete').on('click',function(){
    // console.log($( "input[name='ids[]']:checked" ).length);
    if($( "input[name='ids[]']:checked" ).length == 0){
      $('#bulk_delete').prop('type','button');
        new PNotify({
            title: 'Failed!',
            text: "@lang('fleet.delete_error')",
            type: 'error'
          });
        $('#bulk_delete').attr('disabled',true);
    }
    if($("input[name='ids[]']:checked").length > 0){
      // var favorite = [];
      $.each($("input[name='ids[]']:checked"), function(){
          // favorite.push($(this).val());
          $("#bulk_hidden").append('<input type=hidden name=ids[] value='+$(this).val()+'>');
      });
      // console.log(favorite);
    }
  });


  $('#chk_all').on('click',function(){
    if(this.checked){
      $('.checkbox').each(function(){
        $('.checkbox').prop("checked",true);
      });
    }else{
      $('.checkbox').each(function(){
        $('.checkbox').prop("checked",false);
      });
      $('#bulk_delete').prop('disabled',true);
    }
  });

  // Checkbox checked
  function checkcheckbox(){
    // Total checkboxes
    var length = $('.checkbox').length;
    // Total checked checkboxes
    var totalchecked = 0;
    $('.checkbox').each(function(){
        if($(this).is(':checked')){
            totalchecked+=1;
        }
    });
    // console.log(length+" "+totalchecked);
    // Checked unchecked checkbox
    if(totalchecked == length){
        $("#chk_all").prop('checked', true);
    }else{
        $('#chk_all').prop('checked', false);
    }
  }
</script>
@endsection
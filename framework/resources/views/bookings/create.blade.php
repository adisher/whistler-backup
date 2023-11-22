@extends('layouts.app')
@section('extra_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endsection
@section("breadcrumb")
<li class="breadcrumb-item "><a href="{{ route('bookings.index')}}">@lang('menu.bookings')</a></li>
<li class="breadcrumb-item active">@lang('fleet.new_booking')</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">
          @lang('fleet.new_booking')
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

        {!! Form::open(['route' => 'bookings.store','method'=>'post']) !!}
        {!! Form::hidden('user_id',Auth::user()->id)!!}
        {!! Form::hidden('status',0)!!}
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('customer_id',__('fleet.selectCustomer'), ['class' => 'form-label']) !!}
              @if(Auth::user()->user_type != "C") <a href="#" data-toggle="modal"
                data-target="#exampleModal">@lang('fleet.new_customer')</a> @endif
              <select id="customer_id" name="customer_id" class="form-control" required>
                <option value="">-</option>
                @if(Auth::user()->user_type == "C")
                <option value="{{Auth::user()->id}}" data-address="{{Auth::user()->getMeta('address')}}"
                  data-address2="" data-id="{{Auth::user()->id}}" selected>{{Auth::user()->name}}
                </option>
                @else
                @foreach($customers as $customer)
                <option value="{{$customer->id}}" data-address="{{$customer->getMeta('address')}}" data-address2=""
                  data-id="{{$customer->id}}">{{$customer->name}}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('pickup',__('fleet.pickup'), ['class' => 'form-label']) !!}
              <div class='input-group mb-3 date'>
                <div class="input-group-prepend">
                  <span class="input-group-text"> <span class="fa fa-calendar"></span></span>
                </div>
                {!! Form::text('pickup',date("Y-m-d H:i:s"),['class'=>'form-control','required']) !!}
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('dropoff',__('fleet.dropoff'), ['class' => 'form-label']) !!}
              <div class='input-group date'>
                <div class="input-group-prepend">
                  <span class="input-group-text"><span class="fa fa-calendar"></span></span>
                </div>
                {!! Form::text('dropoff',date("Y-m-d H:i:s"),['class'=>'form-control','required']) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('vehicle_id',__('fleet.selectVehicle'), ['class' => 'form-label']) !!}
              <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                <option value="">-</option>
                @foreach($vehicles as $vehicle)
                <option value="{{$vehicle->id}}" data-driver="{{$vehicle->driver_id}}">{{$vehicle->make_name}} -
                  {{$vehicle->model_name}} - {{$vehicle->license_plate}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('driver_id',__('fleet.selectDriver'), ['class' => 'form-label']) !!}

              <select id="driver_id" name="driver_id" class="form-control" required>
                <option value="">-</option>
                @foreach($drivers as $driver)
                <option value="{{$driver->id}}">{{$driver->name}} @if($driver->getMeta('is_active') != 1)
                  ( @lang('fleet.in_active') ) @endif</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('travellers',__('fleet.no_travellers'), ['class' => 'form-label']) !!}
              {!! Form::number('travellers',1,['class'=>'form-control','min'=>1]) !!}
            </div>
          </div>
        </div>
        @if(Auth::user()->user_type == "C")
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('d_pickup',__('fleet.pickup_addr'), ['class' => 'form-label']) !!}
              <select id="d_pickup" name="d_pickup" class="form-control">
                <option value="">-</option>
                @foreach($addresses as $address)
                <option value="{{$address->id}}" data-address="{{$address->address}}">{{$address->address}}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('d_dest',__('fleet.dropoff_addr'), ['class' => 'form-label']) !!}
              <select id="d_dest" name="d_dest" class="form-control">
                <option value="">-</option>
                @foreach($addresses as $address)
                <option value="{{$address->id}}" data-address="{{$address->address}}">{{$address->address}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        @endif
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('pickup_addr',__('fleet.pickup_addr'), ['class' => 'form-label']) !!}
              {!! Form::text('pickup_addr',null,['class'=>'form-control','required','style'=>'height:100px']) !!}
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('dest_addr',__('fleet.dropoff_addr'), ['class' => 'form-label']) !!}
              {!! Form::text('dest_addr',null,['class'=>'form-control','required','style'=>'height:100px']) !!}
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('note',__('fleet.note'), ['class' => 'form-label']) !!}
              {!!
              Form::textarea('note',null,['class'=>'form-control','placeholder'=>__('fleet.book_note'),'style'=>'height:100px'])
              !!}
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="form-group col-md-6">
            {!! Form::label('udf1',__('fleet.add_udf'), ['class' => 'col-xs-5 control-label']) !!}
            <div class="row">
              <div class="col-md-8">
                {!! Form::text('udf1', null,['class' => 'form-control']) !!}
              </div>
              <div class="col-md-4">
                <button type="button" class="btn btn-info add_udf"> @lang('fleet.add')</button>
              </div>
            </div>
          </div>
        </div>
        <div class="blank"></div>
        <div class="col-md-12">
          {!! Form::submit(__('fleet.save_booking'), ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">@lang('fleet.new_customer')</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      {!! Form::open(['route' => 'customers.ajax_store','method'=>'post','id'=>'create_customer_form']) !!}
      <div class="modal-body">
        <div class="alert alert-danger print-error-msg" style="display:none">
          <ul></ul>
        </div>
        <div class="form-group">
          {!! Form::label('first_name', __('fleet.firstname'), ['class' => 'form-label']) !!}
          {!! Form::text('first_name', null,['class' => 'form-control','required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('last_name', __('fleet.lastname'), ['class' => 'form-label']) !!}
          {!! Form::text('last_name', null,['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('gender', __('fleet.gender') , ['class' => 'form-label']) !!}<br>
          <input type="radio" name="gender" class="flat-red gender" value="1" checked> @lang('fleet.male')<br>

          <input type="radio" name="gender" class="flat-red gender" value="0"> @lang('fleet.female')
        </div>

        <div class="form-group">
          {!! Form::label('phone',__('fleet.phone'), ['class' => 'form-label']) !!}
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-phone"></i></span>
            </div>
            {!! Form::number('phone', null,['class' => 'form-control','required']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('email', __('fleet.email'), ['class' => 'form-label']) !!}
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            </div>
            {!! Form::email('email', null,['class' => 'form-control','required']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('address', __('fleet.address'), ['class' => 'form-label']) !!}
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-address-book-o"></i></span>
            </div>
            {!! Form::textarea('address', null,['class' => 'form-control','size'=>'30x2']) !!}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
        <button type="submit" class="btn btn-info">@lang('fleet.save_cust')</button>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>

@endsection

@section("script")
<script src="{{ asset('assets/js/moment.js') }}"></script>
<script src="{{ asset('assets/js/datetimepicker.js') }}"></script>
<script>
  $(function(){
   var from_date= $('#pickup').val();
   var to_date= $('#dropoff').val();
   var yes=true;
  //  alert(from_date);
    var id=$("input:hidden[name=id]").val();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "POST",
      url: "{{url('admin/get_driver')}}",
      data: "req="+yes+"&from_date="+from_date+"&to_date="+to_date,
      success: function(data2){
        $("#driver_id").empty();
        $("#driver_id").select2({placeholder: "@lang('fleet.selectDriver')",data:data2.data});
        // if(data2.show_error=="yes"){
        //   // alert("test");
        // $("#msg_driver").removeClass("hide").fadeIn(1000);
        // } else {
        // $("#msg_driver").addClass("hide").fadeIn(1000);
        // }
      },
      error: function(data){
      var errors = $.parseJSON(data.responseText);

        $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( errors, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });

      },
      dataType: "json"
    });
  });
</script>
<script type="text/javascript">
var today=$('#pickup').val();
// var today=new Date();
// console.log(today);
  $('#customer_id').select2({placeholder: "@lang('fleet.selectCustomer')"});
  $('#driver_id').select2({placeholder: "@lang('fleet.selectDriver')"});
  $('#vehicle_id').select2({placeholder: "@lang('fleet.selectVehicle')"});
  $('#pickup').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss',sideBySide: true,icons: {
              previous: 'fa fa-arrow-left',
              next: 'fa fa-arrow-right',
              up: "fa fa-arrow-up",
              down: "fa fa-arrow-down"
  },
  minDate:today
});

  $('#dropoff').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss',sideBySide: true,icons: {
              previous: 'fa fa-arrow-left',
              next: 'fa fa-arrow-right',
              up: "fa fa-arrow-up",
              down: "fa fa-arrow-down"
            },
            minDate:today,
            
  });

  $("#create_customer_form").on("submit",function(e){
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").hide();
    $.ajax({
      type: "POST",
      url: $(this).attr("action"),
      data: $(this).serialize(),
      success: function(data){
        var customers=  $.parseJSON(data);
        if(customers == 0){
          new PNotify({
            title: 'Failed!',
            text: "@lang('fleet.email_already_taken')",
            type: 'error'
          });
        }
        else{
          $('#customer_id').empty();
          $.each( customers, function( key, value ) {
            $('#customer_id').append($('<option>', {
              value: value.id,
              text: value.text
            }));
          });
          $('#exampleModal').modal('hide');

          new PNotify({
            title: 'Success!',
            text: '@lang("fleet.add_customer")',
            type: 'success'
          });
        }
      },
      error: function(data){
        var errors = $.parseJSON(data.responseText);
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( errors, function( key, value ) {
          $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
      },
      dataType: "html"
    });
    e.preventDefault();
  });

  function get_driver(from_date,to_date){
    $.ajax({
      type: "POST",
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      url: "{{url('admin/get_driver')}}",
      data: "req=new&from_date="+from_date+"&to_date="+to_date,
      success: function(data2){
        $("#driver_id").empty();
        $("#driver_id").select2({placeholder: "@lang('fleet.selectDriver')",data:data2.data});
      },
      dataType: "json"
    });
  }

  function get_vehicle(from_date,to_date){
    $.ajax({
      type: "POST",
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      url: "{{url('admin/get_vehicle')}}",
      data: "req=new&from_date="+from_date+"&to_date="+to_date,
      success: function(data2){
        $("#vehicle_id").empty();
        $("#vehicle_id").select2({placeholder: "@lang('fleet.selectVehicle')",data:data2.data});
      },
      dataType: "json"
    });
  }

  function prev_address(id){
    $.ajax({
      type: "POST",
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

      url: "{{url('admin/prev-address')}}",
      data: "id="+id,
      success: function(data){
        $("#pickup_addr").val(data.pickup_addr);
        $("#dest_addr").val(data.dest_addr);
        if(data.pickup_addr != ""){
          new PNotify({
            title: 'Success!',
            text: "@lang('fleet.prev_addr')",
            type: 'success'
          });
        }
      },
      dataType: "json"
    });
  }

  $(document).ready(function() {
    $("#customer_id").on("change",function(){
      var id=$(this).find(":selected").data("id");
      prev_address(id);
    });

    $("#d_pickup").on("change",function(){
      var address=$(this).find(":selected").data("address");
      $("#pickup_addr").val(address);
    });

    $("#d_dest").on("change",function(){
      var address=$(this).find(":selected").data("address");
      $("#dest_addr").val(address);
    });

    $("#pickup").on("dp.change", function (e) {
      var to_date=$('#dropoff').data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss");
      var from_date=e.date.format("YYYY-MM-DD HH:mm:ss");
      get_driver(from_date,to_date);
      get_vehicle(from_date,to_date);
      $('#dropoff').data("DateTimePicker").minDate(e.date);
    });

    $("#dropoff").on("dp.change", function (e) {
      $('#pickup').data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss")
      var from_date=$('#pickup').data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss");
      var to_date=e.date.format("YYYY-MM-DD HH:mm:ss");

      get_driver(from_date,to_date);
      get_vehicle(from_date,to_date);
    });

    $("#vehicle_id").on("change",function(){
      var driver = $(this).find(":selected").data("driver");
      $("#driver_id").val(driver).change();
    });
  });
</script>
<script type="text/javascript">
  $(".add_udf").click(function () {
    // alert($('#udf').val());
    var field = $('#udf1').val();
    if(field == "" || field == null){
      alert('Enter field name');
    }

    else{
      $(".blank").append('<div class="row"><div class="col-md-8">  <div class="form-group"> <label class="form-label">'+ field.toUpperCase() +'</label> <input type="text" name="udf['+ field +']" class="form-control" placeholder="Enter '+ field +'" required></div></div><div class="col-md-4"> <div class="form-group" style="margin-top: 30px"><button class="btn btn-danger" type="button" onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button> </div></div></div>');
      $('#udf1').val("");
    }
  });

  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  })
</script>
@if(Hyvikk::api('google_api') == "1")
<script>
  function initMap() {
    $('#pickup_addr').attr("placeholder","");
    $('#dest_addr').attr("placeholder","");
      // var input = document.getElementById('searchMapInput');
      var pickup_addr = document.getElementById('pickup_addr');
      new google.maps.places.Autocomplete(pickup_addr);

      var dest_addr = document.getElementById('dest_addr');
      new google.maps.places.Autocomplete(dest_addr);

      // autocomplete.addListener('place_changed', function() {
      //     var place = autocomplete.getPlace();
      //     document.getElementById('pickup_addr').innerHTML = place.formatted_address;
      // });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{Hyvikk::api('api_key')}}&libraries=places&callback=initMap"
  async defer></script>
@endif
@endsection
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <section class="hero-section--home">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="hero-content--home w-100 text-center mt-4">
                            <h5 class="light primary"><?php echo e(Hyvikk::frontend('contact_phone')); ?></h5>
                            <h1 class="mb-3"><?php echo app('translator')->get('frontend.reliable_way'); ?></h1>
                            <a href="#book_now"><button class="btn mx-auto form-submit-button"><?php echo app('translator')->get('frontend.book_now'); ?></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Ends hero section -->
        <!-- Booking section -->
        <section class="booking-section py-5 my-5 text-white" id="book_now">
            <h1 class="text-center"><?php echo app('translator')->get('frontend.book_a_cab'); ?></h1>
            <div class="container">
                <div class="row">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success col-sm-4 offset-sm-4">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger col-sm-4 offset-sm-4">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="col-sm-12 flex-col-center">
                        <form action="<?php echo e(url('book')); ?>" class="mt-4 w-100" method="POST" id="booking_form">
                            <?php echo csrf_field(); ?>

                            <div class="checkboxes flex-row-center">
                                <div class="pretty p-default p-round">
                                    <input type="radio" name="radio1" id="book-now" value="book_now" checked>
                                    <div class="state custom-state">
                                        <label><?php echo app('translator')->get('frontend.book_for_now'); ?></label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-round">
                                    <input type="radio" name="radio1" id="book-later" value="book_later" <?php echo e((old('radio1') == "book_later") ? "checked" : ""); ?>>
                                    <div class="state custom-state">
                                        <label><?php echo app('translator')->get('frontend.book_for_later'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-inputs mt-5 w-100">
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="" class="label-animate"><?php echo app('translator')->get('frontend.pickup_address'); ?></label>
                                            <input type="text" class="text-input" name="pickup_address" id="pickup_address" value="<?php echo e(old('pickup_address')); ?>" required>
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-pickup.png')); ?>" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="" class="label-animate"><?php echo app('translator')->get('frontend.dropoff_address'); ?></label>
                                            <input type="text" class="text-input" name="dropoff_address" id="dropoff_address" value="<?php echo e(old('dropoff_address')); ?>" required>
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-drop.png')); ?>" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="" class="label-animate"><?php echo app('translator')->get('frontend.no_of_person'); ?></label>
                                            <input type="number" class="text-input" name="no_of_person" value="<?php echo e(old('no_of_person')); ?>" min="1" required>
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-person.png')); ?>">
                                            </span>
                                        </div>
                                    </div>
                                    <!-- imaginery row 2 -->
                                    <div class="col-lg-6 col-md-6">
                                        <select class="form-group wide col-sm-12 text-input" name="vehicle_type" id="vehicle_type" required>
                                            <option value="" disabled selected><?php echo app('translator')->get('frontend.vehicle_type'); ?></option>
                                            <?php $__currentLoopData = $vehicle_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($type->id); ?>" <?php echo e(($type->id == old('vehicle_type')) ? "selected" : ""); ?>> <?php echo e($type->vehicletype); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 hide-book-later">
                                        <div class="form-group">
                                            <label for="" class="label-animate"><?php echo app('translator')->get('frontend.pickup_date'); ?></label>
                                            <input type="text" class="text-input" id="datepicker" name="pickup_date" value="<?php echo e(old('pickup_date')); ?>">
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-date.png')); ?>" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 hide-book-later">
                                        <div class="form-group">
                                            <label for="" id="timepicker_label" class="label-animate"><?php echo app('translator')->get('frontend.pickup_time'); ?></label>
                                            <input type="text" class="text-input" id="timepicker" name="pickup_time" value="<?php echo e(old('pickup_time')); ?>">
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-date.png')); ?>" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Row 2 ends -->
                                    <div class="col-sm-12 ">
                                        <div class="form-group">
                                            <textarea placeholder="<?php echo app('translator')->get('frontend.other_things'); ?>" cols="10" rows="1" class="text-input" name="note"><?php echo e(old('note')); ?></textarea>
                                        </div>
                                    </div>
                                    <?php ($methods = json_decode(Hyvikk::payment('method'))); ?>
                                    <?php if(Hyvikk::frontend('admin_approval')==0 && Hyvikk::api('api_key') != null): ?>
                                    <div class="col-lg-12">
                                        <div class="checkboxes flex-row-center">
                                            <label class="state custom-state"><?php echo app('translator')->get('frontend.select_payment_method'); ?>: &nbsp;</label>
                                            <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="pretty p-default p-round">
                                                <input type="radio" name="method" id="method" value="<?php echo e($method); ?>" <?php if($method == "cash"): ?> checked <?php endif; ?>>
                                                <div class="state custom-state">
                                                    <label><?php echo e($method); ?></label>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        
                                    </div> 
                                    <?php endif; ?>
                                    <button class="tab-button mx-auto mt-3" type="submit" id="booking"><?php echo app('translator')->get('frontend.book_now'); ?></button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Ends booking section -->
        <!-- Vechicles Section -->
        <!-- *Note* : there are two sliders one for vehicle details and one for vehicle images, they both are synchronized -->
        <section class="vehicle-section my-5">
            <!-- Section title -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center"><?php echo app('translator')->get('frontend.our_vehicle'); ?></h2>
                    </div>
                </div>
            </div>
            <!-- Ends Section title -->
            <div class="vehicle-details-container vehicle-details-slider">
                <!-- Vehicle detail Slides starts -->
                <!-- Slide -->
                <?php $__currentLoopData = $vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="vehicle-detail animated">
                    <div class="vehicle_name w-100"><?php echo e($v->year); ?> <?php echo e($v->make_name); ?> <?php echo e($v->model_name); ?></div>
                    <div class="vehicle_details">
                        <div class="passengers"> <?php echo e($v->types->seats); ?> Passengers </div>
                        <div class="vehicle-class">
                            <img src="<?php echo e(asset('assets/frontend/icons/fleet-luxurious.png')); ?>" alt="">
                        </div>
                        <div class="vehicle-data"><?php echo e($v->average); ?>/100 MPG</div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- Slide -->
                <!-- Vehicle image Slides ends -->
            </div>
            <div class="vehicle-container mt-5">
                <div class="row vehicle-slider">
                    <!-- Vehicle image Slides starts -->
                    <?php $__currentLoopData = $vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-4">
                        <?php if($v->vehicle_image): ?>
                            <img src="<?php echo e(url('uploads/' . $v->vehicle_image)); ?>" alt="Vehicle Image" class="img-fluid">
                        <?php else: ?> 
                            <img src="<?php echo e(asset("assets/images/vehicle.jpeg")); ?>" alt="Vehicle Image" class="img-fluid" style="width:200;height:auto;">
                        <?php endif; ?>  
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- Vehicle image Slides ends -->
                </div>
            </div>
            <!-- Slide dots and current / total slides -->
            <div class="custom-controls-container">
                <h6 class="js-vehicle-slide-current"> 1 </h6>
                <div class="custom-dots">
                    <!-- Dots will be automatically appended here by js -->
                </div>
                <h6 class="js-vehicle-slide-total"><?php echo e($vehicle->count()); ?></h6>
            </div>
        </section>
        <!-- Ends vehicles section -->
        <!-- Services section -->
        <section class="my-5 relative">
            <!-- Section title -->
            <div class="container my-5">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center"><?php echo app('translator')->get('frontend.our_service'); ?></h2>
                    </div>
                </div>
            </div>
            <!-- Ends Section title -->
            <div class="container my-0 my-lg-5">
                <div class="row js-service-slider">
                    <?php $__currentLoopData = $company_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6 py-5 ">
                        <div class="row w-100 m-0 p-0">
                            <div class="col-sm-4">
                                <div class="service-round-element">
                                    <?php if($service->image != null): ?>
                                        <img src="<?php echo e(url('uploads/' . $service->image)); ?>" alt="Service Image">
                                    <?php else: ?>
                                        <img src="" alt="Service Image">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <h6><?php echo e($service->title); ?></h6>
                                <p class="mt-3"><?php echo e($service->description); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <!-- Slider arrows -->
            <div class="service-slide-prev">
                <img src="<?php echo e(asset('assets/frontend/icons/fleet-arrow-left.png')); ?>" alt="">
            </div>
            <div class="service-slide-next">
                <img src="<?php echo e(asset('assets/frontend/icons/fleet-arrow-right.png')); ?>" alt="">
            </div>
        </section>
        <!-- Ends services section -->
        <!-- Testimonial section -->
        <section class="pb-5 pt-0">
            <div class="container text-center no-padding-mobile relative">
                <!-- Section title -->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="text-center"><?php echo app('translator')->get('frontend.testimonials'); ?></h2>
                        </div>
                    </div>
                </div>
                <!-- Ends Section title -->
                <div class="js-testimonial-slider">
                    <!-- Slide -->
                    <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12">
                        <div class="row mt-5">
                            <div class="col-lg-4 flex-col-center">
                                <div class="testimonial-image-block">
                                    <div class="shadow-overlay"></div>
                                    <?php if($t->image != null): ?>
                                        <img src="<?php echo e(url('uploads/' . $t->image)); ?>" alt="Testimonial Image" class="testimonial-image">
                                    <?php else: ?> 
                                        <img src="<?php echo e(url('assets/images/no-user.jpg')); ?>" alt="Testimonial Image" class="testimonial-image">
                                    <?php endif; ?>
                                    <div class="quote-round">
                                        <img src="<?php echo e(asset('assets/frontend/icons/fleet-quote.png')); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 d-flex flex-column align-items-center">
                                <div class="testimonial-content w-100 text-center text-lg-left">
                                    <?php echo e($t->details); ?>

                                    <br><br>
                                    <i> - <?php echo e($t->name); ?></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- Slide -->
                    <!-- Slides end -->
                </div>
                <div class="testimonial-dots mx-auto">
                </div>
            </div>
        </section>
        <!-- Ends wrapper  -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function () {
    $('input:radio[name=radio1]').change(function () {
        if ($("input[name='radio1']:checked").val() == 'book_later') {
            $("#datepicker").attr('required', 'required');
            $("#datepicker").attr('readonly', false);
            $("#timepicker").attr('required', 'required');
            $("#timepicker").attr('readonly', false);
        }
    });
});
</script>

<?php if(Hyvikk::api('google_api') == "1"): ?>
  <script>
  function initMap() {
    $('#pickup_address').attr("placeholder","");
    $('#dropoff_address').attr("placeholder","");
      // var input = document.getElementById('searchMapInput');
      var pickup_addr = document.getElementById('pickup_address');
      new google.maps.places.Autocomplete(pickup_addr);

      var dest_addr = document.getElementById('dropoff_address');
      new google.maps.places.Autocomplete(dest_addr);

      // autocomplete.addListener('place_changed', function() {
      //     var place = autocomplete.getPlace();
      //     document.getElementById('pickup_addr').innerHTML = place.formatted_address;
      // });
  }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(Hyvikk::api('api_key')); ?>&libraries=places&callback=initMap" async defer></script>
<?php endif; ?>

<script>
    $(function(){
        

        $("#datepicker").flatpickr({
            disableMobile: "true"
        });
        $("#timepicker").flatpickr({
            enableTime: true,
            noCalendar: true,    
            dateFormat: "H:i",
            disableMobile: "true",
            
        });
        $('#timepicker').on('change click ',function(){
        //    alert('test');
           
            $('#timepicker_label').addClass('label-top');
            $('#timepicker_label').addClass('stay');
            $('#timepicker').addClass('active');
            console.log('done');
        });
        
    });
    window.setTimeout(function () { 
         $(".alert-danger").alert('close'); 
    }, 5000);

    if ($(location).attr('href').split('/')[4] == "#register")
    {
        $('#login-modal').addClass('active'); 
    }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/frontend/home.blade.php ENDPATH**/ ?>
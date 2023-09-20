@component('mail::message')
# {{$title}} Reminder

{{-- Dear {{$title}}, --}}

{{-- {!! Hyvikk::email_msg('service_reminder') !!} --}}
Reminder Details:
	@php($title=(isset($reminder->preventive_maintenance->vehicle)? $reminder->preventive_maintenance->vehicle->vehicleData->make.' ':'').$reminder->preventive_maintenance->vehicle->vehicleData->model.' '.$reminder->preventive_maintenance->vehicle->license_plate)
	@php($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y')

	Fleet: {{$title}}
	Service: {{$reminder->preventive_maintenance->services->description}}
	Current meter: {{$reminder->preventive_maintenance->vehicle->int_mileage}} kms
	Planned: {{$reminder->preventive_maintenance->next_planned}} kms
	Last service: {{$reminder->preventive_maintenance->last_performed}} kms

Thanks,<br>
{{ config('app.name') }}
@endcomponent

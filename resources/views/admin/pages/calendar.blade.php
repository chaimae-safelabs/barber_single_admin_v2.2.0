@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
'title' => __('Calendar'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--6 mb-5">
    <div class="row">
        <div class="col">
            <div class="card px-4 pb-4">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{__('Calendar')}}</span>
                    <div class="">
                        <button class="btn btn-primary rtl-mr addbtn float-right p-2 add_user" id="add_user"><i
                                class="fas fa-plus mr-1"></i>{{__('Add New Client')}}</button>
                    </div>
                    <div>
                        <button class="btn btn-primary addbtn float-right p-2 add_appointment mr-3"
                            id="add_appointment"><i class="fas fa-plus mr-1"></i>{{__('Add Appointment')}}</button>
                    </div>
                </div>
                <div class="row statusRow text-center ml-1">
                    <div class="col completedBox p-1 mr-3 rounded"><span>{{__('Completed')}}</span></div>
                    <div class="col pendingBox p-1 mr-3 rounded"><span>{{__('Pending')}}</span></div>
                    <div class="col approvedBox p-1 mr-3 rounded"><span>{{__('Approved')}}</span></div>
                    <div class="col cancelBox p-1 mr-3 rounded"><span>{{__('Cancelled')}}</span></div>
                </div>
                <div class="mt-3">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      
      initialView: 'dayGridMonth',
      events : [
      @foreach($appointments as $appointment)
      {
        title : '{{ $appointment->user->name }}',
        start : '{{ $appointment->start }}',
        color : '{{ $appointment->textColor }}',
        eventColor : '{{ $appointment->bgColor }}'
      },
      @endforeach
      ],

    });
    calendar.render();
  });

</script>

@include('admin.booking.create')
@include('admin.booking.show')
@include('admin.users.create')


@endsection
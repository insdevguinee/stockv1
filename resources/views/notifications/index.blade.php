@extends('layouts.app')
@section('title')
Notifications
@endsection


@section('contents')
    <div class="row">

      <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
        <div class="widget">
          <div class="widget-header transparent">
                <h2><strong>Notifications</strong></h2>

              </div>
          <div class="widget-content padding">
            <ul class="list-group" style="height: 400px; overflow-y: scroll;">
              @foreach(Auth::user()->notifications as $notif)
              <li class="list-group-item" style="background-color:  {{ ($notif->read)?"#b3b3b3":"#fff" }}">
                <a href="{{ route('notifications.show',$notif->id) }}">
                  {{ $notif->text }}
                </a>
                <small> Le {{explode('00:00',\Carbon\Carbon::parse($notif->created_at,'UTC')->locale('fr_FR')->isoFormat('LLLL'))[0]}}</small>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>


@endsection
@section('scripts')
  <!-- Page Specific JS Libraries -->
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/datatables.js') }}"></script>
  <script>
       $('#active-notif').addClass('active');
</script>
@endsection

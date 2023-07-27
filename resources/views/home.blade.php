@extends('layouts.app')
@section('title')
Tableau de bord
@endsection
@section('contents')
<div class="row">

<div class="col-md-9">
	
</div>
<div class="col-md-3">
	Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate eius, sed dolores odit ipsa, aliquid excepturi quas eos dignissimos! Praesentium illum nihil architecto cum itaque saepe minus consectetur id provident.
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
       $('#active-tb').addClass('active');
</script>
@endsection

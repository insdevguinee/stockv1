@extends('personnels.profil._body')

@section('title')
  Documents
@endsection
@section('contents')

<!-- Modal -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default  widget">
            <div class="widget-header">
                <h2 class="text-center"><strong>Liste des documents</strong></h2>
              </div>
            <div class="panel-body">
                  <div class="table-responsive">
                    <table  id="datatables-1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Ajouter le</th>
                                <th>Telecharger</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->personnel->documents as $document)
                            <tr>
                                <td scope="row">{{$document->name}}</td>
                                <td>{{$document->desciption}}</td>
                                <td>{{$document->updated_at}}</td>
                                <td> 
                                    <a target="_blank" href="{{asset('storage/docs/'.$document->fichier)}}">Afficher</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
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
       $('#active-documents').addClass('active');
</script>
@endsection
@extends('layouts.app')

@section('title')
  Fiche Evaluative
@endsection
@section('contents')
<style>
    .mati,.mat,.matt{
        position: relative;
    }
</style>
      <div class="row">
        <div class="col-md-8 col-md-offset-2 portlets ui-sortable">
            <div class="widget  panel panel-default">
                 <div class="widget-header text-center">
                   <h4> Création Fiche Accompagne</h4>
                 </div>
            	<div class="panel-body">
                    <form action="{{route('fiches.store')}}" method="POST" role="form">
                    @csrf
                    <h3>Information Fiche</h3>
                        <div class="form-group col-md-3 @if($errors->has('year')) has-error @endif">
                        <label for="year">Année</label>
                        <input type="integer" class="form-control" name="year">
                        </div>
                        <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
                        <label for="name">Nom fiche</label>
                        <input type="text" class="form-control" name ="name" placeholder="Fiche Evaluative">
                        </div>
                        <div class="form-group col-md-3 @if($errors->has('notation')) has-error @endif">
                        <label for="notation">Notation</label>
                        <input type="integer" class="form-control" name ="notation" placeholder="Fiche Evaluative">
                        </div>

                      <h3 class="mb-4">Evaluateurs</h3>
                        <div id="evaluateurs">
                            <div class="mat">
                                <div class="form-group col-md-9 @if($errors->has('user_id')) has-error @endif">
                                <label for="user_id">Evaluateur </label>
                                <select class="form-control" name="user_id[]" id="">
                                    <option></option>
                                    @foreach ($evaluateurs as $evaluateur)
                                    <option value="{{$evaluateur->id}}">{{$evaluateur->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group col-md-3 @if($errors->has('ponderation')) has-error @endif">
                                <label for="ponderation">ponderation</label>
                                <input type="integer" class="form-control" name ="ponderation[]">
                                </div>
                            </div>
                        </div>
                            <p class="text-center">
                                <a href="#end" id="addLine" class="add btn btn-xs btn-info">
                                <span class="fa fa-plus-square-o"></span> Ajouter un ligne</a>
                            </p>

                    <h3> Individuel </h3>
                    <div id="individuel">
                        <div class="mati">
                            <div class="form-group">
                            <label for="cname">Critère</label>
                            <input type="text" class="form-control" name="i-cname[]" >
                            </div>
                        </div>
                    </div>

                         <p class="text-center">
                                <a href="#end" id="addLineI" class="add btn btn-xs btn-info">
                                <span class="fa fa-plus-square-o"></span> Ajouter un ligne</a>
                            </p>
                    <h3> Technique </h3>
                         <div id="technique">
                            <div class="matt">
                              <div class="form-group @if($errors->has('cname')) has-error @endif">
                              <label for="cname">Critère</label>
                              <input type="text" class="form-control" name="t-cname[]" >
                              </div>
                            </div>
                         </div>

                         <p class="text-center">
                                <a href="#end" id="addLineT" class="add btn btn-xs btn-info">
                                <span class="fa fa-plus-square-o"></span> Ajouter un ligne</a>
                            </p>
                    <h3> Groupe </h3>
                          <div id="groupe">
                            <div class="matg">
                              <div class="form-group @if($errors->has('cname')) has-error @endif">
                                <label for="cname">Critère</label>
                                <input type="text" class="form-control" name="g-cname[]" >
                                </div>

                            </div>
                          </div>
                         <p class="text-center">
                                <a href="#groupe" id="addLineG" class="add btn btn-xs btn-info">
                                <span class="fa fa-plus-square-o"></span> Ajouter un ligne</a>
                            </p>

                        <div class="clearfixe"></div>
                         <button type="submit" class="btn btn-success pull-left">Enregistrer</button>
                </form>
                </div>
              </div>
        </div>
      </div>

@endsection
@section('scripts')

  <script>
    $('#addLine').click(function(event) {

        var code = ' <div class="mat"> <div class="form-group col-md-9 @if($errors->has("user_id")) has-error @endif"> <select class="form-control" name="user_id[]" id=""> <option></option> @foreach ($evaluateurs as $evaluateur) <option value="{{$evaluateur->id}}">{{$evaluateur->name}}</option> @endforeach </select> </div> <div class="form-group col-md-3 @if($errors->has("ponderation")) has-error @endif"> <input type="integer" class="form-control" name ="ponderation[]"> </div> <span class="btn btn-xs btn-info remove btn-danger"><i class="fa fa-remove"></i></span></div>';

          $('#evaluateurs').append("<div class='mat'>"+code+"</div>");
            $('select').select2({
              placeholder: "Search for a repository",
            });
          $('.remove').click(function(event) {
            $(this).parent('.mat').remove();
          });
        });
        // Individuel
        $('#addLineI').click(function(event) {

        var code = '<div class="mati"> <div class="form-group"> <input type="text" class="form-control" name="i-cname[]" > </div> <span class="btn btn-xs btn-info remove btn-danger"><i class="fa fa-remove"></i></span></div>';

          $('#individuel').append("<div class='mati'>"+code+"</div>");
          $('.remove').click(function(event) {
            $(this).parent('.mati').remove();
          });
        });

        // Technique
        $('#addLineT').click(function(event) {

        var code = '<div class="matt"> <div class="form-group"> <input type="text" class="form-control" name="t-cname[]" > </div> <span class="btn btn-xs btn-info remove btn-danger"><i class="fa fa-remove"></i></span></div>';

          $('#technique').append("<div class='matt'>"+code+"</div>");
          $('.remove').click(function(event) {
            $(this).parent('.matt').remove();
          });
        });

        // Groupe
        $('#addLineG').click(function(event) {

        var code = '<div class="matg"> <div class="form-group"> <input type="text" class="form-control" name="g-cname[]" > </div> <span class="btn btn-xs btn-info remove btn-danger"><i class="fa fa-remove"></i></span></div>';

          $('#groupe').append("<div class='matt'>"+code+"</div>");
          $('.remove').click(function(event) {
            $(this).parent('.matg').remove();
          });
        });




       $('#active-fiches').addClass('active');
</script>
@endsection

@extends('layouts.app')
@section('title')
Paramètre Application
@endsection


@section('contents')
    <div class="row">

      <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
        <div class="widget">
          <div class="widget-header transparent">
                <h2><strong>Configuration</strong> application</h2>

              </div>
          <div class="widget-content padding">
              {{ Form::model($setting, ['route' => array('settings.update', $setting->id), 'method' => 'PUT','style'=>'width:100%;display:contents !important', 'enctype'=>"multipart/form-data",'autocomplete'=>'off']) }}
                <div class="form-group @if($errors->has('logo')) has-error @endif">
                    <label for="logo">Logo App</label>
                    <input type="file" class="form-control" name="logo" value="{{ $setting->logo }}" placeholder="logo">
                    @if($errors->has('logo')) <div class="help-block">
                       {{ $errors->first('logo') }}
                    </div>
                  @endif
                  </div>
                  <div class="form-group @if($errors->has('prefix')) has-error @endif">
                    <label for="prefix">Prefix Connexion <small><i>Ex :OFIX/username </i></small></label>
                    <input type="number" class="form-control" name="prefix" value="{{ $setting->prefix }}" data-mask="0" placeholder="OFIX">
                    @if($errors->has('prefix')) <div class="help-block">
                       {{ $errors->first('prefix') }}
                    </div>
                  @endif
                  </div>
                  <hr>
                 <div class="form-group @if($errors->has('notifnumb')) has-error @endif">
                    <label for="notifnumb">Qte minimum notification</label>
                    <input type="number" class="form-control" name="notifnumb" value="{{ $setting->notifnumb }}" data-mask="0" placeholder="10" min="10">
                    @if($errors->has('notifnumb')) <div class="help-block">
                       {{ $errors->first('notifnumb') }}
                    </div>
                  @endif
                  </div>
                  <div class="form-group @if($errors->has('email')) has-error @endif">
                    <label for="email">Email notification</label>
                    <input type="email" class="form-control" name="email" value="{{ $setting->email }}">
                    @if($errors->has('email')) <div class="help-block">
                       {{ $errors->first('email') }}
                    </div>
                  @endif
                  </div>
                  <div class="form-group @if($errors->has('email2')) has-error @endif">
                    <label for="email2">Email 2 notification</label>
                    <input type="email" class="form-control" name="email2" value="{{ $setting->email2 }}" placeholder="email">
                    @if($errors->has('email2')) <div class="help-block">
                       {{ $errors->first('email2') }}
                    </div>
                  @endif
                  </div>
                    <button type="submit" class="btn btn-default">Modifier</button>
              </form>
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
       $('#active-apps').addClass('active');
</script>
@endsection

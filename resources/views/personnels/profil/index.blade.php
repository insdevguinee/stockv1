@extends('personnels.profil._body')

@section('title')
  Mon Profil
@endsection
@section('contents')
<div class="row">
    @include('personnels.profil.partials._personnelshow',['personnel'=>$personnel])
</div>
@endsection


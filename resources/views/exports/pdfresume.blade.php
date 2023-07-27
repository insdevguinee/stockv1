@php
  $mois = (isset($_GET['mois'])) ? $_GET['mois'] : date('m');
  $minStock = \App\Setting::findOrFail(1)->notifnumb;
  $cat = $getDate['cat'];
  $min = $getDate['min'];
  $max = $getDate['max'];
@endphp

<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="{{ URL::to('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
		<title>Rapport {{ $min.' au '.$max }}</title>
    <style>
      body{
        background: #fff;
      }
      .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .middle {
          vertical-align: middle;
          text-align: center;
      }
      .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
        padding: 5px;
      }
      .table {
        margin-bottom: 0px;
      }
    </style>
	</head>
	<body>
    <div id="content">
		<div class="row">
			<div class="col-md-6 float-left">
				<img src="{{ URL::to('assets/img/logo_socoexim.png')}}" style="height: 70px;" alt="Logo"> <br>
        <strong>CHANTIER : {{ \App\Chantier::findOrFail(session('chantier'))->name }}</strong>
			</div>
      <div class="col-md-6 float-right text-right">
        Date : {{ $min.' au '.$max }}
      </div>
		</div>

      @if($rapport)
        @foreach(\App\Categorie::orderBy('name')->get() as $categorie)

  		    @include('partials.rapportPdfexport',['categorie'=>$categorie])

        @endforeach
      @else
        @include('partials.rapportPdfexport',['categorie'=>$categorie])
      @endif
       

      {{-- <a href="javascript:demoFromHTML()" class="btn btn-default">Run Code</a> --}}
      </div>
      {{-- <button type="button" onclick="printJS('content', 'html')">
          Telecharger
       </button> --}}
	</body>
</html>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
 <script>
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#content')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }, margins
        );
    }
</script> --}}
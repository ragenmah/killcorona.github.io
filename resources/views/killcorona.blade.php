<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kill Corona</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body>

    {{-- @foreach ($json as $p)
    {{     $p['Countries']}}
  @endforeach --}}
  <div>
    <select class="form-control m-bot15" id="countryNameid" placeholder="Pick a Country..."name="countryName">
        @if(count($json['Countries']) > 0)
        @for($i=0;$i<count($json['Countries']);$i++)
        {{-- <option value="{{$json['Countries'][$i]['Country']}}">{{$json['Countries'][$i]['Country']}}</option> --}}
        <option value="{{$i}}" name="{{$json['Countries'][$i]['Country']}}">{{$json['Countries'][$i]['Country']}}</option>

        @endfor
       @else
        No Record Found
         @endif
     </select>

     <div class ="show-selected-details">
<h1></h1>
     </div>
      <h1>CURRENT GLOBAL DATA</h1>
      <h3>New Confirmed : {{$json['Global']['NewConfirmed']}}</h3>

      <h3>Total Confirmed : {{$json['Global']['TotalConfirmed']}}</h3>
      <h3>New Deaths : {{$json['Global']['NewDeaths']}}</h3>
      <h3>Total Deaths : {{$json['Global']['TotalDeaths']}}</h3>
      <h3>New Recovered : {{$json['Global']['NewRecovered']}}</h3>
      <h3> Total Recovered : {{$json['Global']['TotalRecovered']}}</h3>


  </div>
  <div class="container-fluid">

    <table class="table table-dark table-hover">
      <thead>
        <tr>
          <th>Country</th>
          <th>CountryCode</th>
          <th>Slug</th>
          <th>NewConfirmed</th>
          <th>TotalConfirmed</th>
          <th>NewDeaths</th>
          <th>TotalDeaths</th>
          <th>NewRecovered</th>
          <th>TotalRecovered</th>
          <th>Date time</th>

        </tr>
      </thead>
      <tbody>

        @for($i=0;$i<count($json['Countries']);$i++)
        <tr>
        <td>{{$json['Countries'][$i]['Country']}}</td>
        <td>{{$json['Countries'][$i]['CountryCode']}}</td>
        <td>{{$json['Countries'][$i]['Slug']}}</td>
        <td>{{$json['Countries'][$i]['NewConfirmed']}}</td>
        <td>{{$json['Countries'][$i]['TotalConfirmed']}}</td>
        <td>{{$json['Countries'][$i]['NewDeaths']}}</td>
        <td>{{$json['Countries'][$i]['TotalDeaths']}}</td>
        <td>{{$json['Countries'][$i]['NewRecovered']}}</td>
        <td>{{$json['Countries'][$i]['TotalRecovered']}}</td>
        <td>{{$json['Countries'][$i]['Date']}}</td>
        {{-- <td>{{ $json['Countries'][$i]['Date']->format('Y-m-d')}}</td> --}}

    </tr>
      @endfor


      </tbody>
    </table>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $("select").select2();

        $('#countryNameid').on('change',function(e){
      console.log(e);

     // var countryName=e.target.value;

     var countryNumber=e.target.value;
    //   alert(countryNumber);
// var countryName=document.getElementById("countryNameid").options[];
// alert(countryName);
var selectedCountry = $(this).children("option:selected").text();
        // alert("You have selected the country - " + selectedCountry);
      if(countryNumber>=0){
        fetchRecords(countryNumber,selectedCountry);
      }


    });
    // alert($json['Countries'][countryNumber]['NewConfirmed']);
    // // ajax
    // $.get('https://api.covid19api.com/summary',function(data,status){

    //         // alert(index+' '+status);
    //         // alert(countryName);

    //         alert(countryNumber);
    //         var divValue="<h1>CURRENT GLOBAL DATA</h1>"+
    //         "<h3>New Confirmed : +"{{$json['Countries'][1]['NewConfirmed']}}+"</h3>"+
    //         "<h3>Total Confirmed :+" {{$json['Countries'][1]['TotalConfirmed']}}+"</h3>"+
    //         " <h3>New Deaths :+" {{$json['Countries'][1]['NewDeaths']}}+"</h3>"+
    //         " <h3>Total Deaths : +"{{$json['Countries'][1]['TotalDeaths']}}+"</h3>"+
    //         "<h3>New Recovered :+" {{$json['Countries'][1]['NewRecovered']}}+"</h3>"+
    //         "<h3> Total Recovered :+" {{$json['Countries'][1]['TotalRecovered']}}+"</h3>";
    //         alert(divValue);
    //         $("#show-selected-details").append(divValue);

    //  })


  function fetchRecords(id,selectedCountry){
       $.ajax({
         url: 'https://api.covid19api.com/summary',
         type: 'get',
         dataType: 'json',
         success: function(response){
            //  console.log(response['Countries'][id]['NewConfirmed']);
            $(".show-selected-details").empty();
            var NewConfirmed=response['Countries'][id]['NewConfirmed'];
         var divValue="<h1>CURRENT GLOBAL DATA OF "+selectedCountry+"</h1>"+
            "<h3>New Confirmed : "+NewConfirmed +"</h3>"+
            "<h3>Total Confirmed :"+ response['Countries'][id]['TotalConfirmed']+"</h3>"+
            " <h3>New Deaths :"+ response['Countries'][id]['NewDeaths']+"</h3>"+
            " <h3>Total Deaths : "+response['Countries'][id]['TotalDeaths']+"</h3>"+
            "<h3>New Recovered :" +response['Countries'][id]['NewRecovered']+"</h3>"+
            "<h3> Total Recovered :"+ response['Countries'][id]['TotalRecovered']+"</h3>";
           // alert(NewConfirmed);
            $(".show-selected-details").append(divValue);
         }});
  }
    });

</script>
</body>
</html>


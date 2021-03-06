@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
               <div class="col-md-4">Project Details</div>
               <div class="pull-center col-md-4"><center>Project Id {{ $details->project_id }}</center></div>
               <div class="pull-right col-md-4">
                <a href="{{ URL::to('/') }}/ameditProject?projectId={{ $details->project_id }}" class="btn btn-warning btn-sm pull-right">Edit</a>
               </div>
              <br>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-striped table-hover">
                    <tbody>
                        <tr>
                            <td style="width:40%"><b>Listed On : </b></td>
                            
                            <td>{{ date('d-m-Y h:i:s A',strtotime($details->created_at)) }}</td>
                        </tr>
                       
                         @if(Auth::check())
                        @if(Auth::user()->department_id != 2)
                        <tr>
                            <td><b>Listed By : </b></td>
                            <td>
                                {{ $listedby != null ? $listedby->name : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width:40%"><b>Call Attended By : </b></td>
                            <td>{{ $callAttendedBy != null ? $callAttendedBy->name: '' }}</td>
                        </tr>
                        @endif
                        @endif
                        <tr>
                            <td style="width:40%"><b>Updated On : </b></td>
                            <td>{{ date('d-m-Y h:i:s A',strtotime($details->updated_at)) }}</td>
                        </tr>
                        
                        <tr>
                            <td><b>Project Name : </b></td>
                            <td>{{ $details->project_name }}</td>
                        </tr>
                        <tr>
                            <td><b>Road Name/Road No./Landmark : <b></td>
                            <td>{{ $details->road_name }}</td>
                        </tr>
                        <tr>
                            <td><b>Road Width : <b></td>
                            <td>{{ $details->road_width}}</td>
                        </tr>
                       <tr>
                            <td><b>Address : </b></td>
                            <td>
                                <a target="_blank" href="https://maps.google.com?q={{$details->siteaddress != null ? $details->siteaddress->address : ''}}">{{$details->siteaddress != null ? $details->siteaddress->address : ''}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Construction Type : </b></td>
                            <td>{{ $details->construction_type }}</td>
                        </tr>
                        <tr>
                            <td><b>Interested in RMC ? : </b></td>
                            <td>{{ $details->interested_in_rmc }}</td>
                        </tr>
                         <tr>
                            <td><b>Interested in UPVC Doors and Windows ? : </b></td>
                            <td>{{ $details->interested_in_doorsandwindows }}</td>
                        </tr>
                         <tr>
                            <td><b>Interested in Home Automation ? : </b></td>
                            <td>{{ $details->automation }}</td>
                        </tr>
                         <tr>
                            <td><b>Interested in Premium Products ? : </b></td>
                            <td>{{ $details->interested_in_premium }}</td>
                        </tr>
                        <tr>
                            <td><b>Type of Contract : </b></td>
                            <td>
                                @if($details->contract == "With Material Contractor")
                                    Material Contract
                                @elseif($details->contract == "With Labour Contractor")
                                    Labour Contract
                                @else
                                    {{ $details->contract }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width:40%"><b>Sub-ward : </b></td>
                            <td>{{ $subward }}</td>
                        </tr>
                        <tr>
                            @if($details->municipality_approval == "N/A")
                            <td><b>Govt. Approvals(Municipal, BBMP, etc) : </b></td>
                            <td>None</td>
                            @else
                            <td><b>Govt. Approvals(Municipal, BBMP, etc) : </b></td>
                            <td><img height="350" width="350"  src="{{ URL::to('/') }}/public/projectImages/{{ $details->municipality_approval }}" class="img img-thumbnail"></td>
                            @endif
                        </tr>
                         <tr>
                            <td><b>Project Status : </b></td>
                            <td>{{ $details->project_status }}</td>
                        </tr>
                        <tr>
                            <td><b>Project Type : </b></td>
                            <td>B{{ $details->basement }} + G + {{ $details->ground }} = {{ $details->basement + $details->ground + 1 }}</td>
                        </tr>
                         <tr>
                            <td><b>Project Size : </b></td>
                            <td>{{ $details->project_size }}</td>
                        </tr>
                        <tr>
                            <td><b>Plot Size : </b></td>
                            <td>L({{ $details->length }}) * B ({{ $details->breadth }}) = {{ $details->plotsize }}</td>
                        </tr>
                       <tr> 
                            <td><b>Budget (Cr.) : </b></td>
                            <td>
                                {{ $details->budget }} Cr.              [  {{  $details->budgetType   }}  ]
                            </td>
                        </tr>
                        <tr>
                                <td style="width:40%;"><b>Budget (per sq.ft) :</b></td>
                                <td>
                                    @if($details->project_size != 0)
                                        {{ round((10000000 * $details->budget)/$details->project_size,3) }}
                                    @endif
                                </td>
                        </tr>
                        <tr>
                            <td><b>Project Image : </b></td>
                            <td>
                               <?php
                                               $images = explode(",", $details->image);
                                               ?>
                                             <div class="row">
                                                 @for($i = 0; $i < count($images); $i++)
                                                     <div class="col-md-3">
                                                          <img height="350" width="350"  src="{{ URL::to('/') }}/public/projectImages/{{ $images[$i] }}" class="img img-thumbnail">
                                                     </div>
                                                 @endfor
                                              </div>
                            </td>
                            </td>
                        </tr>



                        <tr>
                            <td style="width:40%"><b>Followup Started : </b></td>
                            <td>{{ $details->followup }} @if($followupby) (marked by {{ $followupby->name }}) @endif</td>
                        </tr>
                        <tr>
                            <td><b>Remarks : </b></td>
                            <td>
                                {{ $details->remarks }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 
<div class="col-md-12">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default" style="border-color:orange">
            <div class="panel-heading" style="background-color:orange">
               <b style="color:white">Room Types</b> 
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <th>Floor No.</th>
                        <th>Room Type</th>
                        <th>No. Of House</th>
                    </thead>
                    <tbody>
                        @foreach($roomtypes as $roomtype)
                        <tr>
                            <td>{{ $roomtype->floor_no }}</td>
                            <td>{{ $roomtype->room_type }}</td>
                            <td>{{ $roomtype->no_of_rooms }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>        
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default" style="border-color:green">
            <div class="panel-heading" style="background-color:green">
               <b style="color:white">Owner Details</b> 
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <th>Owner Name</th>
                        <th>Owner Contact</th>
                        <th>Owner Email</th>
                    </thead>
                    <tbody>
                        <tr>
                             <td>{{ $details->ownerdetails != null ? $details->ownerdetails->owner_name : '' }}</td>
                              <td>{{ $details->ownerdetails != null ? $details->ownerdetails->owner_contact_no : '' }}</td>
                           <td>{{ $details->ownerdetails != null ? $details->ownerdetails->owner_email : '' }}</td>
                           
                        </tr>
                    </tbody>
                </table>        
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default" style="border-color:orange">
            <div class="panel-heading" style="background-color:orange">
               <b style="color:white">Contractor Details</b> 
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <th>Contractor Name</th>
                         <th>Contractor Contact</th>
                         <th>Contractor Email</th>
                    </thead>    
                    <tbody>
                        <tr>
                            <td>{{ $details->contractordetails != null ? $details->contractordetails->contractor_name : '' }}</td>
                            <td>{{ $details->contractordetails != null ? $details->contractordetails->contractor_contact_no : '' }}</td>
                            <td>{{ $details->contractordetails != null ? $details->contractordetails->contractor_email : '' }}</td>
                        </tr>
                    </tbody>
                </table>        
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default" style="border-color:green">
            <div class="panel-heading" style="background-color:green">
               <b style="color:white">Constultant Details</b> 
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <th>Constultant Name</th>
                       <th>Constultant Contact</th>
                       <th>Constultant Email</th>
                    </thead>    
                    <tbody>
                        <tr>
                            <td>{{ $details->consultantdetails != null ? $details->consultantdetails->     consultant_name : '' }}</td>
                              <td>{{ $details->consultantdetails != null ? $details->consultantdetails->consultant_contact_no : '' }}</td>
                            <td>{{ $details->consultantdetails != null ? $details->consultantdetails->consultant_email : '' }}</td>
                        </tr>
                    </tbody>
                </table>        
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default" style="border-color:orange">
            <div class="panel-heading" style="background-color:orange">
               <b style="color:white">Site Engineer Details</b> 
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <th>Site Engineer Name</th>
                        <th>Site Engineer Contact</th>
                        <th>Site Engineer Email</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $details->siteengineerdetails != null ? $details->siteengineerdetails->site_engineer_name : '' }}</td>
                            <td>{{ $details->siteengineerdetails != null ? $details->siteengineerdetails->site_engineer_contact_no : '' }}</td>
                            <td>{{ $details->siteengineerdetails != null ? $details->siteengineerdetails->site_engineer_email : '' }}</td>
                        </tr>
                    </tbody>
                </table>        
            </div>
        </div>
    </div>
</div>  
<div class="col-md-12">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default" style="border-color:green">
            <div class="panel-heading" style="background-color:green">
               <b style="color:white">Procurement Details</b> 
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <th>Procurement Name</th>
                        <th>Procurement Contact</th>
                        <th>Procurement Email</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $details->procurementdetails != null ? $details->procurementdetails->procurement_name : '' }}</td>
                            <td>{{ $details->procurementdetails != null ? $details->procurementdetails->procurement_contact_no : '' }}</td>
                            <td>{{ $details->procurementdetails != null ? $details->procurementdetails->procurement_email : '' }}</td>
                        </tr>
                    </tbody>
                </table>        
            </div>
        </div>
    </div>
</div>
 

      
@endsection

@extends('inventory.layout') 
@section('title', 'Corporate')
@section('content')
 @push('head')
  
  <style>
    .error{
      color: red;
    }
    .tradeadd{
        background-color: #2dce89;
        color:#fff !important;
    }
    .tradeadd:hover{
    background-color:#2dce89;
    border-color: #2dce89;
    }
    .fixheader {
             position: fixed;
                top: 40px;
                width: calc(100% - 262px);
                z-index: 99;
                background: #fff;
                padding-top: 20px;
                padding-bottom: 0px;
            }
    
  </style>
  @endpush
    <!-- push external head elements to head --> 
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end fixheader">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-green"></i>
                        <div class="d-inline">
                            <h5>Corporate</h5>
                            <span>View, delete and update Corporate</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Corporate</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- list layout 1 start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <!--<div class="col col-sm-1">
                            <div class="card-options d-inline-block">
                                <div class="dropdown d-inline-block">
                                    <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-horizontal"></i></a>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="moreDropdown">
                                        <a class="dropdown-item" href="#">Delete</a>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>-->
                        <div class="col col-sm-6">
                            <div class="card-search with-adv-search dropdown">
                                <form action="{{route('corporate.index')}}" method="get">
                                    <input type="text" class="form-control global_filter searchclass" id="search" name="search" placeholder="Search.." >
                                    <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                    <button type="button" id="adv_wrap_toggler_1" class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                             
                                </form>
                            </div>
                        </div>
                        <div class="col col-sm-5">
                            <div class="card-options text-right">
                                <span class="mr-5" id="top">{{($corporates->currentpage()-1)*$corporates->perpage()+1}} to {{$corporates->currentpage()*$corporates->perpage()}}
                                            of  {{$corporates->total()}} entries</span>
                                <a href="#"><i class="ik ik-chevron-left"></i></a>
                                <a href="#"><i class="ik ik-chevron-right"></i></a>
                                <a href="{{route('corporate.create')}}" class=" btn btn-outline-primary btn-semi-rounded tradeadd"><i class="ik ik-plus"></i>&nbsp;Add Corporate</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="product_table" class="table">
                            <thead>
                                <tr>
                                    <!--<th class="nosort" width="10">
                                        <label class="custom-control custom-checkbox m-0">
                                            <input type="checkbox" class="custom-control-input" id="selectall" name="" value="option2">
                                            <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </th>-->
                                    <th>{{ __('Corporate Name')}}</th>
                                     <th>{{ __('Corporate Code')}}</th>
                                    <th>{{ __('Email')}}</th>
                                    <th>{{ __('Mobile')}}</th>
                                    <th>{{ __('Status')}}</th>
                                    <th style="width: 90px;!important">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($corporates as $corporate)
                                <tr>
                                    <!--<td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                            <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </td>-->
                                    <td>{{ isset($corporate->first_name) ? $corporate->first_name :'' }}</td>
                                    <td>{{ isset($corporate->corporate_code) ? $corporate->corporate_code :'' }}</td>
                                    <td>{{ isset($corporate->email) ? $corporate->email :'' }}</td>
                                    <td>
                                       {{ isset($corporate->mobile) ? $corporate->mobile :'' }} 
                                    </td>
                                    <td>
                                        <select class="form-control chngstatus" name="status" data-id="{{ isset($corporate->id) ? $corporate->id :'' }}" id="chngstatus" data-url="{{route('corpstatus',$corporate['id'])}}">

                                            <option value="">Select Status</option> 
                                            @if(isset($corporate->status) && $corporate->status==1 || $corporate->status== 0 )
                               
                                                <option value="1"  {{ ($corporate->status) == '1' ? 'selected' : '' }}>Active</option>

                                                <option value="0" @if ($corporate->status == '0') {{ 'selected' }} @endif>Inactive</option>
                                                        
                                            @else

                                                <option value="1">Active</option> 
                                                <option value="0">Inactive</option>
                                            @endif 
                                        </select>
                                    </td>
                                    <td>
                                        
                                        <a href="{{route('corporate.edit', $corporate->id) }}"  ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{--<a href="javascript:;" class="deletebyid" data-id="{{ isset($corporate->id) ? $corporate->id:'' }}"  data-url="{{route('corpdelete',$corporate['id'])}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>--}}
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- list layout 1 end -->
            <div class="col-md-12"><hr></div>
            <!-- list layout 2 -->
            
            <!-- list layout 2 end -->
        </div>
    </div>
    <!-- category add modal-->
    

@push('script')
<script src="{{ url('js/global.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

     var route = "{{ url('corpsearch') }}";
 $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });

 /*$(document).ready(function () {
    $('#product_table').DataTable({
        order: [[3, 'desc']],
    });
});*/
var table = $('#product_table').DataTable({

        paging: false,
        ordering: true,
        info: false,
        searching:false,
    });

</script>
 @endpush
 @endsection
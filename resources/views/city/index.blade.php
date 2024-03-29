@extends('inventory.layout') 
@section('title', 'City')
@section('content')
 @push('head')
  
  <style>
    .error{
      color: red;
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
                            <h5>City</h5>
                            <span>View, delete and update City</span>
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
                                <a href="#">City</a>
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
                                <form action="{{route('city.index')}}" method="get">
                                    <input type="text" class="form-control global_filter searchclass" id="search" name="search" placeholder="Search.." >
                                    <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                    <button type="button" id="adv_wrap_toggler_1" class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <!-- <div class="adv-search-wrap dropdown-menu dropdown-menu-right" aria-labelledby="adv_wrap_toggler_1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter" id="col0_filter" placeholder="Title" data-column="0">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter" id="col1_filter" placeholder="Price" data-column="1">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter" id="col2_filter" placeholder="SKU" data-column="2">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter" id="col3_filter" placeholder="Qty" data-column="3">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter" id="col4_filter" placeholder="Category" data-column="4">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter" id="col5_filter" placeholder="Tag" data-column="5">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-theme">Search</button>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                        <div class="col col-sm-5">
                            <div class="card-options text-right">
                                <span class="mr-5" id="top">{{($cities->currentpage()-1)*$cities->perpage()+1}} to {{$cities->currentpage()*$cities->perpage()}}
                                            of  {{$cities->total()}} entries</span>
                                <!-- <a href="#"><i class="ik ik-chevron-left"></i></a>
                                <a href="#"><i class="ik ik-chevron-right"></i></a> -->
                                {{--<a href="{{route('corporate.create')}}" class=" btn btn-outline-primary btn-semi-rounded ">Add City</a>--}}
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
                                    <th>{{ __('Name')}}</th>
                                    <th style="width: 90px;!important">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cities as $city)
                                          <tr>
                                            <!--<td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>-->
                                            
                                            <td>{{ isset($city->name) ? $city->name :'' }}</td>
                                            
                                            <td>
                                             {{--<a href="javascript:;"  data-id="{{ isset($city->id) ? $city->id:'' }}" data-url="{{route('city.edit', $city->id) }}"  class="editstate"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
                                            {{--<a href="javascript:;" class="deletebyid" data-id="{{ isset($city->id) ? $city->id:'' }}"  data-url="{{route('citydelete',$city->id)}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>--}}
                                            </td>
                                          </tr>
                                        @endforeach

                            </tbody>
                        </table>
                        <div class="card-footer d-flex align-items-center">

                                        <div class="col-md-6">
                                        </div>
                                        
                                        <div class="col-md-6">
                                        {{ $cities->links('include.pagination') }}
                                        </div>
                                </div>
                    </div>
                </div>
            </div>
            <!-- list layout 1 end -->
            <div class="col-md-12"><hr></div>
            <!-- list layout 2 -->
            
            <!-- list layout 2 end -->
        </div>
    </div>
   

@push('script')
<script src="{{ url('js/global.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

    var route = "{{ url('citysearch') }}";
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
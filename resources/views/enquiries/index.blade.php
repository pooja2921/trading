@extends('inventory.layout') 
@section('title', 'Enquiry')
@section('content')
 @push('head')
  
  <style>
    .error{
      color: red;
    }
    .searchclass{
        text-transform:capitalize;
    }
    .tradeadd{
        background-color: #2dce89;
        border-color: #2dce89;
        color:#fff !important;
    }
    .tradeadd:hover{
    background-color:#2dce89;
    border-color: #2dce89;
    }


  </style>
  @endpush
    <!-- push external head elements to head --> 
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-green"></i>
                        <div class="d-inline">
                            <h5>Enquiry</h5>
                            <span>View, delete and update Client</span>
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
                                <a href="#">Enquiry</a>
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
                        <div class="col col-sm-1">
                            <div class="card-options d-inline-block">
                                <div class="dropdown d-inline-block">
                                    <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-horizontal"></i></a>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="moreDropdown">
                                        <a class="dropdown-item" href="#">Delete</a>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col col-sm-6">
                            <div class="card-search with-adv-search dropdown">
                                <form action="{{route('client.index')}}" method="get">
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
                                <span class="mr-5" id="top">{{($enquiries>currentpage()-1)*$enquiries>perpage()+1}} to {{$enquiries>currentpage()*$enquiries>perpage()}}
                                            of  {{$enquiries>total()}} entries</span>
                                <a href="#"><i class="ik ik-chevron-left"></i></a>
                                <a href="#"><i class="ik ik-chevron-right"></i></a>
                                <a href="{{route('enquiry.create')}}" class=" btn btn-outline-primary btn-semi-rounded tradeadd"><i class="ik ik-plus"></i>&nbsp;Add Enquiry</a>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="product_table" class="table">
                            <thead>
                                <tr>
                                    <th class="nosort" width="10">
                                        <label class="custom-control custom-checkbox m-0">
                                            <input type="checkbox" class="custom-control-input" id="selectall" name="" value="option2">
                                            <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Email')}}</th>
                                    <th>{{ __('Mobile')}}</th>
                                    <th>{{ __('Status')}}</th>
                                    <th style="width: 90px;!important">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enquiries as $enquiry)
                                <tr>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                            <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </td>
                                    <td>{{ isset($enquiry->first_name) ? $enquiry->first_name :'' }}</td>
                                    <td>{{ isset($client->email) ? $client->email :'' }}</td>
                                    <td>
                                       {{ isset($client->mobile) ? $client->mobile :'' }} 
                                    </td>
                                    <td>
                                        <select class="form-control chngstatus" name="status" data-id="{{ isset($client->id) ? $client->id :'' }}" id="clientstatus" data-url="{{route('clientstatus',$client['id'])}}">

                                            <option value="">Select Status</option> 
                                            @if(isset($client->status) && $client->status==1 || $client->status== 0 )
                               
                                                <option value="1"  {{ ($client->status) == '1' ? 'selected' : '' }}>Active</option>

                                                <option value="0" @if ($client->status == '0') {{ 'selected' }} @endif>Inactive</option>
                                                        
                                            @else

                                                <option value="1">Active</option> 
                                                <option value="0">Inactive</option>
                                            @endif 
                                        </select>
                                    </td>
                                    <td>
                                        
                                        <a href="{{route('client.edit', $client->id) }}"  ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="javascript:;" class="deletebyid" data-id="{{ isset($client->id) ? $client->id:'' }}"  data-url="{{route('clientdelete',$client['id'])}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
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
    <div class="modal fade edit-layout-modal pr-0" id="productView" tabindex="-1" role="dialog" aria-labelledby="productViewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productViewLabel">Iphone 6</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="../img/products/ipone-6.jpg" class="img-fluid" alt="">
                            <div class="other-images">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="../img/widget/p2.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="../img/widget/p2.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="../img/widget/p2.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <p>
                                </p><div class="badge badge-pill badge-dark">Electronics</div>
                                <div class="badge badge-pill badge-dark">Accesories &amp; Gadgets</div>
                            <p></p>
                            <h3 class="text-danger">
                                $ 1234
                                <del class="text-muted f-16">$ 1250</del>
                            </h3>
                            <p class="text-green">Purchase Price: $ 1000</p>
                            <p>Apple iPhone 6 smartphone. Announced Sep 2014. Features 4.7″ display, Apple A8 chipset, 8 MP primary camera, 1.2 MP front camera, 1810 mAh</p>
                            <p>In Stock: 100</p>
                            <p>Spplier: PZ Tech</p>
                        </div>
                    </div>
                    <h5><strong>Sales</strong></h5>
                    <div id="line_chart" class="chart-shadow"></div>
                            
                </div>
            </div>
        </div>
    </div>
    <!-- category add modal-->
    

@push('script')
<script src="{{ url('js/global.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

    var route = "{{ url('clientsearch') }}";
 $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    console.log(data);
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
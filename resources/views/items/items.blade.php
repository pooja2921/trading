@extends('inventory.layout') 
@section('title', 'Products')
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
    <div class="container-fluid wrapper">
        <div class="page-header header">
            <div class="row align-items-end fixheader" >
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-green"></i>
                        <div class="d-inline">
                            <h5>Products</h5>
                            <span>View, delete and update Products</span>
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
                                <a href="#">Products</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="sticky-spacer"></div>
        <div class="sticky-content">
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
                                <form action="{{route('items.index')}}" method="get">
                                    <input type="text" class="form-control" id="search" placeholder="Search.." name="name" >
                                    <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                    <button type="button" id="adv_wrap_toggler_1" class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    
                                </form>
                            </div>
                        </div>
                        <div class="col col-sm-5">
                            <div class="card-options text-right">
                                <span class="mr-5" id="top">{{($items->currentpage()-1)*$items->perpage()+1}} to {{$items->currentpage()*$items->perpage()}}
                                            of  {{$items->total()}} entries</span>
                                <a href="#"><i class="ik ik-chevron-left"></i></a>
                                <a href="#"><i class="ik ik-chevron-right"></i></a>
                                <a href="{{route('items.create')}}" class=" btn btn-outline-primary btn-semi-rounded tradeadd"><i class="ik ik-plus"></i>&nbsp;Add Products</a>
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
                                    <th>{{ __('Image')}}</th>
                                    <th>{{ __('Product Name')}}</th>
                                    <th>{{ __('Product Code')}}</th>
                                    <th>{{ __('Brand')}}</th>
                                    <th style="width: 90px;!important">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                          <tr>
                                            <!--<td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>-->
                                            <td>
                                                @if(isset($item->image)) 
                                                <img src="{{ url('images/upload/item/'.$item['image'])}}" alt="" class="img-fluid img-20">
                                                @else
                                                <img src="{{ url('img/i.png')}}" alt="" id="output_image"  style="width: 20%; height: 20px;">
                                                @endif
                                            </td>
                                            <td>{{ isset($item->name) ? $item->name :'' }}</td>
                                            <td>{{ isset($item->product_code) ? $item->product_code :'' }}</td>
                                            <td>{{ isset($item->brand) ? $item->brand :'' }}</td>
                                            
                                            <td>
                                             <a href="{{route('items.edit', $item->id) }}"  ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                           {{-- <a href="javascript:;" class="deletebyid" data-id="{{ isset($item->id) ? $item->id:'' }}"  data-url="{{route('itemdelete',$item['id'])}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>--}}
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
    </div>
    <!-- category add modal-->
    

@push('script')
<script src="{{ url('js/global.js')}}"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
/*var navpos = $('#header').offset();
$(window).bind('scroll', function() {
  if ($(window).scrollTop() > navpos.top) {
    $('#header').addClass('navbar-fixed');
  } else {
    $('#header').removeClass('navbar-fixed');
  }
});*/

    var route = "{{ url('itemsearch') }}";
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
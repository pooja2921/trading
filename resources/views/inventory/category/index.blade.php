@extends('inventory.layout') 
@section('title', 'Product Group')
@section('content')
 @push('head')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
  
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
                            <h5>Product Group</h5>
                            <span>View, delete and update Product Group</span>
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
                                <a href="#">Product Group</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
       
        <div class="row">
          <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
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
                                <form action="{{route('categories.index')}}" method="get">
                                    <input type="text" class="form-control global_filter searchclass" id="search" name="search" placeholder="Search.." >
                                    <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                    <button type="button" id="adv_wrap_toggler_1" class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    
                                </form>
                            </div>
                        </div>
                        <div class="col col-sm-5">
                            <div class="card-options text-right">
                                <span class="mr-5" id="top">{{($parentcategory->currentpage()-1)*$parentcategory->perpage()+1}} to {{$parentcategory->currentpage()*$parentcategory->perpage()}}
                                            of  {{$parentcategory->total()}} entries</span>
                                <a href="#"><i class="ik ik-chevron-left"></i></a>
                                <a href="#"><i class="ik ik-chevron-right"></i></a>
                                <button class="btn btn-outline-primary btn-rounded-20 tradeadd" href="#categoryAdd" data-toggle="modal" data-target="#categoryAdd">
                                <i class="ik ik-plus"></i>&nbsp;Add Product Group
                            </button>
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
                                    <th>{{ __('Product Group')}}</th>
                                    <th>{{ __('Product Category')}}</th>
                                    <th>{{ __('Sub Category')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($parentcategory as $index=>$cat)   
                                    @if($cat->children=='[]')
                                    
                                    <tr>
                                                <!--<td>
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                        <span class="custom-control-label">&nbsp;</span>
                                                    </label>
                                                </td>-->
                                                        
                                                <td>
                                                  {{ isset($cat->name) ? $cat->name :'' }}
                                                </td>
                                                
                                                <td>
                                                
                                                </td>
                                    
                                                <td> 
                                                   
                                                </td>
                                                
                                                <td>
                                                    
                                                    <a href="{{ route('categories.show', $cat['id']) }}"><i class="ik ik-list"></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    
                                                    <a href="javascript:;"  class="editbycatid"  data-id="{{ isset($cat->id) ? $cat->id:'' }}" data-url="{{route('categories.edit', $cat['id']) }}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    {{--<a href="javascript:;" class="deletebyid" data-id="{{ isset($cat->id) ? $cat->id:'' }}"  data-url="{{route('categorydelete',$cat['id'])}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>--}}
                                                </td>
                                    </tr>
                                    
                                    @endif

                                    @foreach($cat->children as $child)
                                        @if($cat->children!='[]' && $child->children=='[]')
                                            <tr>
                                                        <!--<td>
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                                <span class="custom-control-label">&nbsp;</span>
                                                            </label>
                                                        </td>-->
                                                                
                                                        <td>
                                                          {{ isset($cat->name) ? $cat->name :'' }}
                                                        </td>
                                                        
                                                        <td>
                                                            {{ isset($child->name) ? $child->name :'' }}
                                                        
                                                        </td>
                                                        
                                                        <td>  
                                                          
                                                        </td>
                                                        
                                                        <td>
                                                            
                                                            <a href="{{ route('categories.show', $cat['id']) }}"><i class="ik ik-list"></i></a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            
                                                            <a href="javascript:;"  class="editbycatid"  data-id="{{ isset($cat->id) ? $cat->id:'' }}" data-url="{{route('categories.edit', $cat['id']) }}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            {{--<a href="javascript:;" class="deletebyid" data-id="{{ isset($cat->id) ? $cat->id:'' }}"  data-url="{{route('categorydelete',$cat['id'])}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>--}}
                                                        </td>
                                            </tr> 
                                        @else
                                        @foreach($child->children as $sub)
                                            <tr>
                                                <!--<td>
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                        <span class="custom-control-label">&nbsp;</span>
                                                    </label>
                                                </td>-->
                                                        
                                                <td>
                                                  {{ isset($cat->name) ? $cat->name :'' }}
                                                </td>
                                                @if($cat->children!='')
                                                <td>
                                                
                                                  
                                                    {{ isset($child->name) ? $child->name :'' }}
                                                
                                                </td>
                                                @endif
                                                <td>
                                                 
                                                  
                                                    {{ isset($sub->name) ? $sub->name :'' }}
                                                  
                                                </td>
                                                
                                                <td>
                                                    
                                                    <a href="{{ route('categories.show', $cat['id']) }}"><i class="ik ik-list"></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    
                                                    <a href="javascript:;"  class="editbycatid"  data-id="{{ isset($cat->id) ? $cat->id:'' }}" data-url="{{route('categories.edit', $cat['id']) }}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    {{--<a href="javascript:;" class="deletebyid" data-id="{{ isset($cat->id) ? $cat->id:'' }}"  data-url="{{route('categorydelete',$cat['id'])}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>--}}
                                                </td>
                                            </tr>   
                                        @endforeach
                                        @endif  
                                    @endforeach
                                   
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
    <div class="modal fade edit-layout-modal pr-0 " id="categoryAdd" tabindex="-1" role="dialog" aria-labelledby="categoryAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryAddLabel">{{ __('Add Product Group')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="form_category_create" method="POST" action="{{route('categories.store')}}" enctype= multipart/form-data>
                  @csrf
                  <div class="modal-body">
                    <span id="publicurl" data-value="{{url('/')}}"></span>
                      
                      <div class="form-group">
                          <label class="d-block">Product Group</label>
                          <input type="text" name="name" class="form-control" placeholder="Enter Product Group">
                      </div>
                      

                      
                      <div class="form-group">
                          <input class="btn btn-primary" type="submit" name="Save" value="Save">
                      </div>
                  </div>
                </form>
            </div>
        </div>
    </div>

    <!-- category edit modal -->
    <div class="modal fade edit-layout-modal pr-0 " id="categoryView" tabindex="-1" role="dialog" aria-labelledby="categoryViewLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryViewLabel">{{ __('Edit Product Group')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="forms-sample" method="POST" action="{{ route('updatecategory') }}" enctype="multipart/form-data" >
                    @csrf    
                        
                            
                  <div class="modal-body">
                    <span id="publicurl" data-value="{{url('/')}}"></span>
                    
                      
                      <div class="form-group">
                          <label class="d-block">Product Group</label>
                          <input  type="hidden" class="form-control catid" name="id">
                          <input type="text" name="name" class="form-control catname" placeholder="Enter Product Group" value="">
                      </div>
                      
                      <div class="form-group">
                         <button type="submit" class="btn btn-primary form-control-right updatecategory" >{{ __('Update')}}</button>
                      </div>
                  </div>
              </form>
            </div>
        </div>
    </div>

    <!-- detail model -->
    <div class="modal fade edit-layout-modal pr-0 show" id="productView" tabindex="-1" role="dialog" aria-labelledby="productViewLabel" style="padding-right: 17px; display: none;" aria-modal="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title catname" id="productViewLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-4 appendimg">
                          
                      </div>
                  </div>
            
                          
              </div>
          </div>
      </div>

    </div>

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<!-- <script src="{{ url('js/jstree.bundle.js')}}" type="text/javascript"></script>
<script src="{{ url('js/treeview.js')}}"></script>
<script src="{{ url('js/selectparentcategory.js')}}"></script> -->

<script src="{{ url('js/global.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

 <!-- image -->
<script type="text/javascript">
        $(function () {
        $('#dropify').dropify();
        });
    </script>
   


<script>

 $(document).ready(function() {
    $("#form_category_create").validate({
        rules: {
           name: {
                required: true
            },
        }
    });
    });

 /*$(document).ready(function() {
    $('.dropify').dropify();
  });*/

var route = "{{ url('autocompletesearch') }}";
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

var table = $('#user_table').DataTable({

        paging: false,
        ordering: true,
        info: false,
        searching:false,
    });

/*$(document).on('keyup','#search',function(){
alert($('#search').val());
});*/

</script>
 @endpush
 @endsection
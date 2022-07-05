@extends('inventory.layout') 
@section('title', 'Product Subcategory')
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
                            <h5>{{ isset($parentname->name) ? $parentname->name:'' }} @if(isset($parentname)) > @endif {{ isset($parentcategory->name) ? $parentcategory->name:'' }} {{ __('Sub Categories')}}</h5>
                            
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
                                <a href="#">Product Subcategory</a>
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
                        <div class="col col-sm-5">
                            <div class="card-search with-adv-search dropdown">
                                <form action="{{route('categories.searchchild')}}" method="get">
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
                                <button class="btn btn-outline-primary btn-rounded-20 tradeadd" href="#categoryAdd" data-toggle="modal" data-target="#categoryAdd"><i class="ik ik-plus"></i>&nbsp;
                                Add  Subcategory
                                </button>
                        
                                <a href="{{route('categories.index')}}"><button class="btn btn-outline-primary btn-rounded-20">
                                    Back 
                                </button>
                                </a>
                                
                                
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-header"><h3> {{ isset($parentcategory->name) ? $parentcategory->name:'' }} {{ __('Sub Categories')}}</h3></div>
                          
                    <div class="card-body">
                        <table id="user_table" class="table">
                            <thead>
                                <tr>
                                    <th class="nosort" width="10">
                                        <label class="custom-control custom-checkbox m-0">
                                            <input type="checkbox" class="custom-control-input" id="selectall" name="" value="option2">
                                            <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </th>
                                  
                                    <th>{{ __('Product Subcategory')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $cat)
                                  <tr>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                            <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </td>
                                    
                                    <td>{{ isset($cat->name) ? $cat->name :'' }}</td>
                                    
                                    
                                    <td>
                                      
                                     
                                     <a href="javascript:;"  class="editbysubcat"  data-id="{{ isset($cat->id) ? $cat->id:'' }}" data-url="{{ route('editsubcat', $cat['id']) }}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="javascript:;" class="deletebyid" data-id="{{ isset($cat->id) ? $cat->id:'' }}"  data-url="{{route('categorydelete',$cat['id'])}}"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
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
    <div class="modal fade edit-layout-modal pr-0 " id="categoryAdd" tabindex="-1" role="dialog" aria-labelledby="categoryAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryAddLabel">{{ __('Add Product Subcategory')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="form_category_create" method="POST" action="{{route('storecat')}}" enctype= multipart/form-data>
                  @csrf
                  <div class="modal-body">
                    <span id="publicurl" data-value="{{url('/')}}"></span>
                     
                      <div class="form-group">
                          <label class="d-block">Product Subcategory</label>
                          <input type="text" name="name" class="form-control" placeholder="Enter Product Subcategory">
                      </div>
                      
                      <div class="form-group">
                          <label class="d-block">Parent Category</label>

                          <select data-live-search="true" class="form-control  m_selectpicker parentcategory" name="parent_id">
                              <option value="">Select Parent</option>
                                        
                                  <option value="{{ $parentcategory->id }}" selected>{{ $parentcategory->name }}</option>
                                      
                                    
                          </select>
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
                    <h5 class="modal-title" id="categoryViewLabel">{{ __('Edit Product Subcategory')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="forms-sample" method="POST" action="{{ route('updatecat') }}" enctype='multipart/form-data' >
                  @csrf    
                            
                  <div class="modal-body">
                    <span id="publicurl" data-value="{{url('/')}}"></span>
                    
                      
                      <div class="form-group">
                          <label class="d-block">Product Subcategory</label>
                          <input type="text" name="name" class="form-control catname" placeholder="Enter Product Subcategory" value="">
                      </div>
                      
                      
                      <div class="form-group appendparent">
                          
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
                <span id="imgurl" data-imgurl="{{url('images/upload/category')}}"></span>
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

<script src="{{ url('js/global.js')}}"></script>

 @endpush
 @endsection
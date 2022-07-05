@extends('inventory.layout') 
@section('title', $category->name)
@section('content')
    <!-- push external head elements to head -->
    @push('head')
         <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
    @endpush

    
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Edit category')}}</h5>
                            <span>{{ __('Create new category')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('category')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <!-- clean unescaped data is to avoid potential XSS risk -->
                                {{ clean($category->name, 'titles')}}
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('categories.update',$category->id) }}" enctype= multipart/form-data >
                        @csrf
                        @method('PUT')
                            
                            <span id="publicurl" data-value="{{url('/')}}"></span>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="d-block">Category Image</label>
                                        
                                        @if($category->image!='')
                                              <input type="file" id="dropify" class="dropify" data-default-file=" {{url('images/upload/category/'.$category->image)}}" name="image">
                                        @else
                                            <input type="file" id="dropify" class="dropify" data-default-file=" https://cdn.example.com/front2/assets/img/logo-default.png " name="image">

                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="name">{{ __('category')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{($category->name)}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{$category->slug}}" placeholder="Enter Slug">
                                    </div>

                                   
                                    <div class="form-group">
                                        <label for="d-block">Type</label>
                                        <input type="text" class="form-control selecttype" id="type" name="type" placeholder="Enter Type" value="Item">
                                    </div>
                                    <div class="form-group">
                                       <label class="d-block">Parent Category</label>
                                          <select data-live-search="true" class="form-control   m_selectpicker parentcategory" name="parent_id">

                                              <option value>Select Parent</option>
                                                
                                                    @foreach($parentcategory as $cate)
                                                        
                                                        @if($category->exists && $cate->id == $category->parent_id)
                                                            <option value="{{ $cate->id }}" selected="selected">{{ $cate->name }}</option>

                                                        @else
                                                        
                                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                        
                                                        
                                                        @endif
                                                    @endforeach
                                          </select>
                                    </div>
                                    
                                    
                                    
                                    
                                
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control-right">{{ __('Update')}}</button>
                                    </div>
                                </div>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
         <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script> 
        <!--get role wise permissiom ajax script-->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script src="{{ url('js/jstree.bundle.js')}}" type="text/javascript"></script>
<script src="{{ url('js/treeview.js')}}"></script>
<script src="{{ url('js/selectparentcategory.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
   $(function () {
    $('#dropify').dropify();
  });
</script>

    @endpush
@endsection

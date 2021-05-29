@extends('layouts.admin')

@section('title')
  <title>Thêm mới danh mục</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'product', 'key' => 'add'])
    <!-- /.content-header -->

    <!-- Main content -->
    {{-- <div class="col-md-12">
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
    </div> --}}
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
           
              @csrf
              
              <div class="form-group">
                <label for="">Tên sản phẩm  </label>@error('name')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm..." value="{{old('name')}}">
              </div>
              <div class="form-group">
                <label for="">Ảnh đại diện</label>
                <input type="file" class="form-control-file" name="feature_image_path" id="">
              </div>

              <div class="form-group">
                <label for="">Ảnh chi tiết</label>
                <input type="file" class="form-control-file" name="image_path[]" multiple>
              </div>

              <div class="form-group">
                <label for="">Số lượng</label>@error('quantity')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <input type="number" min=0 max=1000 class="form-control" name="quantity"  placeholder="0" value="{{old('quantity')}}">
              </div>

              <div class="form-group">
                <label for="">Giá</label>@error('price')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <input type="text" class="form-control" name="price"  placeholder="0" value="{{old('price')}}">
              </div>

              <div class="form-group">
                <label for="">Giảm giá (%)</label>@error('discount')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <input type="number" min=0 max=100 class="form-control" name="discount"  placeholder="0" value="{{old('discount')}}">
              </div>

              <div class="form-group">
                <label for="">Trạng thái</label>@error('status')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <input type="text" class="form-control" name="status"  placeholder="0" value="{{old('status')}}">
              </div>
              

              <div class="form-group">
                <label for="">Danh mục</label>@error('category_id')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <select class="custom-select" name="category_id">
                  <option selected value="">Danh mục</option>
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>

              
             
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label for="">Mô tả</label>@error('content')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <textarea class="form-control tinymce_editer_init" name="content" id="" rows="8">{{old('content')}}</textarea>
              </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary mb-2 btn-add">Thêm mới</button>
          </div>


        </div>
      </div>
    </div>
    </form>
    <!-- /.content -->
  </div>   
@endsection
@section('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  let editor_config = {
    path_absolute : "/",
    selector: "textarea.tinymce_editer_init",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      let cmsURL = editor_config.path_absolute + 'filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script> 
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    $(document).on('click', '.btn-add', function () {
      Swal.fire({
          icon: 'success',
          title: 'Thêm mới thành công',
          showConfirmButton: false,
          timer: 7000
      });
    })
  </script> 


@endsection

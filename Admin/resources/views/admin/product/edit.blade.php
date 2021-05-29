@extends('layouts.admin')

@section('title')
  <title>Chỉnh sửa</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'product', 'key' => 'edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <form action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
           
              @csrf
              
              <div class="form-group">
                <label for="">Tên sản phẩm</label>@error('name')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <input type="text" class="form-control" name="name" value="{{$product->name}}" placeholder="Nhập tên sản phẩm...">
              </div>

              <div class="form-group">
                <label for="">Ảnh đại diện</label>
                <input type="file" class="form-control-file" name="feature_image_path" id="">

                <div class="col-md-12">
                  <div class="row">
                    <img width="150" height="150" src="{{$product->feature_image_path}}" alt="">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="">Ảnh chi tiết</label>
                <input type="file" class="form-control-file" name="image_path[]" multiple>
                 <div class="col-md-12">
                  <div class="row">
                    
                      @foreach ($product->images as $productImageItime)
                        <div class="col-md-4">
                          <img width="150" height="150" src="{{$productImageItime->image_path}}" alt="">
                        </div>
                      @endforeach
                  
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="">Số lượng</label>@error('quantity')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <input type="number" min=0 max=1000 class="form-control" name="quantity" value="{{$product->quantity}}"  placeholder="0" value="{{old('quantity')}}">
              </div>

              <div class="form-group">
                <label for="">Giá</label>@error('price')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <input type="text" class="form-control" value="{{$product->price}}" name="price"  placeholder="0">
              </div>

              <div class="form-group">
                <label for="">Giảm giá (%)</label>@error('discount')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <input type="number" min=0 max=100 value="{{$product->discount}}" class="form-control" name="discount"  placeholder="0">
              </div>
              <div class="form-group">
                <label for="">Trạng thái</label>
                <input type="text" min=0 max=100 class="form-control" value="{{$product->status}}" name="status"  placeholder="0">
              </div>
              

              <div class="form-group">
                <select class="custom-select" name="category_id">
                  <option selected value="">Danh mục</option>
                  @foreach ($categories as $category)
                    
                    <option @if ($category->id == $product->category_id) {{'selected'}} @endif value="{{$category->id}}">{{$category->name}}</option>
                    
                  @endforeach
                </select>
              </div>

              
             
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label for="">Mô tả</label>@error('content')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <textarea class="form-control tinymce_editer_init" name="content" id="" rows="8">{{$product->content}}</textarea>
              </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary mb-2 btn-edit">Cập nhật</button>
          </div>


        </div>
      </div>
    </div>
    </form>
    <!-- /.content -->
  </div>   
@endsection
@section('js')
<script src="{{ asset('admins/myJava.js') }}"></script>
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
  $(document).on('click', '.btn-edit', function () {
    Swal.fire({
        icon: 'success',
        title: 'Cập nhật thành công',
        showConfirmButton: false,
        timer: 7000
    });
  })
</script> 
@endsection

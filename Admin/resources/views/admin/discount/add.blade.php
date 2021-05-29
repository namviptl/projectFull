@extends('layouts.admin')

@section('title')
  <title>Thêm mới mã giảm giá</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'discount', 'key' => 'add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <form action="{{ route('discount.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="">Mã giảm giá<span id="error_code" style="color: red;">(*)</span></label>
                <input type="text" name="code" class="form-control" id="txt_name" placeholder="Nhập mã" />
              </div>

              <div class="form-group">
                <label for="">phần trăm <span id="error_price" style="color: red;">(*)</span></label>
                <input type="number" name="discount" min="0" max="100" onblur="" class="form-control" placeholder="0"/>
              </div>

              <div class="panel panel-danger">
                  <div class="panel-heading">
                      Thiết lập thời gian
                  </div>
                  <div class="panel-body">
                      <table class="table">
                          <tr>
                              <td>Ngày bắt dầu</td>
                              <td>
                                  <input class="form-control" name="start_day" type="date" value="" id="">
                              </td>
                              
                          </tr>
                          <tr>
                              <td>Ngày kết thúc</td>
                              <td>
                                  <input class="form-control" name="end_day" type="date" value="" id="">
                              </td>
                          </tr>
                      </table>
                  </div>
              </div>

              <button type="submit" class="btn btn-dark btn-add">
                Thêm mới
              </button>
              <button type="reset" class="btn btn-dark">
                Nhập lại
              </button>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>   
@endsection
@section('js')
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

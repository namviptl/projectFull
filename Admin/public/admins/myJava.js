$(document).ready(function(){
  //order-delete
  $(document).on('click', '#delete-order', function (e) {
    e.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
      title: 'Bạn chắc chắn muốn xóa đơn hàng này chứ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'GET',
          url: urlRequest,

          success: function(data){
            if(data.code == 200){
              that.parent().parent().remove();
              Swal.fire(
                'Thành công!',
                'Đơn hàng của bạn đã được xóa',
                'success'
              )
            }
          },
          error: function(){
            Swal.fire(
                'Thất bại!',
                'warning'
              )
          }
        });
      }
    })
  })
  //Product-delete
  $(document).on('click', '#delete-product', function (e) {
    e.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
      title: 'Bạn chắc chắn muốn xóa sản phẩm này chứ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'GET',
          url: urlRequest,

          success: function(data){
            if(data.code == 200){
              that.parent().parent().remove();
              Swal.fire(
                'Thành công!',
                'Sản phẩm của bạn đã được xóa',
                'success'
              )
            }
          },
          error: function(){
            Swal.fire(
                'Thất bại!',
                'warning'
              )
          }
        });
      }
    })
  })

  //User-delete
  $(document).on('click', '#delete-user', function (e) {
    e.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
      title: 'Bạn chắc chắn muốn xóa tài khoản này chứ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'GET',
          url: urlRequest,

          success: function(data){
            if(data.code == 200){
              that.parent().parent().remove();
              Swal.fire(
                'Thành công!',
                'Tài khoản này đã được xóa',
                'success'
              )
            }
          },
          error: function(){
            Swal.fire(
                'Thất bại!',
                'warning'
              )
          }
        });
      }
    })
  })
  //role-delete
  $(document).on('click', '#delete-role', function (e) {
    e.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
      title: 'Bạn chắc chắn muốn xóa chức năng này chứ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'GET',
          url: urlRequest,

          success: function(data){
            if(data.code == 200){
              that.parent().parent().remove();
              Swal.fire(
                'Thành công!',
                'Tài khoản này đã được xóa',
                'success'
              )
            }
          },
          error: function(){
            Swal.fire(
                'Thất bại!',
                'warning'
              )
          }
        });
      }
    })
  })

  //delete-category
  $(document).on('click', '#delete-category', function (e) {
    e.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
      title: 'Bạn chắc chắn muốn xóa danh mục này chứ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'GET',
          url: urlRequest,

          success: function(data){
            if(data.code == 200){
              that.parent().parent().remove();
              Swal.fire(
                'Thành công!',
                'Danh mục này đã được xóa',
                'success'
              )
            }
          },
          error: function(){
            Swal.fire(
                'Thất bại!',
                'warning'
              )
          }
        });
      }
    })
  })

  //role-permission
  $('.checkbox-wrapper').on('click', function () {
    $(this).parents('.card').find('.checkbox-childrent').prop('checked', $(this).prop('checked'));
  });

   $('.check-all').on('click', function () {
    $(this).parents().find('.checkbox-childrent').prop('checked', $(this).prop('checked'));
    $(this).parents().find('.checkbox-wrapper').prop('checked', $(this).prop('checked'));
  });
});
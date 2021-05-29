 
 <main class="ps-main">
  <div class="ps-content pt-80 pb-80">
    <div class="ps-container">
      <div class="ps-cart-listing">
      	<h1 style="text-align: center;">THÔNG BÁO ĐƠN HÀNG</h1>
        <h3>1. Chi tiết hóa đơn</h3>
        <table class="table ps-cart__table" style="border: 1px solid;border-collapse: collapse;width: 1000px;">
          <thead>
            <tr>
              <th style="border: 1px solid;width: 100px;">Hình ảnh</th>
              <th style="border: 1px solid">Tất cả sản phẩm</th>
              <th style="border: 1px solid">Size</th>
              <th style="border: 1px solid">Giá</th>
              <th style="border: 1px solid">Số lượng</th>
              <th style="border: 1px solid">Tổng tiền</th>
            </tr>
          </thead>
          <tbody>


    		@foreach ($cart as $size)
    			@foreach ($size as $value)
            <tr>
          	  <td style="border: 1px solid"><img style="width: 100px; height: 100px;" src=""></td>
              <td style="width: 400px;border: 1px solid;font-size: 18px;text-align: center;">{{$value['name']}}</td>
              <td style="border: 1px solid; text-align: center;">{{$value['size']}}</td>
              <td style="border: 1px solid; text-align: center;">
                @if ($value['discount'] > 0)
                   {{number_format($value['price'] * (1-1/$value['discount']) )}} đ
                @else
                  {{number_format($value['price'])}} đ
                @endif
               

              </td>
              <td style="border: 1px solid; text-align: center;">{{$value['quantity_order']}}</td>
              <td style="border: 1px solid; text-align: center;">
                @if ($value['discount'] > 0)
                  {{number_format(($value['price'] * (1-1/$value['discount']))*$value['quantity_order'])}}
                @else
                  {{number_format($value['price']*$value['quantity_order'])}}
                @endif
               
              </td>
            </tr>
           		@endforeach
    		@endforeach

			<tr>
				<td style="border: 1px solid;font-family: arial;font-size: 20px;" colspan="6">Chiết khấu: {{$discount}} %</td>
			</tr>
			<tr>
				<td style="border: 1px solid;font-family: arial;font-size: 20px;" colspan="6">Tổng tiền: {{number_format($sumTotal)}} đ</td>
			</tr>
			</tbody>
		</table>
		    <div>
		      <h3>2. Thông tin khách hàng</h3>
		      <h5><strong>Họ và tên: {{$user['name']}}</strong></h5>  
		      <h5><strong>Số điện thoại: {{$user['phone']}} </strong></h5>  
		      <h5><strong>Email: {{$user['email']}}</strong></h5>  
		      <h5><strong>Địa chỉ: {{$user['address']}}</strong></h5> 
		    </div>
		      </div>
    @if ($user['user_id'] == '') 
    <div class="ps-cart-listing">
	    <h5 style="color: #7971ea; font-weight: bold;font-size: 25px;">Cảm ơn quý khách đã tin tưởng và chọn <strong>NTN STORE!</strong></h5>
    	 <h5>Tài khoản của quý khách sẽ được tạo khi lần đầu tiên mua hàng <br>tại <strong style="color: #7971ea;">NTN STORE</strong><br></h5>
		<h5>Tài khoản và mật khẩu của quý khách là: <strong><br>- Tài khoản: {{$user['email']}}<a href="ntnstore.com"></a><br>- Mật khẩu: ntnshop.com</strong>
		</h5>
	        <div>
	    </div>
  	</div>
  	@endif
</main>
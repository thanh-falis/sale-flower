<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-left auto-width-left">
					<ul class="top-menu menu-beta l-inline">
						<li><a href=""><i class="fa fa-home"></i> 126 - đường số 7 - p3 - Gò Vấp - Tp.HCM </a></li>
						<li><a href=""><i class="fa fa-phone"></i> 0937790683</a></li>
					</ul>
				</div>
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
					@if(!Auth::guard('customer')->check())
                        <li>
                            <a href="register">Đăng ký</a>
                        </li>
                        <li>
                            <a href="login">Đăng nhập</a>
                        </li>
                        @else
                        <li>
                            <a href="nguoidung">
                                <span class ="glyphicon glyphicon-user"></span>
								{{Auth::guard('customer')->user()->name}}
                            </a>
                        </li>
                        <li>
                            <a href="logout">Đăng xuất</a>
                        </li>
                    @endif					
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="/" id="logo">Sun Flower</a>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="search">
					        <input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..." />
					        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>
					<div class="beta-comp">
						@if(Session::has('cart'))
						<div class="cart">
							<div class="beta-select">
								<i class="fa fa-shopping-cart"></i> 
							Giỏ hàng (@if(Session::has('cart')) {{Session('cart')->totalQty}}@else {{!! Trống !!}}
								@endif) 
								<i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">
								@foreach($product_cart as $product)
									<div class="cart-item">
										<a class="cart-item-delete" href="{{route('xoagiohang',$product['item']['id'])}}"><i class="fa fa-times"></i></i></a>
										<div class="media">
											<a class="pull-left" href="#"><img src="source/image/product/{{$product['item']['image']}}" alt=""></a>
											<div class="media-body">
												<span class="cart-item-title">{{$product['item']['name']}}</span>
												<span class="cart-item-amount">{{$product['qty']}}*<span>
													@if($product['item']['promotion_price'] == 0) 
														{{number_format($product['item']['unit_price'])}}
													@else
														{{number_format($product['item']['promotion_price'])}}
													@endif
												</span></span>
											</div>
										</div>
									</div>
								@endforeach
								
								<div class="cart-caption">
									<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{Session('cart')->totalPrice}}</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="{{route('dathang')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
						</div> <!-- .cart -->
						@else
						<div class="cart">
							<div class="beta-select">
								<i class="fa fa-shopping-cart"></i> Giỏ hàng ( Trống ) 
								<i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">
									<div class="cart-item">
										<div class="media">
											<a class="pull-left" href="#"><img src="" alt=""></a>
											<div class="media-body">
												<span class="cart-item-title"></span>
												<span class="cart-item-amount"></span></span>
											</div>
										</div>
									</div>
								<div class="cart-caption">
									<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value"></span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="checkout.html" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
						</div> <!-- .cart -->
						@endif
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #0277b8;">
			<div class="container">
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="/">Trang chủ</a></li>
						<li><a href="#">Sản phẩm</a>
							<ul class="sub-menu">
								@foreach($product_type as $type)
									<li><a href="loai-san-pham/{{$type->id}}">{{$type->name}}</a></li>
								@endforeach
							</ul>
						</li>
						<li><a href="gioi-thieu">Giới thiệu</a></li>
						<li><a href="lien-he">Liên hệ</a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> <!-- #header -->
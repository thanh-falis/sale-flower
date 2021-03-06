@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="/">Home</a> / <span>Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach($product_type as $type)
								<li><a href="loai-san-pham/{{$type->id}}">{{$type->name}}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<div class="beta-products-details">
								<p class="pull-left"></p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($Type as $product_type)
								<div class="col-sm-4">
									<div class="single-item">
									@if($product_type->promotion_price != 0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										<div class="single-item-header">
											<a href="chi-tiet-san-pham/{{$product_type->id}}"><img src="source/image/product/{{$product_type->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$product_type->name}}</p>
											<p class="single-item-price">
												@if($product_type->promotion_price == 0)
													<span class="flash-sale">{{number_format($product_type->unit_price)}}đ</span>
												@else
													<span class="flash-del">{{number_format($product_type->unit_price)}}đ</span>
													<span class="flash-sale">{{number_format($product_type->promotion_price)}}đ</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('themgiohang', $product_type->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chitietsanpham', $product_type->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
									<div style="height:10px;">&nbsp;</div>
								</div>
								@endforeach
							</div>
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
						<div class="beta-products-list">
						<h4>Sản phẩm khác</h4>
							<div class="beta-products-details">
								<p class="pull-left"></p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($other_product as $other)
								<div class="col-sm-4">
									<div class="single-item">
									@if($other->promotion_price != 0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										<div class="single-item-header">
											<a href="chi-tiet-san-pham/{{$other->id}}"><img src="source/image/product/{{$other->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$other->name}}</p>
											<p class="single-item-price">
												@if($other->promotion_price == 0)
													<span class="flash-sale">{{number_format($other->unit_price)}}đ</span>
												@else
													<span class="flash-del">{{number_format($other->unit_price)}}đ</span>
													<span class="flash-sale">{{number_format($other->promotion_price)}}đ</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
									<div style="height:10px;">&nbsp;</div>
								</div>
								@endforeach
							</div>
							<div class="row" style="float:right;">{{$other_product->links()}} </div>
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
@extends('frontend.master')
@section('maincontent')
    <!-- breadcrumb-area-start -->
    <div class="breadcrumb__area grey-bg pt-5 pb-5">
        <div class="container" style="margin-top:80px">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-breadcrumb__content">
                        <div class="tp-breadcrumb__list">
                            <span class="tp-breadcrumb__active"><a href="{{ route('home') }}">Home</a></span>
                            <span class="dvdr">/</span>
                            <span>Search Page</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- shop-area-start -->
    <section class="shop-area-start grey-bg pb-200">
        <div class="container">
            <div class="row row-reverse">
                <div class="col-xl-2 col-lg-12 col-md-12 order-2">
                    <div class="tpshop__leftbar tpshop__leftbar-area">
                        {{-- filter by Categories  --}}
                        <div class="tpshop__widget mb-30 pb-25">

                            @php
                                $categories = App\Models\Category::where('status', 1)->get();
                            @endphp
                            <h4 class="tpshop__widget-title">Product Categories</h4>
                            @if ($categories->count() > 0)
                                <form method="get" action="{{ route('product.filterByCategory') }}">
                                    @foreach ($categories as $category)
                                        @php
                                            $categoryProducts = App\Models\Product::whereHas('varient')
                                                ->where('category_id', $category->id)
                                                ->count();
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input checkbox_category{{ $category->id }}"
                                                type="checkbox" value="{{ $category->id }}"
                                                id="{{ $category->categoryName }}" name="categoryId[]">
                                            <label class="form-check-label" for="{{ $category->categoryName }}">
                                                {{ $category->categoryName }} ({{ $categoryProducts }})
                                            </label>
                                        </div>
                                    @endforeach
                                    <button class="tp-btn py-1" type="submit">Filter</button>
                                </form>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" checked
                                        id="flexCheckDefault9">
                                    <label class="form-check-label" for="flexCheckDefault9">
                                        Biscuits & Snacks (08)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        Fresh Fruits (12)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                    <label class="form-check-label" for="flexCheckDefault3">
                                        Exotic Fruits (09)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                                    <label class="form-check-label" for="flexCheckDefault4">
                                        Breads & Bakery (05)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                                    <label class="form-check-label" for="flexCheckDefault5">
                                        Breakfast & Dairy (09)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">
                                        Honey (05)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault7">
                                    <label class="form-check-label" for="flexCheckDefault7">
                                        Milk & Flavoured (04)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault8">
                                    <label class="form-check-label" for="flexCheckDefault8">
                                        Meats & Seafood (08)
                                    </label>
                                </div>
                            @endif

                        </div>
                        {{-- filter by Brand  --}}
                        <div class="tpshop__widget mb-30 pb-25">
                            @php
                                $brands = App\Models\Brand::where('status', 1)->take(10)->orderByRaw('RAND()')->get();
                            @endphp
                            <h4 class="tpshop__widget-title">FILTER BY BRAND</h4>

                            @if ($brands->count() > 0)
                                <form method="get" action="{{ route('product.filterByBrand') }}">
                                    @foreach ($brands as $brand)
                                        @php
                                            $brandProducts = App\Models\Product::whereHas('varient')
                                                ->where('brand_id', $brand->id)
                                                ->get();
                                        @endphp

                                        <div class="form-check">
                                            <input class="form-check-input checkbox_brand{{ $brand->id }}"
                                                type="checkbox" value="{{ $brand->id }}" id="{{ $brand->BrandName }}"
                                                name="brandName[]">
                                            <label class="form-check-label" for="{{ $brand->BrandName }}">
                                                {{ $brand->BrandName }} ({{ $brandProducts->count() }})
                                            </label>
                                        </div>
                                    @endforeach
                                    <button class="tp-btn py-1" type="submit">Filter</button>
                                </form>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault18">
                                    <label class="form-check-label" for="flexCheckDefault18">
                                        Chrome Hearts (15)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault19">
                                    <label class="form-check-label" for="flexCheckDefault19">
                                        Dominique Aurientis (15)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault20">
                                    <label class="form-check-label" for="flexCheckDefault20">
                                        Galliano (15)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault21">
                                    <label class="form-check-label" for="flexCheckDefault21">
                                        Georgine (15)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault22">
                                    <label class="form-check-label" for="flexCheckDefault22">
                                        Matthew Christopher (15)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault23">
                                    <label class="form-check-label" for="flexCheckDefault23">
                                        Paul Gaultier (15)
                                    </label>
                                </div>
                            @endif

                        </div>

                        {{-- filter by Best Ratings  --}}
                        {{-- <div class="tpshop__widget">
                            <h4 class="tpshop__widget-title">FILTER BY RATING</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault24">
                                <label class="form-check-label" for="flexCheckDefault24">
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    (45)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault25">
                                <label class="form-check-label" for="flexCheckDefault25">
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    (10)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault26">
                                <label class="form-check-label" for="flexCheckDefault26">
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    (05)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault27">
                                <label class="form-check-label" for="flexCheckDefault27">
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    (02)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault28">
                                <label class="form-check-label" for="flexCheckDefault28">
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    <i class="icon-star_rate"></i>
                                    (02)
                                </label>
                            </div>
                        </div> --}}
                    </div>
                    <div class="tpshop__widget tpshop__leftbar-area">
                        <div class="tpshop__sidbar-thumb mt-35">
                            <img src="assets/img/shape/sidebar-product-1.png" alt=""   loading="lazy">
                        </div>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-12 col-md-12">
                    <div class="tpshop__top tpshop__sidebar-area mr-60 ">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product__filter-content mb-40">
                                    <div class="row align-items-center py-2 text-center">
                                        <form action="{{ route('search.product') }}" method="get">
                                            @csrf
                                            <div class="d-flex">
                                                <input value="{{ $searchTag }}" type="text" name="search"
                                                    autocomplete="off" placeholder="Search Here"
                                                    class="form-control rounded-0 rounded-start top_search">
                                                <button class="tp-btn rounded-0 rounded-end">Search</button>
                                            </div>
                                        </form>
                                        <ul class="list-unstyled top_search_list"
                                            style="text-align: left; padding-left:5px;display:none">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active whight-product" id="nav-popular" role="tabpanel"
                                aria-labelledby="nav-popular-tab">
                                <div
                                    class="row row-cols-xxl-3 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 tpproduct__shop-item">
                                    @if ($products->count() > 0)
                                        @foreach ($products as $product)
                                        <div class="col-lg-3 col-md-4 col-6 my-2 p1">
                                            <div class="tpproduct p-relative tpprogress__hover">
                                                <div class="tpproduct__thumb p-relative text-center overflow-hidden">
                                                    <a href="{{ route('product.details', $product->slug) }}" class="zoom-container">
                                                        <img src="{{ asset('Uploads/products/' . $product->product_image) }}"
                                                            alt="{{ $product->slug }}" class="zoom-image"   loading="lazy">
                                                    </a>
                                                    <div class="tpproduct__info bage">
                                                        @if (!empty($product->varient[0]))
                                                            @if ($product->varient[0]->discount > 0)
                                                                <span class="tpproduct__info-discount bage__discount"
                                                                    style="font-size: 0.75rem; padding: 0.3em 0.6em; border-radius: 4px; color: #fff; background-color: #dc3545;">-{{ $product->varient[0]->discount }}%</span>
                                                                <span class="tpproduct__info-hot bage__hot"
                                                                    style="font-size: 0.75rem; padding: 0.3em 0.6em; border-radius: 4px; color: #fff; background-color: #ffc107;">HOT</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="tpproduct__shopping">
                                                        @auth
                                                            <a class="tpproduct__shopping-wishlist add_whishlist" href="#"
                                                                value="{{ $product->id }}">
                                                                @auth
                                                                    @php
                                                                        $loved = App\Models\WishList::where('user_id', Auth::user()->id)
                                                                            ->where('product_id', $product->id)
                                                                            ->first();
                                                                    @endphp
                                                                @endauth
                                                                <i style="color: {{ !empty($loved->loved) ? 'red' : '' }}"
                                                                    class="fas fa-heart icons"></i>
                                                            </a>
                                                        @else
                                                            <a class="tpproduct__shopping-wishlist" href="{{ route('login') }}">
                                                                <i class="fas fa-heart icons"></i>
                                                            </a>
                                                        @endauth
                                                        <a class="tpproduct__shopping-cart"
                                                            href="{{ route('product.details', $product->slug) }}">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="tpproduct__content p-3">
                                                    <span class="tpproduct__content-weight d-block mb-2">
                                                        <a href="{{ route('category.wise.product', $product->category->slug) }}"
                                                            class="text-muted text-decoration-none small">
                                                            {{ $product->category->categoryName }}
                                                        </a>
                                                    </span>
                                                    <h4 class="tpproduct__title mb-2">
                                                        <a href="{{ route('product.details', $product->slug) }}"
                                                            class="text-dark text-decoration-none">
                                                            {{ Illuminate\Support\Str::limit($product->product_name, 18) }}
                                                            {{-- @dd($product->varient[0]->stock_quantity) --}}
                                                            @if (!empty($product->varient[0]->stock_quantity))
                                                                @if ($product->varient[0]->stock_quantity > 0)
                                                                    <span
                                                                        class="badge tpproduct__info-stock bage__stock bg-success ms-1">In
                                                                        Stock</span>
                                                                @else
                                                                    <span
                                                                        class="badge tpproduct__info-stock bage__stock bg-danger ms-1">Out
                                                                        of Stock</span>
                                                                @endif
                                                            @else
                                                                <span class="badge tpproduct__info-stock bage__stock bg-danger ms-1">Out
                                                                    of Stock</span>
                                                            @endif
                                                        </a>
                                                    </h4>
                                                    <div class="tpproduct__rating mb-3 d-flex align-items-center">
                                                        @php
                                                            $ratingAvg = App\Models\ReviewRating::where(
                                                                'product_id',
                                                                $product->id,
                                                            )->avg('rating');
                                                            $last = 0;
                                                        @endphp
                                                        @for ($i = 1; $i <= $ratingAvg; $i++)
                                                            <a href="#" class="text-warning me-1"><i class="fas fa-star"></i></a>
                                                            @php $last = $i @endphp
                                                        @endfor
                                                        @for ($j = $last; $j < 5; $j++)
                                                            <a href="#" class="text-muted me-1"><i class="far fa-star"></i></a>
                                                        @endfor
                                                    </div>
                                                    <div class="tpproduct__price d-flex align-items-center flex-wrap">
                                                        <span
                                                            class="fw-bold text-dark me-2">৳{{ $product->varient[0]->discount_amount ?? '' }}</span>
                                                        @if (!empty($product->varient[0]))
                                                            @if ($product->varient[0]->weight == 'gm' || $product->varient[0]->weight == 'ml')
                                                                <span
                                                                    class="text-muted small">/{{ $product->varient[0]->weight ?? '' }}
                                                                    {{ $product->varient[0]->unit ?? '' }}</span>
                                                            @else
                                                                <span
                                                                    class="text-muted small">/{{ $product->varient[0]->unit ?? '' }}</span>
                                                            @endif
                                                        @endif
                                                        @if (!empty($product->varient[0]) && $product->varient[0]->discount > 0)
                                                            <del
                                                                class="text-muted ms-2 small">৳{{ $product->varient[0]->regular_price }}</del>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="tpproduct__hover-btn d-flex justify-content-center mb-0">
                                                        <form method="POST" id="add_to_cart_form">
                                                            @csrf
                                                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                            <input type="hidden" value="{{ $product->varient[0]->id }}"
                                                                name="variant_id">
                                                            <input type="hidden" value="{{ $product->varient[0]->discount_amount }}"
                                                                name="selling_price">
                                                            <input type="hidden" value="{{ $product->varient[0]->weight }}"
                                                                name="weight">
                                                            <input type="hidden" value="{{ $product->varient[0]->unit }}"
                                                                name="unit">
                                                            <button class="btn btn-info mb-3"
                                                                style="background: var(--tp-heading-secondary) !important; border: 1px solid var(--tp-heading-secondary); color:white">Add
                                                                to cart</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="row text-center bg-white"
                                            style="padding:10px 0;margin: auto;width: 96% !important;border-radius: 10px;">

                                            <h4> <a href="shop-details-top-.html">Product Not Found</a>
                                            </h4>
                                        </div>
                                    @endif
                                </div>

                            </div>

                            @if ($products->count() > 9)
                                <div class="basic-pagination text-center mt-35 d-flex justify-content-center">
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($products->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true"
                                                aria-label="@lang('pagination.previous')">
                                                <span class="page-link pt-0" aria-hidden="true">&lsaquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link pt-0" href="{{ $products->previousPageUrl() }}"
                                                    rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                            @if ($page == $products->currentPage())
                                                <li class="page-item active" aria-current="page"><span
                                                        class="page-link pt-0">{{ $page }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link pt-0"
                                                        href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($products->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link pt-0" href="{{ $products->nextPageUrl() }}"
                                                    rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled" aria-disabled="true"
                                                aria-label="@lang('pagination.next')">
                                                <span class="page-link pt-0" aria-hidden="true">&rsaquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- shop-area-end -->


    <!-- feature-area-start -->
    @include('frontend.body.servicesfooter')
    <!-- feature-area-end -->

    <script>
        @if (!empty($brandId))
            let brandid;
            let chechBox
            @foreach ($brandId as $brandId)
                brandid = '{{ $brandId }}';
                chechBox = document.querySelector('.checkbox_brand' + brandid);
                chechBox.setAttribute('checked', 'true');
            @endforeach
        @endif

        @if (!empty($categoryId))
            let brandid;
            let chechBox
            @foreach ($categoryId as $categoryId)
                brandid = '{{ $categoryId }}';
                chechBox = document.querySelector('.checkbox_category' + brandid);
                chechBox.setAttribute('checked', 'true');
            @endforeach
        @endif
    </script>
@endsection

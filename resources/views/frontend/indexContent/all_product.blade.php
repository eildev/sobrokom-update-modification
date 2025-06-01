@php
    $categories = App\Models\Category::where('status', 1)->get();
    $flash_selling_product = App\Models\Product::whereHas('category', function ($query) {
        $query->where('status', 1);
    })
        ->whereHas('varient')
        ->where('status', 1)
        ->inRandomOrder()
        ->take(40)
        ->get();
@endphp

<style>

</style>

@if ($flash_selling_product->count() > 0)
    <section class="weekly-product-area grey-bg whight-product">
        <div class="container">
            <div class="sections__wrapper white-bg pr-50 pl-50">
                <div class="row align-items-center m-5">
                    <div class="col-md-6 text-center">
                        <div class="tpsection mb-15">
                            <h4 class="tpsection__title text-start brand-product-title pt-2" id="weekly_offers">Our All
                                Products</h4>
                        </div>
                    </div>
                    <!--<div class="col-md-6">-->
                    <!--    <div class="tpproduct__all-item">-->
                    <!--        <a href="{{ route('all.feature.product') }}">View All <i class="icon-chevron-right"></i></a>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                <div class="row product_row">
                    @foreach ($flash_selling_product as $product)
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
                </div>
            </div>
        </div>
    </section>
@endif

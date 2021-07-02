<form class="form-inline" action="{{ route('carts.store') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <a type="button" title="Add to cart" onclick="addTocart({{ $product->id }})">Add to cart</a>
</form>

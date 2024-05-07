<section class="cart__section">
    <div class="container-fluid">
        <div class="cart__section--inner">
            @if (count(json_decode($data->detail)) > 0)
                <div class="cart-restaurant mb-60">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart__table">
                                <table class="cart__table--inner">
                                    <thead class="cart__table--header">
                                        <tr class="cart__table--header__items">
                                            <th class="cart__table--header__list">Sản phẩm</th>
                                        </tr>
                                    </thead>
                                    <tbody class="cart__table--body">
                                        @foreach (json_decode($data->detail) as $value)
                                            @php
                                                $dish = App\Model\Dish::find($value[0]);
                                            @endphp
                                            <tr class="cart__table--body__items">
                                                <td class="cart__table--body__list">
                                                    <div class="cart__product d-flex align-items-center">
                                                        <div class="cart__thumbnail">
                                                            <a
                                                                href="{{ route('dishs.show', ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">
                                                                <img class="border-radius-5"
                                                                    src="{{ asset($dish->image) }}"
                                                                    alt="cart-product">
                                                            </a>
                                                        </div>
                                                        <div class="cart__content">
                                                            <h3 class="cart__content--title h4"><a
                                                                    href="{{ route('dishs.show', ['id' => $dish->id, 'name_link' => $dish->name_link]) }}">{{ $dish->name }}
                                                                    ({{ $value[1] }})
                                                                </a>
                                                            </h3>
                                                            <span class="cart__content--variant">Giá:
                                                                <span
                                                                    class="cart__price">{{ number_format($dish->price) }}VND</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

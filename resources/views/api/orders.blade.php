<ответ>
    <КомпанияПолучатель>
        <ИНН>{{ $orders[0]->buyerUser->inn }}</ИНН>
        <ID>{{ $orders[0]->buyerUser->uuid }}</ID>
    </КомпанияПолучатель>
    @foreach($orders as $order)
        <Заказ>
            <КомпанияОтправитель>
                <ИНН>{{ $order->senderUser->inn }}</ИНН>
                <ID>{{ $order->senderUser->uuid }}</ID>
            </КомпанияОтправитель>
            @foreach($order->priceItems()->get() as $item)
                <Товар>
                    <цена>{{ $item->price }}</цена>
                    <колво>{{ $item->pivot->quantity }}</колво>
                    <едизм>{{ $item->measure }}</едизм>
                    <ID>{{ $item->uuid }}</ID>
                </Товар>
            @endforeach
            <ID>{{ $order->uuid }}</ID>
            <LaravelOrderId>{{ $order->id }}</LaravelOrderId>
        </Заказ>
    @endforeach
</ответ>

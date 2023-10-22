<div class="row">
    @foreach ($employee as $item)
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart f-36 text-info"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">{{ $item->name }}</h6>
                            <small class="text-muted">Total Input Paket Oleh {{ $item->name }}</small>
                            <h2 class="m-b-0">{{ App\Models\OrderStatus::getCountInput($item->id) }} </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>

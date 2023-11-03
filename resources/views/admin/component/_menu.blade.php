<div class="row">
    <div class="col-12 my-3">
        <h2 class="text-center text-muted"> Daftar Menu </h2>
    </div>
    @foreach ($menu as $item)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto mb-2">
                            <img src="{{ $item->thumbnail != '' ? Storage::url($item->thumbnail) : asset('img/no-image.jpg') }}"
                                style="width: 150px; height:150px; object-fit:cover;">
                        </div>
                        <div class="col-auto">
                            <h5 class="text-primary">{{ $item->name }}</h5>
                            <small class="text-muted">{{ $item->description }}</small>
                            <h2 class="m-b-0 text-danger">Rp {{ number_format($item->price) }} </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

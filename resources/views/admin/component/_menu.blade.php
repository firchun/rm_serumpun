<div class="row">
    <div class="col-12 my-3">
        <h2 class="text-center text-muted"> Daftar Menu </h2>
    </div>
    @foreach ($menu as $item)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header p-3">
                    <span class="text-primary">{{ $item->name }}</span>
                </div>
                <div class="card-body p-2">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto mb-2">
                            <img src="{{ $item->thumbnail != '' ? Storage::url($item->thumbnail) : asset('img/no-image.jpg') }}"
                                style="width: 80px; height:80px; object-fit:cover;">
                        </div>
                        <div class="col-auto">
                            <small class="text-muted">{{ $item->description }}</small><br>
                            <span class="m-b-0 text-danger">Rp {{ number_format($item->price) }} </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

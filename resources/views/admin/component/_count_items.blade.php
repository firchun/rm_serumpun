<div class="card flat-card">

    <div class="row-table">
        <div class="col-sm-6 card-body br">
            <div class="row">
                <div class="col-sm-4">
                    <i class="icon feather icon-layers text-primary mb-1 d-block"></i>
                </div>
                <div class="col-sm-8 text-md-center">
                    <h5>{{ $menu->count() }}</h5>
                    <span>Menu </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 d-none d-md-table-cell d-lg-table-cell d-xl-table-cell card-body br">
            <div class="row">
                <div class="col-sm-4">
                    <i class="icon feather icon-shopping-cart text-primary mb-1 d-block"></i>
                </div>
                <div class="col-sm-8 text-md-center">
                    <h5>{{ $pesanan }}</h5>
                    <span>Pesanan</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 card-body">
            <div class="row">
                <div class="col-sm-4">
                    <i class="icon feather icon-users text-primary mb-1 d-blockz"></i>
                </div>
                <div class="col-sm-8 text-md-center">
                    <h5>{{ $users }}</h5>
                    <span>Pelanggan</span>
                </div>
            </div>
        </div>
    </div>
</div>

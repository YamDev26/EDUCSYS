<div class="col-12 col-md-8 offset-md-2">
    @if (session('msg') && session('str') == 'danger')
    <div class="alert alert-danger text-bg-danger alert-dismissible d-flex align-items-center" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <iconify-icon icon="solar:danger-triangle-bold-duotone" class="fs-20 me-1"></iconify-icon>
        <div class="lh-1">{{ session('msg') }}</div>
    </div>
    @endif

    @if (session('msg') && session('str') == 'success')
    <div class="alert alert-success text-bg-success alert-dismissible d-flex align-items-center" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <iconify-icon icon="solar:check-read-line-duotone" class="fs-20 me-1"></iconify-icon>
        <div class="lh-1">{{ session('msg') }}</div>
        @if (session('route'))
        <strong class="mx-3">Réçu en pdf <a href="{{ session('route') }}" class="text-dark" target="_blank">ICI</a></strong>
        @endif
    </div>
    @endif


    @if (session('msg') && session('str') == 'warning')
    <div class="alert alert-warning text-bg-warning alert-dismissible d-flex align-items-center" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <iconify-icon icon="solar:shield-warning-line-duotone" class="fs-20 me-1"></iconify-icon>
        <div class="lh-1">{{ session('msg') }}</div>
        @if (session('route'))
        <strong class="mx-3">Réçu en pdf <a href="{{ session('route') }}" class="text-dark" target="_blank">ICI</a></strong>
        @endif
    </div>
    @endif

    @if (session('msg') && session('str') == 'primary')
    <div class="alert alert-primary text-bg-primary alert-dismissible d-flex align-items-center" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <iconify-icon icon="solar:bell-bing-bold-duotone" class="fs-20 me-1"></iconify-icon>
        <div class="lh-1">{{ session('msg') }}</div>
    </div>
    @endif

    @if (session('msg') && session('str') == 'info')
    <div class="alert alert-info text-bg-info alert-dismissible d-flex align-items-center" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <iconify-icon icon="solar:info-circle-bold-duotone" class="fs-20 me-1"></iconify-icon>
        <div class="lh-1">{{ session('msg') }}</div>
        @if (session('route'))
        <strong class="mx-3">Réçu en pdf <a href="{{ session('route') }}" class="text-dark" target="_blank">ICI</a></strong>
        @endif
    </div>
    @endif

</div>
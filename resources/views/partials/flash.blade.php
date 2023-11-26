{{-- Validation Error --}}
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong><i class="fa fa-exclamation-triangle fa-fw me-2" aria-hidden="true"></i>Galat</strong>
    <ul class="m-0">
        @foreach ($errors->all() as $error_message)
        <li>{{ $error_message }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" tabindex="-1"></button>
</div>
@endif
{{-- Custom Generated Warning --}}
@isset($warning)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong><i class="fa fa-exclamation-circle fa-fw me-2" aria-hidden="true"></i>Peringatan</strong>
    <p class="mb-0">{{ $warning }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" tabindex="-1"></button>
</div>
@endisset
@isset($error)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong><i class="fa fa-exclamation-triangle fa-fw me-2" aria-hidden="true"></i>Galat</strong>
    <p class="mb-0">{{ $error }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" tabindex="-1"></button>
</div>
@endisset
{{-- Custom Generated Success --}}
@if (session('success'))
<div class="alert alert-pastel-green alert-dismissible fade show" role="alert">
    <strong><i class="fa fa-check-circle fa-fw me-2" aria-hidden="true"></i>Sukses</strong>
    <p class="mb-0">{{ session('success') }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" tabindex="-1"></button>
</div>
@endif

<div class="offcanvas offcanvas-start" tabindex="-1" id="rowSeat{{ chr(65 + $row) }}">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">Chỉnh sửa hàng ghế {{ chr(65 + $row) }}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-md-12 mb-3">
                @foreach (['Ghế thường' => 1, 'Ghế VIP' => 2, 'Ghế đôi' => 3] as $label => $type)
                    <div class="form-check form-radio-primary mb-3">
                        <input class="form-check-input" type="radio"
                               name="typeSeatRow{{ chr(65 + $row) }}" value="{{ $type }}"
                               @checked($type == ($isAllRegular ? 1 : ($isAllVip ? 2 : 3)))
                               data-row="{{ chr(65 + $row) }}">
                        <label class="form-check-label">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-danger btn-remove-all mx-1" data-row="{{ chr(65 + $row) }}">
                    <i class="mdi mdi-trash-can-outline me-1"></i>Bỏ tất cả
                </button>
                <button type="button" class="btn btn-info btn-restore-all mx-1" data-row="{{ chr(65 + $row) }}">
                    <i class="ri-add-line align-bottom me-1"></i>Chọn tất cả
                </button>
            </div>
        </div>
    </div>
</div>

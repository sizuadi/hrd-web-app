<div>
    <div wire:ignore.self class="modal fade text-left modal-borderless" id="modal-change-status" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status : {{ $user->full_name ?? '' }}</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" wire:ignore
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <p>Apakah anda yakin mengganti status data ini menjadi {{ $status_name }}</p>
                        <input type="hidden" wire:model="status_id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="button" class="btn btn-primary ms-1" wire:click.prevent="updateStatus">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Submit</span>
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('add-scripts')
@endpush

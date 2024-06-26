<div id="change-password-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="top: 20%">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">&times;</span>
                    </button>
                    <b>Change password form</b>
                </div>
            </div>
            <div class="modal-body">
                <form  autocomplete="off">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon bolder"><i class="fa fa-eye-slash"></i></span>
                            <input type="password" name="password" class="form-control ch_password" placeholder="Password">
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-primary btn-round confirm_change_password">
                        <i class="fa fa-send"></i> Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="recharge-card-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="top: 20%">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">&times;</span>
                    </button>
                    <b>Recharge Card Form</b>
                </div>
            </div>
            <div class="modal-body">
                <form autocomplete="off">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon bolder"><i class="fa fa-ticket"></i></span>
                            <input type="number" name="recharge_fee" class="form-control recharge_fee" placeholder="Card Amount">
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-primary btn-round recharge_card">
                        <i class="fa fa-send"></i> Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="vehicle-details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="top: 20%">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">&times;</span>
                    </button>
                    <b>Vehicle Details</b>
                </div>
            </div>
            <div class="modal-body">
                <div id="vehicle-details-content"></div>
            </div>
        </div>
    </div>
</div>

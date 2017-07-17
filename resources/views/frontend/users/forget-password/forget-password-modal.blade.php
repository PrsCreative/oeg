<script src="{{ asset('js/forget-password.js') }}"></script>

<div class="modal fade" id="modal_forget_password" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form action="{{ route('frontend.user.forget-password.post') }}" method="post">

            {{ csrf_field() }}

            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="font-size-header">Forget Password</h1>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <input type="text" id="citizen_id" name="citizen_id" class="form-control"
                                           placeholder="Citizen ID" required />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="border-top:none;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="btn_signin" class="btn btn-primary btn-block">Send Email</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header">
                    Dear Subscriber,
                </h3><br>
                <div class="card-body">
                   @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                           {{ __('A fresh mail has been sent to your email address.') }}
                       </div>
                   @endif
                   {!! $content !!}
                </div><br>
                <div class="card-footer">
                    <h3>Regards,</h3>
                    <p>
                        <h4 class="text-primary">Super Admin</h4>
                        Bona Blogging .
                    </p>
                </div>
           </div>
       </div>
   </div>
</div>

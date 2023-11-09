@if (Session::has('error'))
<div class="alert alert-danger" role="alert">
   <span>
       <h5 class="font-weight-bold"><i class="icon fa fa-ban"></i>Error</h5>
       <p>{{Session::get('error')}}</p>
   </span>
</div>
@endif

@if (Session::has('success'))

  <div class="alert alert-success" role="alert">
    <span>
        <h5 class="font-weight-bold"><i class="icon fa fa-check"></i>Success</h5>
        <p>{{Session::get('success')}}</p>
    </span>
</div>
@endif

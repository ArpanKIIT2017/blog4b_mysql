@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="alert alert-primary alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {!! $error !!}
        </div>
    @endforeach
@endif

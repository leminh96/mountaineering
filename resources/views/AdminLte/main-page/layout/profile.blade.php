<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    
  @if (
    session()->get('admin')->photo == null ||
        session()->get('admin')->photo == '' ||
        !File::exists(public_path('img/accounts/' . session()->get('admin')->id . '/' . session()->get('admin')->photo)))
   

        <img src="{{ asset('/img/accounts/unknown.png') }}" class="rounded-circle" style="height=34px; width=34px;"   alt="Admin Image">

@else
    


        <img src="{{asset('/')}}img/accounts/{{session()->get('admin')->id}}/{{session()->get('admin')->photo}}" class="rounded-circle" style="height=34px; width=34px;"   alt="Admin Image">

@endif





    
    <div class="info">
      <a href="{{ url('/admin/accounts/profile?id=' . session()->get('admin')->id) }}" class="d-block">{{session()->get('admin')->fullname}}</a>
    </div>

  </div>
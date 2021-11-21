@extends('backend.layouts.app')

@section('content')
      <!-- Default box -->
      @include('errors.error_massege')
      <div class="card">
        <div class="card-body row">
             <div class="col-7">
                <form method="post" action="{{route('contact-submit')}}">
                    @csrf
                    <div class="form-group">
                      <label for="inputName">Name</label>
                      <input type="text" id="inputName" name="name" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label for="inputEmail">E-Mail</label>
                      <input type="email" id="inputEmail" name="email" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label for="phonename">Phone Number</label>
                      <input type="text" id="phonename" name="phone_number" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label for="inputSubject">Subject</label>
                      <input type="text" id="inputSubject" name="subject" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label for="inputMessage">Message</label>
                      <textarea id="inputMessage" class="form-control" name="message" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary" value="Send message">
                    </div>
                </form>
             </div>
        </div>
      </div>


@endsection
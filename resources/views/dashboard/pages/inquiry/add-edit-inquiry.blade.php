@extends('dashboard.layouts.index')
@section('title', 'GymBook | Inquiries')
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/page-account-settings.css') }}">

@endsection

@section('content')
    <div id="main">
        <div class="row">
            <div class="breadcrumbs-inline pt-2 " id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Inquiries</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('dashboard.inquiries.index')}}">Inquiries</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ isset($inquiry) ? 'Edit' : 'Add' }} Inquiry
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <form id="accountForm" action="{{ isset($inquiry) ? route('dashboard.inquiries.update', $inquiry) : route('dashboard.inquiries.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($inquiry))
                        @method('PUT')
                    @endif
                    <div class="row mt-4">
                        <div class="col s12 m6">

                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="club">
                                        @foreach($clubs as $club)
                                            @if(isset($inquiry))
                                                <option value="{{$club->id}}" {{$inquiry->club->id == $club->id ? 'selected' : ''}}>{{$club->club_name}}</option>
                                            @else
                                                <option value="{{$club->id}}">{{$club->club_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label>Club</label>
                                    <small class="errorTxt3" style="color: red">@error('club') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="inquiry_code" name="inquiry_code" type="text" class="validate" value="{{ isset($inquiry) ? $inquiry->inquiry_code : $code }}"
                                           data-error=".errorTxt2" readonly>
                                    <label for="inquiry_code">Inquiry Code</label>
                                    <small class="errorTxt2" style="color: red">@error('inquiry_code') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="name" name="name" type="text" class="validate" value="{{ isset($inquiry) ? $inquiry->name : old('name') }}"
                                           data-error=".errorTxt2">
                                    <label for="name">Name</label>
                                    <small class="errorTxt2" style="color: red">@error('name') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" name="email" type="email" class="validate" value="{{ isset($inquiry) ? $inquiry->email : old('email') }}"
                                           data-error=".errorTxt3">
                                    <label for="email">E-mail</label>
                                    <small class="errorTxt3" style="color: red">@error('email') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="mobile" name="mobile" type="tel" class="validate" value="{{ isset($inquiry) ? $inquiry->mobile : old('mobile') }}"
                                           data-error=".errorTxt3">
                                    <label for="mobile">Mobile</label>
                                    <small class="errorTxt3" style="color: red">@error('mobile') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="inquiry_text" name="inquiry_text" class="materialize-textarea">{{ isset($inquiry) ? $inquiry->inquiry_text : old('inquiry_text') }}</textarea>
                                    <label for="inquiry_text">Inquiry Text</label>
                                    <small class="errorTxt3" style="color: red">@error('inquiry_text') {{$message}} @enderror</small>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="row">
                                @if(\Illuminate\Support\Facades\Auth::user()->role->name == 'admin')
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">group</i>
                                        <select name="status">
                                            <option value="approved">Approved</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                        <label>Status</label>
                                        <small class="errorTxt3" style="color: red">@error('status') {{$message}} @enderror</small>
                                    </div>
                                @endif
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="enrollment_status">
                                        <option value="visitor">Visitor</option>
                                        <option value="confirmed">Confirmed</option>
                                    </select>
                                    <label>Enrollment Status</label>
                                    <small class="errorTxt3" style="color: red">@error('enrollment_status') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="followups" name="followups" class="materialize-textarea">{{ isset($inquiry) ? $inquiry->followup : old('followups') }}</textarea>
                                    <label for="followups">Followups</label>
                                    <small class="errorTxt3" style="color: red">@error('followups') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="comment" name="comment" class="materialize-textarea">{{ isset($inquiry) ? $inquiry->comments : old('comment') }}</textarea>
                                    <label for="comment">Comments</label>
                                    <small class="errorTxt3" style="color: red">@error('comments') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="note" name="note" class="materialize-textarea">{{ isset($inquiry) ? $inquiry->note : old('note') }}</textarea>
                                    <label for="note">Note</label>
                                    <small class="errorTxt3" style="color: red">@error('note') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="source" name="source" class="materialize-textarea">{{ isset($inquiry) ? $inquiry->source : old('source') }}</textarea>
                                    <label for="source">Source</label>
                                    <small class="errorTxt3" style="color: red">@error('comments') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="reference" name="reference" type="text" class="validate" value="{{ isset($inquiry) ? $inquiry->reference : old('reference') }}"
                                           data-error=".errorTxt2">
                                    <label for="reference">Reference</label>
                                    <small class="errorTxt2" style="color: red">@error('reference') {{$message}} @enderror</small>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 display-flex justify-content-end mt-3 mb-3">
                            <button type="submit" class="btn indigo">
                                Save changes</button>
                            <button type="button" class="btn btn-light">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script defer>
        $(document).ready(function () {
            // upload button converting into file button
            $("#select-files").on("click", function (e) {
                e.preventDefault();
                $("#upfile").click();
            });
            $('#upfile').change(function(e) {
                var fileName = e.target.files[0];
                if (fileName){
                    var reader = new FileReader();
                    reader.onload = function(){
                        $("#preview-image").attr("src", reader.result);
                    }
                    reader.readAsDataURL(fileName);
                }
                $("#select-files").text(e.target.files[0].name);
                $("#select-files").prop('disabled', true);

            });

            $("#reset").on("click", function (e) {
                e.preventDefault();
                $("#upfile").val("");
                $("#preview-image").attr("src", "/images/avatar/avatar-12.png");
                $("#select-files").prop('disabled', false);
                $("#select-files").text("Upload New");
            });
        });
    </script>



@endsection

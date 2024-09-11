@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Message</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Chat Box</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-3">
                    <div class="card" style="height: 70vh">
                        <div class="card-header">
                            <h4>Who's Online?</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($chatUsers as $chatUser)
                                <li class="media chat-user-profile" data-id="{{$chatUser->senderProfile->id}}">
                                    <img alt="image" class="mr-3 rounded-circle" width="50"
                                        src="{{asset($chatUser->senderProfile->image)}}">
                                    <div class="media-body">
                                        <div class="mt-0 mb-1 font-weight-bold chat-user-name">{{$chatUser->senderProfile->name}}</div>
                                        {{-- <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i>
                                            Online</div> --}}
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card chat-box" id="mychatbox" style="height: 70vh">
                        <div class="card-header">
                            <h4 id="inbox-title"></h4>
                        </div>
                        <div class="card-body chat-content">
                        </div>
                        <div class="card-footer chat-form">
                            <form id="message-form">
                                <input type="text" class="form-control message-box" placeholder="Type a message" name="message">
                                <input type="hidden" name="receiver_id" id="receiver_id" value="">
                                <button class="btn btn-primary">
                                    <i class="far fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const mainChatInbox = $('.chat-content');

        function formatDataTime(dateTimeString){
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
            }
            const formatedDataTime = new Intl.DateTimeFormat('en-us', options).format(new Date(dateTimeString));
            return formatedDataTime;
        }

        function scrollTobottom() {
            mainChatInbox.scrollTop(mainChatInbox.prop("scrollHeight"))
        }
        $(document).ready(function(){
            $('.chat-user-profile').on('click', function(){
                let receiverId = $(this).data('id');
                let receiverImage = $(this).find('img').attr('src')
                let chatUsername = $(this).find('.chat-user-name').text();
                $('#receiver_id').val(receiverId);
                
                $.ajax({
                    method: 'GET',
                    url:"{{route('admin.get-messages')}}",
                    data: {
                        receiver_id: receiverId
                    },
                    beforeSend: function(){
                        mainChatInbox.html("");
                        //set chat inbox title
                        $('#inbox-title').text(`Chat with ${chatUsername}`)
                    },
                    success: function(response){

                        $.each(response, function(index, value){
                            if (value.sender_id == User.id) {
                                var message = `<div class="chat-item chat-right" style=""><img src="${User.image}" style="height: 50px; object-fit: cover;"><div class="chat-details"><div class="chat-text">${value.message}</div><div class="chat-time">${formatDataTime(value.created_at)}</div></div></div>`
                            }else {
                                 var message = `<div class="chat-item chat-left" style=""><img src="${receiverImage}"><div class="chat-details"><div class="chat-text">${value.message}</div><div class="chat-time">${formatDataTime(value.created_at)}</div></div></div>`
                            }
                                mainChatInbox.append(message);
                        });
                        //scroll to bottom
                        scrollTobottom();
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    },
                    complete: function(){
                        
                    }
                })

            })

            $('#message-form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let messageData = $('.message-box').val();

                var formSubmitting = false;

                if (formSubmitting || messageData === "") {
                    return;
                }

                //set message in inbox

                let message = `<div class="chat-item chat-right" style=""><img src="${User.image}" style="height: 50px; object-fit: cover;"><div class="chat-details"><div class="chat-text">${messageData}</div></div></div>`

                mainChatInbox.append(message);
                //scroll to bottom
                scrollTobottom();

                $.ajax({
                    method: 'POST',
                    url: "{{ route('user.send-messages') }}",
                    data: formData,
                    beforeSend: function() {
                        $('.send-button').prop('disable', true);
                        formSubmitting = true;
                    },
                    success: function(response) {
                        $('.message-box').val('');
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                        $('.send-button').prop('disable', true);
                        formSubmitting = false;

                    },
                    complete: function() {
                        $('.send-button').prop('disable', false);
                        formSubmitting = false;

                    }
                })
            })
        })
    </script>
@endpush

@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-star" aria-hidden="true"></i> Message</h3>
                        <div class="wsus__dashboard_review">
                            <div class="row">
                                <div class="col-xl-4 col-md-5">
                                    <div class="wsus__chatlist d-flex align-items-start" style="height: 99vh">
                                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <h2>Seller List</h2>
                                            <div class="wsus__chatlist_body">
                                                @foreach ($chatUsers as $chatUser)
                                                @php
                                                    $unseenMessages = \App\Models\Chat::where(['sender_id' => $chatUser->senderProfile->id, 'receiver_id' => auth()->user()->id, 'seen' => 0])->exists();
                                                @endphp
                                                    <button class="nav-link chat-user-profile"
                                                        data-id="{{ $chatUser->senderProfile->id }}" data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-home" type="button" role="tab"
                                                        aria-controls="v-pills-home" aria-selected="true">
                                                        <div class="wsus_chat_list_img {{$unseenMessages ? 'msg-notification' : ''}}">
                                                            <img src="{{ asset($chatUser->senderProfile->image) }}"
                                                                alt="user" class="img-fluid">
                                                            <span class="pending d-none" id="pending-6">0</span>
                                                        </div>
                                                        <div class="wsus_chat_list_text">
                                                            <h4>{{ $chatUser->senderProfile->name }}</h4>
                                                        </div>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-md-7">
                                    <div class="wsus__chat_main_area">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show" id="v-pills-home" role="tabpanel"
                                                aria-labelledby="v-pills-home-tab">
                                                <div id="chat_box">
                                                    <div class="wsus__chat_area" style="position: relative; height: 99vh;">
                                                        <div class="wsus__chat_area_header">
                                                            <h2 id="chat-inbox-title">Chat with Daniel Paul</h2>
                                                        </div>
                                                        <div class="wsus__chat_area_body" data-index="">

                                                        </div>
                                                        <div class="wsus__chat_area_footer"
                                                            style="
                                                        width: 100%;
                                                        bottom: 0;">
                                                            <form id="message-form">
                                                                @csrf
                                                                <input type="text" placeholder="Type Message"
                                                                    class="message-box" autocomplete="off" name="message">
                                                                <input type="hidden" name="receiver_id" value=""
                                                                    id="receiver_id">
                                                                <button type="submit"><i
                                                                        class="fas fa-paper-plane send-button"
                                                                        aria-hidden="true"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const mainChatInbox = $('.wsus__chat_area_body');

        function formatDataTime(dateTimeString) {
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
        $(document).ready(function() {
            $('.chat-user-profile').on('click', function() {
                let receiverId = $(this).data('id');
                let senderImage = $(this).find('img').attr('src');
                let chatUsername = $(this).find('h4').text();
                $('#receiver_id').val(receiverId);
                mainChatInbox.attr('data-inbox', receiverId);
                $(this).find('.wsus_chat_list_img').removeClass('msg-notification');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.get-messages') }}",
                    data: {
                        receiver_id: receiverId
                    },
                    beforeSend: function() {
                        mainChatInbox.html("");
                        //set chat inbox title
                        $('#chat-inbox-title').text(`Chat with ${chatUsername}`)
                    },
                    success: function(response) {

                        $.each(response, function(index, value) {

                            if (value.sender_id == User.id) {
                                var message = `<div class="wsus__chat_single single_chat_2">
                                        <div class="wsus__chat_single_img">
                                            <img src="${User.image}"
                                                alt="user" class="img-fluid">
                                        </div>
                                        <div class="wsus__chat_single_text">
                                            <p>${value.message}</p>
                                            <span>${formatDataTime(value.created_at)}</span>
                                        </div>
                                    </div>`
                            }else {
                                var message = `<div class="wsus__chat_single">
                                        <div class="wsus__chat_single_img">
                                            <img src="${senderImage}"
                                                alt="user" class="img-fluid">
                                        </div>
                                        <div class="wsus__chat_single_text">
                                            <p>${value.message}</p>
                                            <span>${formatDataTime(value.created_at)}</span>
                                        </div>
                                    </div>`
                            }
                            mainChatInbox.append(message);
                        });
                        //scroll to bottom
                        scrollTobottom();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                    complete: function() {

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
                let message = `
                    <div class="wsus__chat_single single_chat_2">
                        <div class="wsus__chat_single_img">
                            <img src="${User.image}"
                                alt="user" class="img-fluid">
                        </div>
                        <div class="wsus__chat_single_text">
                            <p>${messageData}</p>
                            <span></span>
                        </div>
                    </div>`

                mainChatInbox.append(message);
                $('.message-box').val('');
                //scroll to bottom
                scrollTobottom();

                $.ajax({
                    method: 'POST',
                    url: "{{ route('vendor.send-messages') }}",
                    data: formData,
                    beforeSend: function() {
                        $('.send-button').prop('disable', true);
                        formSubmitting = true;
                    },
                    success: function(response) {
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

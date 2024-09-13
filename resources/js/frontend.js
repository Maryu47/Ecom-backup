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

window.Echo.private('message.'+User.id).listen(
    "MessageEvent",
    (e) => {
        let mainChatBox = $('.wsus__chat_area_body');
        if (mainChatBox.attr('data-inbox') == e.sender_id) {
            var message = `
            <div class="wsus__chat_single">
                <div class="wsus__chat_single_img">
                    <img src="${e.sender_image}"
                        alt="user" class="img-fluid">
                </div>
                <div class="wsus__chat_single_text">
                    <p>${e.message}</p>
                    <span>${formatDataTime(e.date_time)}</span>
                </div>
            </div>`
        }

        mainChatBox.append(message);
        scrollTobottom();

        //add notification circle in profile
        $('.chat-user-profile').each(function(){
            let profileUserId = $(this).data('id');
            if (profileUserId == e.sender_id) {
                $(this).find('.wsus_chat_list_img').addClass('msg-notification');
            }
        })
    }
)
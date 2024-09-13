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
        let mainChatBox = $('.chat-content');
        if (mainChatBox.attr('data-inbox') == e.sender_id) {
            var message = `<div class="chat-item chat-left" style=""><img src="${e.sender_image}"><div class="chat-details"><div class="chat-text">${e.message}</div><div class="chat-time">${formatDataTime(e.date_time)}</div></div></div>`
        }

        
        mainChatBox.append(message);
        scrollTobottom()

        //add notification circle in profile
        $('.chat-user-profile').each(function(){
            let profileUserId = $(this).data('id');
            if (profileUserId == e.sender_id) {
                $(this).find('img').addClass('msg-notification');
            }
        })
    }
)
$(document).ready(function () {
    const API = '/IATH_WEB_Basque_Country/php_helpers/api';
    let chatUserId = null;
    let chatUserName = '';
    let lastMessageId = 0;
    let chatPollTimer = null;
    let onlinePollTimer = null;

    // ===== Tab Switching =====
    $('.panel-link').on('click', function (e) {
        e.preventDefault();
        const tab = $(this).data('tab');
        
        $('.panel-link').removeClass('active');
        $(this).addClass('active');
        
        $('.tab-pane').removeClass('active');
        $('#tab-' + tab).addClass('active');

        // Start polling when on friends tab
        if (tab === 'friends') {
            loadOnlineUsers();
            startOnlinePolling();
        } else {
            stopOnlinePolling();
        }
    });

    // ===== Profile Form =====
    $('#profile-form').on('submit', function (e) {
        e.preventDefault();
        const $msg = $('#profile-msg');
        $msg.text('').removeClass('success error');

        const data = {};
        const username = $('#inp-username').val().trim();
        const email = $('#inp-email').val().trim();
        const age = $('#inp-age').val();
        const gender = $('#inp-gender').val();
        const currentPw = $('#inp-current-pw').val();
        const newPw = $('#inp-new-pw').val();

        if (username) data.username = username;
        if (email) data.email = email;
        if (age) data.age = parseInt(age);
        if (gender) data.gender = gender;
        if (newPw) {
            data.current_password = currentPw;
            data.new_password = newPw;
        }

        $.ajax({
            url: API + '/update_profile.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (res) {
                if (res.success) {
                    $msg.text('✓ Profile updated!').addClass('success');
                    if (data.username) {
                        $('.avatar-name').text(data.username);
                        $('.welcome-text strong').text(data.username);
                    }
                    $('#inp-current-pw, #inp-new-pw').val('');
                } else {
                    $msg.text('✗ ' + res.error).addClass('error');
                }
            },
            error: function () {
                $msg.text('✗ Connection error').addClass('error');
            }
        });
    });

    // ===== Heartbeat (Online Status) =====
    function sendHeartbeat() {
        $.post(API + '/heartbeat.php');
    }
    sendHeartbeat();
    setInterval(sendHeartbeat, 30000);

    // ===== Online Users =====
    function loadOnlineUsers() {
        $.getJSON(API + '/get_online_users.php', function (res) {
            const $list = $('#online-users-list');
            if (!res.success || res.users.length === 0) {
                $list.html('<div class="no-users">No users online</div>');
                return;
            }

            let html = '';
            res.users.forEach(function (u) {
                const isActive = chatUserId == u.id ? ' active' : '';
                html += '<div class="user-item' + isActive + '" data-id="' + u.id + '" data-name="' + u.username + '">' +
                    '<span class="user-item-dot"></span>' +
                    u.username +
                    '</div>';
            });
            $list.html(html);
        });
    }

    function startOnlinePolling() {
        stopOnlinePolling();
        onlinePollTimer = setInterval(loadOnlineUsers, 10000);
    }

    function stopOnlinePolling() {
        if (onlinePollTimer) {
            clearInterval(onlinePollTimer);
            onlinePollTimer = null;
        }
    }

    // Click on a user to open chat
    $(document).on('click', '.user-item', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        openChat(id, name);
        
        $('.user-item').removeClass('active');
        $(this).addClass('active');
    });

    // ===== Chat =====
    function openChat(userId, userName) {
        chatUserId = userId;
        chatUserName = userName;
        lastMessageId = 0;

        $('.chat-placeholder').hide();
        $('#chat-active').show();
        $('#chat-header .chat-with').text('Chat with ' + userName);
        $('#chat-messages').empty();
        $('#chat-input').val('').focus();

        loadMessages(false);
        startChatPolling();
    }

    function closeChat() {
        chatUserId = null;
        chatUserName = '';
        lastMessageId = 0;
        stopChatPolling();

        $('#chat-active').hide();
        $('.chat-placeholder').show();
        $('.user-item').removeClass('active');
    }

    $('#chat-close-btn').on('click', closeChat);

    function loadMessages(polling) {
        if (!chatUserId) return;

        let url = API + '/get_messages.php?user_id=' + chatUserId;
        if (polling && lastMessageId > 0) {
            url += '&after_id=' + lastMessageId;
        }

        $.getJSON(url, function (res) {
            if (!res.success) return;

            const $container = $('#chat-messages');

            if (!polling) {
                $container.empty();
            }

            res.messages.forEach(function (m) {
                appendMessage(m);
                if (m.id > lastMessageId) lastMessageId = m.id;
            });

            if (!polling || res.messages.length > 0) {
                $container.scrollTop($container[0].scrollHeight);
            }
        });
    }

    function appendMessage(m) {
        const cls = m.is_mine ? 'msg-mine' : 'msg-other';
        const time = new Date(m.sent_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const html = '<div class="msg-bubble ' + cls + '">' +
            '<div>' + m.message + '</div>' +
            '<div class="msg-time">' + time + '</div>' +
            '</div>';
        $('#chat-messages').append(html);
    }

    function startChatPolling() {
        stopChatPolling();
        chatPollTimer = setInterval(function () {
            loadMessages(true);
        }, 3000);
    }

    function stopChatPolling() {
        if (chatPollTimer) {
            clearInterval(chatPollTimer);
            chatPollTimer = null;
        }
    }

    // Send message
    $('#chat-form').on('submit', function (e) {
        e.preventDefault();
        const msg = $('#chat-input').val().trim();
        if (!msg || !chatUserId) return;

        $('#chat-input').val('');

        $.ajax({
            url: API + '/send_message.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ receiver_id: chatUserId, message: msg }),
            success: function (res) {
                if (res.success && res.message) {
                    appendMessage(res.message);
                    if (res.message.id > lastMessageId) lastMessageId = res.message.id;
                    $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
                }
            }
        });
    });

    // ===== Auto-load friends tab if hash is #friends =====
    function handleHash() {
        if (window.location.hash) {
            const hash = window.location.hash.replace('#', '');
            const $link = $('.panel-link[data-tab="' + hash + '"]');
            if ($link.length) {
                $link.trigger('click');
                // Scroll to content for mobile
                if (window.innerWidth < 768) {
                    document.querySelector('.panel-content').scrollIntoView({ behavior: 'smooth' });
                }
            }
        }
    }

    handleHash();
    window.addEventListener('hashchange', handleHash);
});

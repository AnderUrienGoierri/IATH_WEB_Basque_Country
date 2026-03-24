$(document).ready(function () {
    const API = '/IATH_WEB_Basque_Country/php_helpers/api';
    let chatUserId = null;
    let chatUserName = '';
    let lastMessageId = 0;
    let chatPollTimer = null;
    let friendsPollTimer = null;

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
            loadFriends();
            loadFriendRequests();
            startFriendsPolling();
        } else {
            stopFriendsPolling();
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

    // ===== Friend Search =====
    let searchTimeout = null;
    $('#friend-search-input').on('input', function() {
        clearTimeout(searchTimeout);
        const query = $(this).val().trim();
        const $results = $('#friend-search-results');

        if (query.length < 3) {
            $results.hide().empty();
            return;
        }

        searchTimeout = setTimeout(() => {
            $.getJSON(API + '/search_users.php?q=' + encodeURIComponent(query), function(res) {
                if (!res.success || res.users.length === 0) {
                    $results.html('<div class="no-results" style="padding:1rem;color:var(--slate-500);font-size:0.8rem;">No users found</div>').show();
                    return;
                }

                let html = '';
                res.users.forEach(u => {
                    let actionHtml = '';
                    if (!u.friend_status) {
                        actionHtml = `<button class="btn-add-friend" data-id="${u.id}">Add Friend</button>`;
                    } else if (u.friend_status === 'pending') {
                        actionHtml = u.is_sender ? '<span class="status-label">Request Sent</span>' : '<span class="status-label">Pending...</span>';
                    } else if (u.friend_status === 'accepted') {
                        actionHtml = '<span class="status-label">Friends</span>';
                    }

                    html += `
                        <div class="search-result-item">
                            <div class="search-result-info">
                                <span class="sr-username">${u.username}</span>
                                <span class="sr-email">${u.email}</span>
                            </div>
                            <div class="sr-actions">${actionHtml}</div>
                        </div>
                    `;
                });
                $results.html(html).show();
            });
        }, 300);
    });

    // Hide search results when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-box').length) {
            $('#friend-search-results').hide();
        }
    });

    // Send Friend Request
    $(document).on('click', '.btn-add-friend', function() {
        const targetId = $(this).data('id');
        const $btn = $(this);
        $btn.prop('disabled', true).text('Sending...');

        $.ajax({
            url: API + '/friend_actions.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ action: 'send_request', target_id: targetId }),
            success: function(res) {
                if (res.success) {
                    $btn.parent().html('<span class="status-label">Request Sent</span>');
                    loadFriendRequests();
                } else {
                    alert(res.error || 'Failed to send request');
                    $btn.prop('disabled', false).text('Add Friend');
                }
            }
        });
    });

    // ===== Friend Requests =====
    function loadFriendRequests() {
        $.getJSON(API + '/get_friend_requests.php', function(res) {
            const $container = $('#friend-requests-container');
            const $list = $('#incoming-requests');

            if (!res.success || res.incoming.length === 0) {
                $container.hide();
                return;
            }

            let html = '';
            res.incoming.forEach(r => {
                html += `
                    <div class="request-item" data-id="${r.user_id}">
                        <div class="request-info">
                            <span class="sr-username">${r.username}</span>
                        </div>
                        <div class="request-actions">
                            <button class="btn-request btn-accept" data-id="${r.user_id}">Accept</button>
                            <button class="btn-request btn-decline" data-id="${r.user_id}">Decline</button>
                        </div>
                    </div>
                `;
            });
            $list.html(html);
            $container.show();
        });
    }

    $(document).on('click', '.btn-request', function() {
        const targetId = $(this).data('id');
        const action = $(this).hasClass('btn-accept') ? 'accept_request' : 'decline_request';
        
        $.ajax({
            url: API + '/friend_actions.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ action: action, target_id: targetId }),
            success: function(res) {
                if (res.success) {
                    loadFriendRequests();
                    loadFriends();
                } else {
                    alert(res.error || 'Action failed');
                }
            }
        });
    });

    // ===== Friends List =====
    function loadFriends() {
        $.getJSON(API + '/get_friends.php', function (res) {
            const $list = $('#friends-list');
            if (!res.success || res.friends.length === 0) {
                $list.html('<div class="no-users">No friends added yet</div>');
                return;
            }

            let html = '';
            res.friends.forEach(function (u) {
                const isActive = chatUserId == u.id ? ' active' : '';
                const onlineClass = u.is_online ? '' : ' offline';
                html += `
                    <div class="user-item${isActive}" data-id="${u.id}" data-name="${u.username}">
                        <span class="user-item-dot${onlineClass}"></span>
                        ${u.username}
                    </div>
                `;
            });
            $list.html(html);
        });
    }

    function startFriendsPolling() {
        stopFriendsPolling();
        friendsPollTimer = setInterval(() => {
            loadFriends();
            loadFriendRequests();
        }, 10000);
    }

    function stopFriendsPolling() {
        if (friendsPollTimer) {
            clearInterval(friendsPollTimer);
            friendsPollTimer = null;
        }
    }

    // Click on a friend to open chat
    $(document).on('click', '.user-item', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        openChat(id, name);
        
        $('.user-item').removeClass('active');
        $(this).addClass('active');
    });

    // Remove Friend
    $('#btn-remove-friend').on('click', function() {
        if (!chatUserId) return;
        if (!confirm('Are you sure you want to remove ' + chatUserName + ' from your friends?')) return;

        $.ajax({
            url: API + '/friend_actions.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ action: 'remove_friend', target_id: chatUserId }),
            success: function(res) {
                if (res.success) {
                    closeChat();
                    loadFriends();
                } else {
                    alert(res.error || 'Failed to remove friend');
                }
            }
        });
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="assets/style.css" rel="stylesheet" type="text/css">
</head>
<?php
session_start();

if (!isset($_SESSION['isLogged']) || !$_SESSION['isLogged']) {
    header("Location: login.php");
    exit();
}
?>

<body>
    <div class="container page chat">
        <div class="d-flex flex-rows flex-nowrap">
            <div class="sidebar">
                <h2>Contact</h2>
                <div class="contact-list mt-4">

                </div>
            </div>
            <div class="content">
                <div class="chat__header header">
                    <div class="d-flex flex-rows flex-nowrap">
                        <div class="chat__header__img">
                            <img src="https://cdn.yumereality.id/images/sena.jpg" />
                        </div>
                        <div class="chat-list__details ms-3">
                            <h3>Nekoyama Sena</h3>
                            <p>Online</p>
                        </div>
                    </div>
                </div>
                <div class="chat-content">
                </div>
                <div class="chat-input">
                    <div class="chat-input__content px-3 py-1" contenteditable="true" data-placeholder="Send Messages..."></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        let currentChatId = null;
        let users = [];
        let userId = localStorage.getItem("user_id");
        let chatCount = 0;

        function selectUser(id) {
            const selectedUser = users.find(x => x.id == id);
            currentChatId = selectedUser.id;
            $(".chat-list__details h3").text(selectedUser.fullname);
            $(".chat__header__img ").html(`<img src="https://ui-avatars.com/api/?name=${selectedUser.fullname}&size=100&rounded=true&background=random" />`)
            getChat(selectedUser.id, true, false);
        }

        $(".chat-input__content").on("keyup", function(e) {
            const code = e.keyCode || e.which;
            if (code == 13) {
                sendChat($(".chat-input__content").text())
                $(".chat-input__content").text("")
            }
        })

        function getChat(id, selected = false, animated = true) {
            $.get("./API/getChat.php", {
                senderId: userId,
                receiveId: id || currentChatId
            }, (res) => {
                if (!res.includes("<br />")) {
                    const data = JSON.parse(res);
                    $(".chat-content").html("");
                    if (chatCount != data.length)
                        selected = true;

                    chatCount = data.length;
                    data.forEach(e => {
                        const date = new Date(e.time_send);
                        const dateTrim = date.toLocaleString('en-US', {
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        });

                        let type = "default"
                        if (e.id_users_sender == userId)
                            type = "me";
                        $(".chat-content").append(`
                    <div class="chat__bubble__wrapper">
                        <div class="chat__bubble ${type}">
                            <div class="chat__bubble__box ${type}">
                                <p>${e.msg}</p>
                            </div>
                        </div>
                        <div class="time ${type}">
                            <p>${dateTrim}</p>
                        </div>
                    </div>
                    `)


                    });
                    if (selected) {
                        if (animated) {
                            $('.chat-content').animate({
                                scrollTop: $('.chat-content').get(0).scrollHeight
                            }, 500);
                        } else {
                            $('.chat-content').scrollTop($('.chat-content').get(0).scrollHeight)
                        }
                    }
                } else {
                    $(".chat-content").html("");

                }

            }).fail(function() {
                $(".chat-content").html("");

            })
        }


        function sendChat(msg) {
            $.get("./API/sendChat.php", {
                msg,
                senderId: userId,
                receiveId: currentChatId
            }, (res) => {
                getChat(null, true);
            })
        }

        $(document).ready(function() {
            $.get({
                url: "./API/getAllUsers.php",
                success: (res) => {
                    var data = JSON.parse(res);
                    users = data;
                    currentChatId = data[0].id
                    if (userId == currentChatId) {
                        currentChatId = data[1].id;
                    }
                    data.forEach((e) => {
                        if (e.id == localStorage.getItem("user_id"))
                            return;

                        $(".contact-list").append(`
                    <div class="d-flex flex-rows flex-nowrap align-items-center" onClick="selectUser(${e.id})">
                        <div class="contact-list__img">
                            <img src="https://ui-avatars.com/api/?name=${e.fullname}&size=100&rounded=true&background=random" />
                        </div>
                        <div class="contact-list__details">
                            <h3>${e.fullname}</h3>
                        </div>
                    </div>
                    `)
                    });
                    selectUser(currentChatId);

                }
            })
            setInterval(() => {
                getChat();
            }, 1000);
        });
    </script>
</body>

</html>
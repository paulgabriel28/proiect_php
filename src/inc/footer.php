<style type="text/css">
    body {
        margin-top: 20px;
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;
    }

    .main-body {
        padding: 15px;
    }

    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }

    .h-100 {
        height: 100% !important;
    }

    .shadow-none {
        box-shadow: none !important;
    }

    .label {
        padding: 3px 10px;
        line-height: 13px;
        color: #fff;
        font-weight: 400;
        border-radius: 4px;
        font-size: 75%
    }

    .label-rounded {
        border-radius: 60px
    }

    .label-custom {
        background-color: #00897b
    }

    .label-success {
        background-color: #26c6da
    }

    .label-info {
        background-color: #1e88e5
    }

    .label-warning {
        background-color: #ffb22b
    }

    .label-danger {
        background-color: #fc4b6c
    }

    .label-megna {
        background-color: #00897b
    }

    .label-primary {
        background-color: #7460ee
    }

    .label-purple {
        background-color: #7460ee
    }

    .label-red {
        background-color: #fb3a3a
    }

    .label-inverse {
        background-color: #2f3d4a
    }

    .label-default {
        background-color: #323840
    }

    .label-white {
        background-color: #fff
    }

    .label-light-success {
        background-color: #e8fdeb;
        color: #26c6da
    }

    .label-light-info {
        background-color: #cfecfe;
        color: #1e88e5
    }

    .label-light-warning {
        background-color: #fff8ec;
        color: #ffb22b
    }

    .label-light-danger {
        background-color: #f9e7eb;
        color: #fc4b6c
    }

    .label-light-megna {
        background-color: #e0f2f4;
        color: #00897b
    }

    .label-light-primary {
        background-color: #f1effd;
        color: #7460ee
    }

    .label-light-inverse {
        background-color: #f6f6f6;
        color: #2f3d4a
    }

    .card {
        background: #fff;
        transition: .5s;
        border: 0;
        margin-bottom: 30px;
        border-radius: .55rem;
        position: relative;
        width: 100%;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
    }

    .chat-app .people-list {
        width: 280px;
        position: absolute;
        left: 0;
        top: 0;
        padding: 20px;
        z-index: 7
    }

    .chat-app .chat {
        margin-left: 280px;
        border-left: 1px solid #eaeaea
    }

    .people-list {
        -moz-transition: .5s;
        -o-transition: .5s;
        -webkit-transition: .5s;
        transition: .5s
    }

    .people-list .chat-list li {
        padding: 10px 15px;
        list-style: none;
        border-radius: 3px
    }

    .people-list .chat-list li:hover {
        background: #efefef;
        cursor: pointer
    }

    .people-list .chat-list li.active {
        background: #efefef
    }

    .people-list .chat-list li .name {
        font-size: 15px
    }

    .people-list .chat-list img {
        width: 45px;
        border-radius: 50%
    }

    .people-list img {
        float: left;
        border-radius: 50%
    }

    .people-list .about {
        float: left;
        padding-left: 8px
    }

    .people-list .status {
        color: #999;
        font-size: 13px
    }

    .chat .chat-header {
        padding: 15px 20px;
        border-bottom: 2px solid #f4f7f6
    }

    .chat .chat-header img {
        float: left;
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-header .chat-about {
        float: left;
        padding-left: 10px
    }

    .chat .chat-history {
        padding: 20px;
        border-bottom: 2px solid #fff
    }

    .chat .chat-history ul {
        padding: 0
    }

    .chat .chat-history ul li {
        list-style: none;
        margin-bottom: 30px
    }

    .chat .chat-history ul li:last-child {
        margin-bottom: 0px
    }

    .chat .chat-history .message-data {
        margin-bottom: 15px
    }

    .chat .chat-history .message-data img {
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-history .message-data-time {
        color: #434651;
        padding-left: 6px
    }

    .chat .chat-history .message {
        color: #444;
        padding: 18px 20px;
        line-height: 26px;
        font-size: 16px;
        border-radius: 7px;
        display: inline-block;
        position: relative
    }

    .chat .chat-history .message:after {
        bottom: 100%;
        left: 7%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #fff;
        border-width: 10px;
        margin-left: -10px
    }

    .chat .chat-history .my-message {
        background: #efefef
    }

    .chat .chat-history .my-message:after {
        bottom: 100%;
        left: 30px;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #efefef;
        border-width: 10px;
        margin-left: -10px
    }

    .chat .chat-history .other-message {
        background: #e8f1f3;
        text-align: right
    }

    .chat .chat-history .other-message:after {
        border-bottom-color: #e8f1f3;
        left: 93%
    }

    .chat .chat-message {
        padding: 20px
    }

    .online,
    .offline,
    .me {
        margin-right: 2px;
        font-size: 8px;
        vertical-align: middle
    }

    .online {
        color: #86c541
    }

    .offline {
        color: #e47297
    }

    .me {
        color: #1d8ecd
    }

    .float-right {
        float: right;
    }

    .float {
        position: fixed;
        left: 2%;
        bottom: 0;
        width: 100%;
    }

    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0
    }

    @media only screen and (max-width: 767px) {
        .chat-app .people-list {
            height: 465px;
            width: 100%;
            overflow-x: auto;
            background: #fff;
            left: -400px;
            display: none
        }

        .chat-app .people-list.open {
            left: 0
        }

        .chat-app .chat {
            margin: 0
        }

        .chat-app .chat .chat-header {
            border-radius: 0.55rem 0.55rem 0 0
        }

        .chat-app .chat-history {
            height: 300px;
            overflow-x: auto
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 992px) {
        .chat-app .chat-list {
            height: 650px;
            overflow-x: auto
        }

        .chat-app .chat-history {
            height: 600px;
            overflow-x: auto
        }
    }

    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
        .chat-app .chat-list {
            height: 480px;
            overflow-x: auto
        }

        .chat-app .chat-history {
            height: calc(100vh - 350px);
            overflow-x: auto
        }
    }

    .message small {
        display: block;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 12px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background-color: #f5f5f5;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #17a3bb;
        border-radius: 20px;
        border: 3px solid #f5f5f5;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #0062cc;
    }

    .my-div {
        overflow-y: scroll;
        max-height: 600px;
        scrollbar-width: thin;
        scrollbar-color: #17a3bb #f5f5f5;
    }

    .my-div::-webkit-scrollbar {
        width: 12px;
    }

    .my-div::-webkit-scrollbar-track {
        background-color: #f5f5f5;
    }

    .my-div::-webkit-scrollbar-thumb {
        background-color: #17a3bb;
        border-radius: 20px;
        border: 3px solid #f5f5f5;
    }

    .my-div::-webkit-scrollbar-thumb:hover {
        background-color: #0062cc;
    }
</style>
<script>
    const chatHistory = document.querySelector('.my-div');
    chatHistory.scrollTop = chatHistory.scrollHeight;

</script>

<div class="float">
    <p>Copyright @ <a href="https://paulgabriel.ro/auth/pages/profile.php?user=paulmih5">paulgabriel</a></p>

</div>

</main>
</body>

</html>
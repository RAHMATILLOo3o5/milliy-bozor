<style>
    .chat-info {
        background-color: #F21515 !important;
    }

    .chat-list_rooms {
        border: none !important;
        height: 400px !important;
    }
    .chat-list_rooms a{
        color: #0c0c0d !important;
        text-decoration: none !important;
    }
    .chat-list_rooms a .chat-list_content{
        transition: all 0.3s ease-in-out;
    }
    .chat-list_rooms a .chat-list_content:hover{
        color: #fffacd !important;
        text-decoration: none !important;
        background: #ff1c1c !important;
    }
    .chat-list_rooms a .active{
        color: #fffacd !important;
        text-decoration: none !important;
        background: #ff1c1c !important;
    }
    .chat-column-left .chat-profile {
        background-color: #F21515 !important;
    }

    .chat-message {
        height: 410px !important;
    }

    .chat-form {
        border: none !important;
    }
</style>
<div class="px-lg-6 mt-2 mb-5">
    <div class="chat-index">
        <div class="chat-column-left">
            <div class="chat-list">
                <form class="form-inline active-pink-3 my-2 active-pink-4">
                    <input class="form-control form-control-sm ml-3 w-75 border-0" type="text" placeholder="Search"
                           aria-label="Search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </form>
                <div class="chat-list_rooms">
                    <a href="">
                        <div class="chat-list_content">
                            <div class="avatar text-center">
                                <i class="fa fa-user mt-2" style="font-size: 25px"></i>
                            </div>
                            <div class="chat-list_content_description">
                                <div class="chat-list_content_description_header">
                                    <span>Иван Иванов</span>
                                    <div class="chat-list_content_description_header_time"><span>10.12.2019</span>
                                    </div>
                                    <div class="chat-list_content_description_body">
                                        <div class="chat-list_content_description_body_message"><span>Lorem ipsum dolor sit amet.</span>
                                        </div>
                                        <div class="chat-list_content_description_body_badge">
                                            <span>3</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="chat-column-right">
            <div class="chat-info">
                <div class="chat-info_user">
                    <div class="chat-info_user_fullname">Иван Иванов</div>
                    <div class="chat-info_user_last_visit">Был в сети 34 минут</div>
                </div>
            </div>
            <div class="chat-message">
                <div class="chat-message_content interlocutor-message">
                    <div class="chat-message_content_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id
                        unde
                        laboriosam facilis esse a rem pariatur sequi doloribus corporis doloremque?
                    </div>
                    <div class="chat-message_content_date">
                        10.12.2019
                    </div>
                </div>
                <div class="chat-message_content own-message">
                    <div class="chat-message_content_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id
                        unde
                        laboriosam facilis esse a rem pariatur sequi doloribus corporis doloremque?
                    </div>
                    <div class="chat-message_content_date">
                        10.12.2019
                    </div>
                </div>
                <div class="chat-message_content interlocutor-message">
                    <div class="chat-message_content_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id
                        unde
                        laboriosam facilis esse a rem pariatur sequi doloribus corporis doloremque?
                    </div>
                    <div class="chat-message_content_date">
                        10.12.2019
                    </div>
                </div>
                <div class="chat-message_content own-message">
                    <div class="chat-message_content_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id
                        unde
                        laboriosam facilis esse a rem pariatur sequi doloribus corporis doloremque?
                    </div>
                    <div class="chat-message_content_date">
                        10.12.2019
                    </div>
                </div>
            </div>
            <div class="chat-form">
                <form action="#" class="form-inline">
                    <div class="input-group w-100">
                        <div class="input-group-prepend">
                            <label class="input-group-text">

                                <i class="fa fa-file"></i>
                            </label>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
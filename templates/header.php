<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>
<header class="header">

    <div class="flex">
        <div class="image">
            <img src="images/Logot.png" alt=" logo" style="width: 100px; height: auto;">
        </div>
        <a href="home.php" class="logo led-logo">
   <span>W</span><span>a</span><span>t</span><span>c</span><span>h</span>
   <span style="margin-left: 0.5rem;"></span>
   <span>S</span><span>h</span><span>o</span><span>p</span>
</a>

        <nav class="navbar">
            <ul>
                <li><a href="home.php">Trang Chủ</a></li>
                <li><a href="shop.php">Sản Phẩm</a></li>
                <li><a href="orders.php">Đặt Hàng</a></li>
                <li><a href="#">Liên hệ</a>
                    <ul>
                        <li><a href="about.php">Chi tiết</a></li>
                        <li><a href="contact.php">Phản hồi</a></li>
                    </ul>
                </li>
                <li><a href="#">Tài Khoản</a>
                    <ul>
                        <li><a href="login.php">Đăng Nhập</a></li>
                        <li><a href="register.php">Đăng Ký</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
            $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
            $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
            $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>

        <div class="account-box">
            <p>tên người dùng : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">Đăng xuất</a>
        </div>
    </div>

    <!-- Chatbot Icon -->
<div id="chatbotIcon" onclick="toggleChatbox()" style="position: fixed; bottom: 20px; right: 20px; cursor: pointer; z-index: 100;">
    <img src="images/a7.jpg" alt="Chatbot Icon" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; box-shadow: 0 0 10px rgba(0,0,0,0.2);">
</div>

    <!-- Chatbot Box -->
    <div id="chatbotBox">
        <div style="background: #007bff; color: #fff; padding: 10px; border-radius: 5px 5px 0 0;">
            <span>Watch Shop Chatbot</span>
            <i class="fas fa-times" style="float: right; cursor: pointer;" onclick="toggleChatbox()"></i>
        </div>
        <div id="chatMessages" style="height: 200px; overflow-y: auto; padding: 10px;"></div>
        <div style="display: flex; align-items: center; padding: 10px; border-top: 1px solid #ccc;">
            <input type="text" id="chatInput" placeholder="Nhập câu hỏi của bạn..." style="flex-grow: 1; padding: 10px; border: none;">
            <i onclick="newChat()" class="fas fa-plus-circle" style="cursor: pointer; font-size: 24px; color: #007bff; margin-left: 10px;"></i>
        </div>
    </div>

    <style>
        #chatbotBox {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 350px;
            max-width: 90%;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
            z-index: 100;
        }

        .message {
            display: flex;
            padding: 5px;
        }

        .message-user {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            padding: 8px;
            margin: 4px 0;
            border-radius: 8px;
            max-width: 80%;
            margin-left: auto;
        }

        .message-bot {
            background-color: #f0f0f0;
            color: black;
            font-weight: bold;
            font-size: 1.1rem;
            padding: 8px;
            margin: 4px 0;
            border-radius: 8px;
            max-width: 80%;
            margin-right: auto;
        }
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@700&display=swap');

.led-logo {
   font-family: 'Cinzel', serif;
   font-size: 3rem;
   font-weight: 700;
   text-transform: uppercase;
   display: flex;
   align-items: center;
   gap: 0.2rem;
   letter-spacing: 0.1rem;
}

.led-logo span {
   display: inline-block;
   animation: ledRainbow 1.5s infinite;
   text-shadow: 0 0 5px #fff;
   color: #fff;
}

.led-logo span:nth-child(1) { animation-delay: 0s; }
.led-logo span:nth-child(2) { animation-delay: 0.1s; }
.led-logo span:nth-child(3) { animation-delay: 0.2s; }
.led-logo span:nth-child(4) { animation-delay: 0.3s; }
.led-logo span:nth-child(5) { animation-delay: 0.4s; }
.led-logo span:nth-child(6) { animation-delay: 0.5s; }
.led-logo span:nth-child(7) { animation-delay: 0.6s; }
.led-logo span:nth-child(8) { animation-delay: 0.7s; }
.led-logo span:nth-child(9) { animation-delay: 0.8s; }
.led-logo span:nth-child(10) { animation-delay: 0.9s; }

@keyframes ledRainbow {
   0% {
      color: #FFD700;
      text-shadow: 0 0 10px #FFD700;
   }
   33% {
      color: #1E90FF;
      text-shadow: 0 0 10px #1E90FF;
   }
   66% {
      color: #F8F8FF;
      text-shadow: 0 0 10px #F8F8FF;
   }
   100% {
      color: #FFD700;
      text-shadow: 0 0 10px #FFD700;
   }
}

    </style>

    <script>
        function newChat() {
            var chatMessages = document.getElementById("chatMessages");
            chatMessages.innerHTML = '';
            addMessageToChat("Bot", "Xin chào! Hôm nay bạn cần giúp gì?");
        }

        function toggleChatbox() {
            var chatbox = document.getElementById("chatbotBox");
            chatbox.style.display = (chatbox.style.display === "none" || !chatbox.style.display) ? "block" : "none";
        }

        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                toggleChatbox();
                addMessageToChat("Bot", "Xin chào! Hôm nay bạn cần giúp gì?");
            }, 1000);
        });

        document.getElementById("chatInput").addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                var userMessage = this.value;
                this.value = "";
                addMessageToChat("User", userMessage);
                var reply = getReplyFor(userMessage);
                addMessageToChat("Bot", reply);
            }
        });

        function addMessageToChat(sender, message) {
            var chatMessages = document.getElementById("chatMessages");
            var messageElement = document.createElement("div");
            var contentElement = document.createElement("div");
            contentElement.textContent = message;
            contentElement.className = "content";
            messageElement.appendChild(contentElement);
            messageElement.className = sender === "User" ? "message message-user" : "message message-bot";
            chatMessages.appendChild(messageElement);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function getReplyFor(message) {
            const replies = [
                { keywords: ["chào", "hi", "hello"], response: "Xin chào! Bạn muốn tìm đồng hồ nào hôm nay?" },
                { keywords: ["omega", "speedmaster"], response: "Omega Speedmaster là lựa chọn tuyệt vời. Bạn muốn tìm mẫu nào cụ thể?" },
                { keywords: ["rolex", "gmt"], response: "Rolex GMT-Master II là dòng cao cấp. Bạn thích 'Batman' hay 'Pepsi'?" },
                { keywords: ["citizen", "eco-drive"], response: "Citizen Eco-Drive dùng năng lượng ánh sáng. Bạn muốn xem mẫu nào?" },
                { keywords: ["seiko", "automatic"], response: "Seiko automatic có độ chính xác cao. Bạn cần tìm mẫu lặn hay dresswatch?" },
                { keywords: ["casio", "g-shock"], response: "Casio G-Shock rất bền và phong cách. Bạn cần mẫu thể thao nào?" },
                { keywords: ["fossil", "quartz"], response: "Fossil quartz thiết kế trẻ trung. Bạn thích mặt trắng hay đen?" },
                { keywords: ["giá", "bảng giá"], response: "Bạn muốn biết giá mẫu đồng hồ nào? Nhập tên sản phẩm giúp tôi nhé!" },
                { keywords: ["khuyến mãi", "ưu đãi"], response: "Hiện tại có nhiều mẫu đang giảm giá. Bạn muốn xem đồng hồ của thương hiệu nào?" },
                { keywords: ["mua", "đặt hàng"], response: "Bạn có thể đặt hàng trực tuyến ngay tại website này. Cần mình hướng dẫn không?" },
                { keywords: ["bảo hành", "sửa"], response: "Tất cả sản phẩm đều có bảo hành chính hãng 12–24 tháng." },
                { keywords: ["thanh toán", "trả góp"], response: "Chúng tôi hỗ trợ thanh toán online và trả góp 0% qua thẻ tín dụng." },
                        { keywords: ["chào", "hi", "hello"], response: "Xin chào! Hôm nay bạn cần giúp gì?" },
        { keywords: ["khỏe", "sức khoẻ"], response: "Tôi là một bot, tôi không có cảm xúc nhưng cảm ơn bạn đã quan tâm. Bạn muốn hỏi gì?" },
        { keywords: ["tạm biệt", "bye"], response: "Tạm biệt! Chúc bạn một ngày tốt lành!" },
        { keywords: ["omega", "speedmaster"], response: "Omega Speedmaster là một lựa chọn tuyệt vời. Bạn muốn biết thông tin chi tiết không?" },
        { keywords: ["citizen", "tsuyosa"], response: "Citizen Tsuyosa có mặt số đẹp mắt. Bạn quan tâm đến mẫu nào, xanh băng giá hay đỏ?" },
        { keywords: ["casio", "g-shock"], response: "Casio G-Shock là lựa chọn bền bỉ và đa năng. Bạn muốn tìm mẫu nào?" },
        { keywords: ["rolex", "gmt-master"], response: "Rolex GMT-Master II là biểu tượng của sự sang trọng. Bạn muốn biết thêm về 'Batman' hay 'Pepsi'?" },
        { keywords: ["tudor", "black bay"], response: "Tudor Black Bay mang phong cách cổ điển và lịch lãm. Bạn quan tâm đến mẫu nào?" },
        { keywords: ["fossil", "quartz"], response: "Fossil Quartz với thiết kế trẻ trung, đa dạng. Bạn thích mặt số màu gì?" },
        { keywords: ["tissot", "classic"], response: "Tissot T-Classic là sự kết hợp hoàn hảo của truyền thống và hiện đại. Bạn muốn khám phá mẫu nào?" },
        { keywords: ["mua", "đồng hồ"], response: "rất vui khi được giúp đỡ. Bạn cần tham khảo những mẫu đồng hồ nào ?" },
        { keywords: ["giá", "bảng giá"], response: "Bạn muốn biết giá của mẫu đồng hồ cụ thể nào? Hãy cho tôi biết tên hoặc mã sản phẩm." },
{ keywords: ["khuyến mãi", "ưu đãi"], response: "Chúng tôi luôn có những chương trình khuyến mãi hấp dẫn. Bạn quan tâm đến sản phẩm nào?" },
{ keywords: ["bảo hành", "sửa chữa"], response: "Mỗi sản phẩm đều có chính sách bảo hành rõ ràng. Bạn cần hỗ trợ gì từ bộ phận bảo hành?" },
{ keywords: ["đặt hàng", "mua online"], response: "Bạn có thể dễ dàng đặt hàng trực tuyến qua website của chúng tôi. Bạn cần hướng dẫn không?" },
{ keywords: ["giao hàng", "vận chuyển"], response: "Chúng tôi cung cấp dịch vụ giao hàng toàn quốc. Bạn muốn giao hàng tới địa chỉ nào?" },
{ keywords: ["trả góp", "thanh toán"], response: "Chúng tôi hỗ trợ mua hàng trả góp qua nhiều hình thức. Bạn quan tâm đến phương thức nào?" },
{ keywords: ["đổi trả", "hoàn hàng"], response: "Chính sách đổi trả của chúng tôi rất linh hoạt. Bạn muốn đổi trả sản phẩm nào?" },
{ keywords: ["mới", "sản phẩm mới"], response: "Các mẫu đồng hồ mới nhất luôn được cập nhật trên website. Bạn quan tâm đến thương hiệu nào?" },
{ keywords: ["chính hãng", "authentic"], response: "Tất cả sản phẩm của chúng tôi đều là hàng chính hãng. Bạn có thể yên tâm về chất lượng." },
{ keywords: ["omega", "speedmaster"], response: "Omega Speedmaster là một trong những dòng đồng hồ kinh điển. Bạn muốn biết thông tin chi tiết?" },
{ keywords: ["citizen", "eco-drive"], response: "Dòng Citizen Eco-Drive sử dụng năng lượng ánh sáng. Bạn muốn xem các mẫu không?" },
{ keywords: ["seiko", "automatic"], response: "Seiko là thương hiệu nổi tiếng với các mẫu đồng hồ cơ tự động. Bạn quan tâm đến dòng nào?" },
{ keywords: ["casio", "g-shock"], response: "Casio G-Shock nổi tiếng với độ bền và khả năng chống sốc tốt. Bạn muốn tìm hiểu mẫu nào?" },
{ keywords: ["luxury", "cao cấp"], response: "Chúng tôi có sự lựa chọn rộng lớn các mẫu đồng hồ cao cấp. Bạn quan tâm đến thương hiệu nào?" },
{ keywords: ["thể thao", "sport"], response: "Bạn đang tìm kiếm đồng hồ thể thao? Chúng tôi có nhiều lựa chọn từ các thương hiệu nổi tiếng." },
{ keywords: ["điện tử", "digital"], response: "Đồng hồ điện tử với nhiều tính năng nổi bật. Bạn cần tính năng gì trên đồng hồ của mình?" },
{ keywords: ["tudor", "black bay"], response: "Tudor Black Bay mang đến phong cách cổ điển và mạnh mẽ. Bạn muốn xem qua các phiên bản?" },
{ keywords: ["rolex", "submariner"], response: "Rolex Submariner là biểu tượng của sự sang trọng và đẳng cấp. Bạn muốn biết thêm chi tiết?" },
{ keywords: ["fossil", "quartz"], response: "Fossil cung cấp nhiều mẫu đồng hồ Quartz thời trang và tinh tế. Bạn quan tâm đến màu sắc nào?" },
{ keywords: ["tissot", "classic"], response: "Tissot T-Classic mang lại vẻ đẹp truyền thống và lịch lãm. Bạn muốn khám phá các mẫu có sẵn?" },

            ];

            message = message.toLowerCase().trim();

            for (let i = 0; i < replies.length; i++) {
                for (let keyword of replies[i].keywords) {
                    if (message.includes(keyword)) {
                        return replies[i].response;
                    }
                }
            }

            return "Xin lỗi, tôi chưa hiểu câu hỏi của bạn. Bạn có thể nói lại rõ hơn không?";
        }
    </script>
</header>

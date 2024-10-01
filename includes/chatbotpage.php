<style>

#chat-bot-icon img {
}

.pulse-div {
  width: 250px;
  /*height: 170px;*/
  position: fixed;
  left: auto !important;
  right: 6px !important;
  bottom: 10px;
  z-index: 999999999999999 !important;
  margin: 0 auto 0;
  -webkit-perspective: 1000;
  -webkit-backface-visibility: hidden;
  background: transparent;
  box-sizing: border-box;
}

.chat-main-btn {
  font-size: 13px;
  padding: 1px;
  color: #fff;
  border-radius: 50%;
  border: 0;
  width: 60px;
  height: 60px;
  cursor: pointer;
  float: right;
  font-weight: 500;
  margin-bottom: 0;
  margin-top: 0 !important;
}

.chatbot-close {
  color: gray;
  font-weight: bold;
  font-size: 2rem;
  cursor: pointer;
}
.chatbotpophide {
  display: none;
}
.chatbot {
  /* position: absolute;
  bottom: 20;
  right: 20;*/
  position: fixed;
  left: auto !important;
  right: 143px !important;
  bottom: 116px;
}
.chatbot-container {
  width: 373px;
  border: 1px solid #ccc;
  border-radius: 10px;
  overflow: hidden;
  font-size: 14px;
  position: relative;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.chatbot-header {
  background-color: #005bff;
  color: white;
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.chatbot-title {
  font-weight: bold;
}

.chatbot-status {
  background-color: #34ca49;
  padding: 2px 8px;
  border-radius: 10px;
  font-size: 12px;
}

.chatbot-messages {
  height: 400px;
  overflow-y: auto;
  padding: 10px;
  background-color: #f9f9f9;
}

.chatbot-message p {
  display: inline-block;
  background: #e5e5e5;
  padding: 10px;
  border-radius: 15px;
  margin-bottom: 10px;
  line-height: 1.4;
  font-weight: normal !important;
}

.soft {
  font-size: small;
  color: rgb(236, 215, 215);
  text-align: center;
}

.chatbot-options {
  display: flex;
  flex-direction: column;
  padding: 10px;
}

.chatbot-options button {
  background-color: #f1f1f1;
  border: none;
  padding: 10px;
  margin-bottom: 5px;
  border-radius: 20px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.chatbot-options button:hover {
  background-color: #e2e2e2;
}

.chatbot-input {
  /*position: absolute;
  bottom: 0;*/
  width: 95%;
  padding: 1rem 0.6rem;
  /*
  
  padding: 1rem 0.2rem;
  */
  background: white;
  display: flex;
  justify-content: space-between;
}

.chatbot-input input {
  flex-grow: 1;
  border: 1px solid #ccc;
  padding: 10px;
  border-radius: 20px;
  margin-right: 10px;
}

.chatbot-input button {
  background-color: #005bff;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 20px;
  cursor: pointer;
}

.chatbot-input button:hover {
  background-color: #0041d4;
}

.right {
  text-align: right;
}

.you-reply{
    background-color: #6e00ff !important;
    color: white;

}
.smart-options {
  display: inline-block;
  background: #2b7df7;
  color: #fff;
  font-weight: bold;
  min-width: 200px;
  cursor: pointer;
  padding: 15px;
  border-radius: 15px;
  margin-bottom: 10px;
  line-height: 1.4;
  font-size: 12px;
}

</style>
<div id="chat-bot-icon" class="pulse-div" onclick="chartbotToggle()">
      <img src="<?=DOMAIN?>/img/chatbot.jpg" class="chat-main-btn" alt="" />
    </div>

    <div class="chatbot chatbotpophide" id="chatbotbtn">
      <div class="chatbot-container">
        <header class="chatbot-header">
          <span class="chatbot-title">ChatBot</span>

          <span class="chatbot-close" onclick="chartbotToggle()">&times;</span>
        </header>
        <div class="chatbot-messages" id="chatbot-messages">
          <div class="chatbot-message" id="chatbox">
            <p>SAVVY BOT: Hello there! 👋 It's nice to meet you!</p>
            <p>SAVVY BOT: How can i help you ?</p>
            
            <span class='smart-options' onclick='sendMessageToChatbot(`What is a Bank Reconciliation System?`)'>What is a Bank Reconciliation System?</span>

<span class='smart-options' onclick='sendMessageToChatbot(`Why is a Bank Reconciliation System important?`)'>Why is a Bank Reconciliation System important?</span>

<span class='smart-options' onclick='sendMessageToChatbot(`How does a Bank Reconciliation System work?`)'>How does a Bank Reconciliation System work?</span>

<span class='smart-options' onclick='sendMessageToChatbot(`What are the key features of a Bank Reconciliation System?`)'>
    What are the key features of a Bank Reconciliation System?</span>

<span class='smart-options' onclick='sendMessageToChatbot(`What are the benefits of using a Bank Reconciliation System?`)'>What are the benefits of using a Bank Reconciliation System?</span>

<span class='smart-options' onclick='sendMessageToChatbot(`Is a Bank Reconciliation System suitable for my organization?`)'>
    Is a Bank Reconciliation System suitable for my organization?</span>

<span class='smart-options' onclick='sendMessageToChatbot(`How do I choose the right Bank Reconciliation System for my organization?`)'>
    How do I choose the right Bank Reconciliation System for my organization?</span>

<span class='smart-options' onclick='sendMessageToChatbot(`Is training required to use a Bank Reconciliation System?`)'>
    Is training required to use a Bank Reconciliation System?</span>


          </div>
        </div>


        <?php
        if(!empty($_SESSION["user_id_tmp"])){
            ?>
   <div class="chatbot-input">
          <input
            type="text"
            id="userInput"
            placeholder="Type your message here"
          />
          <button onclick="sendMessage()">Send</button>
        </div>
            <?php
        }
        ?>
     
      </div>
    </div>

    <script>
      function scrollToBottom() {
        var element = document.getElementById("chatbox");
        element.scrollTop = element.scrollHeight;
      }

      function sendMessageToChatbot(message) {

        document.getElementById("chatbox").innerHTML +=
          "<div class='right'><p class='you-reply'><b>You:</b> " + message + "</p></div>";
          let userInput= document.getElementById("userInput");
          if(userInput){
            userInput.value="";
          }
        //document.getElementById("userInput").value = "";

        // Send the message to the server
        var chatbox = document.getElementById("chatbox");
        console.log(chatbox.scrollHeight);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            var botResponse = this.responseText;
            var messagesContainer = document.getElementById("chatbox");
            messagesContainer.scrollTop = 0;
            var newMessageElement = document.createElement("div");
            newMessageElement.innerHTML = botResponse;
            messagesContainer.appendChild(newMessageElement);
            //messagesContainer.appendChild("Bot: " + botResponse + "</p>");
            //console.log(botResponse);
            /*document.getElementById("chatbox").innerHTML +=
              "<p>Bot: " + botResponse + "</p>";
*/
            var chatContainer = document.getElementById("chatbot-messages");
            chatContainer.scrollTop = chatContainer.scrollHeight;
            //scrollToBottom(); // Ensure the container scrolls to show the new message
          }
        };
        xhttp.open("POST", "<?=DOMAIN?>/includes/bot.php", true);
        xhttp.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        xhttp.send("message=" + message);
      }
      function sendMessage() {
        var message = document.getElementById("userInput").value;
        if (message.trim() === "") return;

       

        sendMessageToChatbot(message);
      }

      function chartbotToggle() {
        var element = document.getElementById("chatbotbtn");
        element.classList.toggle("chatbotpophide");
      }
    </script>

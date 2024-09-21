let userProfileToLoad = [];
let urlString = window.location.href;

// Create a URL object
let url = new URL(urlString);
let params = new URLSearchParams(url.search);
let sellerID = params.get("seller");

let headerUserProfile = document.querySelector("#header-user-profile");
let fromId = document.querySelector("#from-id");
let toId = document.querySelector("#to-id");
let message = document.querySelector("#message-content");
let sendMessageBtn = document.querySelector("#send-message");
let productId = document.querySelector("#product-id");
let chatContent = document.querySelector(".chat-content");
let product = document.querySelector("#main-product");

if (sellerID != "" || sellerID != null) {
  let xhr = new XMLHttpRequest();

  let formData = new FormData();

  formData.append("fetch_user", "");
  formData.append("user_id", sellerID);

  xhr.open("POST", "./ajax/chat.php", true);

  xhr.onload = function () {
    if (this.status == 200 && this.readyState == 4) {
      if (JSON.parse(this.responseText) != false) {
        let user = JSON.parse(this.responseText);

        scrollToBottom();

        headerUserProfile.appendChild(
          elementFromHtml(`
         <div class="user-profile-img">
              <img src="./Photos/${user.profile_pic}" alt="">
          </div>
        `)
        );
        headerUserProfile.appendChild(
          elementFromHtml(`
        <div class="user-profile-details">
             <div class="user-name">${user.name}</div>
        </div>
        `)
        );

        toId.value = user.id;
      }
    }
  };

  xhr.send(formData);
} else {
}

sendMessageBtn.addEventListener("click", (e) => {
  e.preventDefault();

  sendMessagewithProduct();

  message.value = "";
});

function sendMessagewithProduct() {
  let xhr = new XMLHttpRequest();

  let formData = new FormData();

  formData.append("post_message", "");
  formData.append("from_id", fromId.value.trim());
  formData.append("to_id", toId.value.trim());
  formData.append("message", message.value.trim());
  formData.append("product_id", productId.value.trim());

  xhr.open("POST", "./ajax/chat.php", true);

  xhr.onload = function () {
    if (this.status == 200 && this.readyState == 4) {
      if (JSON.parse(this.responseText) != false) {
        let msg = JSON.parse(this.responseText);

        let currentMessages = chatContent.querySelectorAll(".message");

        if (currentMessages.length < 1) {
          chatContent.innerHTML = "";
        }

        if (msg.product_id != null) {
          chatContent.appendChild(
            elementFromHtml(`
            <div data-message='${this.responseText}' class="message sender">
                <div class="message-content">
                 ${msg.msg}
                </div>
                <a href="./product-details.php?product=${
                  msg.product_id
                }" class="product-ref">
                    <div class="product-img">
                        <img src="./uploaded_img/${msg.image}" alt="">
                    </div>
                    <div class="product-content">
                        ${msg.name.substring(0, 30)}
                    </div>
                </a>
            </div>
            `)
          );
        } else {
          chatContent.appendChild(
            elementFromHtml(`
            <div data-message='${this.responseText}' class="message sender">
                <div class="message-content">
                 ${msg.msg}
                </div>
                
            </div>
            `)
          );
        }

        fetchChats();
        scrollToBottom();

        if (product != null) {
          product.remove();
        }

        url.searchParams.delete("product");
        window.history.replaceState({}, document.title, url.toString());
      }
    }
  };

  xhr.send(formData);
}

function fetchChats() {
  chatContent.innerHTML == "";

  let currentCharts = document.querySelectorAll(".chat-content .message");

  if (currentCharts.length >= 1) {
    let latestChart = JSON.parse(
      currentCharts[currentCharts.length - 1].getAttribute("data-message")
    );

    if (Array.isArray(latestChart)) {
      latestChart = latestChart[0];
    }

    let newestMessage;

    let userId = document.querySelector("#user-id-get").value;

    let xhr = new XMLHttpRequest();

    let formData = new FormData();

    formData.append("fetch_chats", "");
    formData.append("id_1", userId);
    formData.append("id_2", sellerID);

    xhr.open("POST", "./ajax/chat.php", true);

    xhr.onload = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (JSON.parse(this.responseText)) {
          newestMessage = JSON.parse(xhr.responseText)[0];

          let latestChartTime = new Date(latestChart.time_sent);
          let newestMessageTime = new Date(newestMessage.time_sent);

          if (latestChart.msg_id < newestMessage.msg_id) {
            if (newestMessage.from_user == userId) {
              // message sender

              if (
                newestMessage.product_id != null &&
                newestMessage.product_id != ""
              ) {
                let message = elementFromHtml(`
                  <div data-message='${
                    xhr.responseText
                  }' class="message sender">
                      <a href="./product-details.php?product=${
                        newestMessage.product_id
                      }" class="product">
                          <div class="product-content">${newestMessage.name.substring(
                            0,
                            20
                          )}</div>
                      </a>
                      <div class="message-content">${newestMessage.msg}</div>
                  </div>  
              `);

                chatContent.appendChild(message);
              } else {
                let message = elementFromHtml(`
                  <div data-message='${xhr.responseText}' class="message sender">
                  
                      <div class="message-content">${newestMessage.msg}</div>
                  </div>  
              `);

                chatContent.appendChild(message);
              }
            } else {
              // message reciever

              if (
                newestMessage.product_id != null &&
                newestMessage.product_id != ""
              ) {
                let message = elementFromHtml(`
                  <div data-message='${
                    xhr.responseText
                  }'  class="message reciever">
                      <a href="./product-details.php?product=${
                        newestMessage.product_id
                      }" class="product">
                          <div class="product-content">${newestMessage.name.substring(
                            0,
                            20
                          )}</div>
                      </a>
                      <div class="message-content">${newestMessage.msg}</div>
                  </div>  
              `);

                chatContent.appendChild(message);
              } else {
                let message = elementFromHtml(`
                  <div data-message='${xhr.responseText}' class="message reciever">
                  
                      <div class="message-content">${newestMessage.msg}</div>
                  </div>  
              `);

                chatContent.appendChild(message);
              }
            }
          }
        }
      }
    };

    xhr.send(formData);
  }
}

fetchChats();

setInterval(() => {
  fetchChats();
}, 200);

function elementFromHtml(html) {
  let template = document.createElement("template");

  template.innerHTML = html.trim();

  return template.content.firstElementChild;
}

function scrollToBottom() {
  chatContent.scrollTop = chatContent.scrollHeight;
}

chatApp = new Vue({
    el: "#chat-app",
    data:{
        chatSocket: false,
    },
    methods:{
        searchChat: function(){
            if(!this.chatSocket){
                this.chatSocket = new WebSocket("ws://chat.os/chat-server/chat-server.php");
            }
        },
    },
});

var group_chat_last_message_ids = [];
var id_of_showing_invitee_info = -1;
var id_of_hovered_invitee_info = -1;

var waiting_group_chat_update = 0;

function slot_taken(left_array, min,max){
  var index = 0;
  while (index < left_array.length){
    if (left_array[index]>=min && left_array[index]<= max) {
      return true;
    }
    index ++;
  }
  return false;
}


function sortNumber(a,b) {
    return a - b;
}

(function ($) {
  $(document).ready( function() {
    //setInterval(function() { chat.get_message(); }, 4000);
    chat.solo_fetch();
    chat.group_fetch();
    $('form#social-area-chat-list').submit(function(event){chat.name_list_submit(event);});
  });
})(jQuery);

var chat = (function ($) {
  var latest_mcsid = 0;
  return {
    set_id_of_showing_invitee_info: function(id){
      id_of_showing_invitee_info = id;
    },
    set_id_of_hovered_invitee_info: function(id){
      id_of_hovered_invitee_info = id;
    },
    mouse_leave_thumb: function(uid){
      setTimeout(function(){
        if (id_of_hovered_invitee_info != uid) {
          if ( id_of_showing_invitee_info==uid) {
            chat.reset_id_of_showing_invitee_info();
          }
          chat.close_invitee_info(uid);
        }
      },100);


    },
    minimize_all: function(){
      for (var i = 0; i < Drupal.settings.uids.length; i ++){
        var uid = Drupal.settings.uids[i];
        if ($("#myngl-event-solo-chat-" + uid).hasClass('visible')) {
          chat.solo_minimize(uid);
        }
      }
    },
    close_all: function(){
      for (var i = 0; i < Drupal.settings.uids.length; i ++){
        var uid = Drupal.settings.uids[i];
        if ($("#myngl-event-solo-chat-" + uid).hasClass('visible')) {
          chat.solo_hide(uid);
        }
      }
    },
    expand_all: function(){
      for (var i = 0; i < Drupal.settings.uids.length; i ++){
        var uid = Drupal.settings.uids[i];
        if ($("#myngl-event-solo-chat-" + uid).hasClass('minimized')) {
          chat.solo_show(uid);
        }
      }

    },
    solo_minimize :function (uid){
      $("#myngl-event-solo-chat-" + uid).removeClass('visible').hide().addClass('minimized');
      if ($('#minimized-solo-chat-' + uid).length==0) {

        var minimized_icon =
          "<div class='minimized-solo-chat' id='minimized-solo-chat-" + uid + "' onclick='chat.solo_show(" +uid +")'>" +
          '<img src="' + $("#invitee-thumb-" + uid  + " img").attr('src') + '" class="minimized myngl-event-profile-pic"  />';
          + "</div>";
        $("#myngl-event-chat-button #minimized-chats").append(minimized_icon);
      }
      if ($(".myngl-chat.visible").length >1) {
          $("#close-and-minimize-all").show();
        }
      else {
          $("#close-and-minimize-all").hide();
      }
    },
    solo_hide : function(uid){
      $("#myngl-event-solo-chat-" + uid).removeClass('visible').hide();
      if ($(".myngl-chat.visible").length <=1) {
          $("#close-and-minimize-all").hide();
        }
    },

    solo_show : function(uid) {
        if (!($("#myngl-event-solo-chat-" + uid).hasClass('visible'))) {
          var left_array = [];
          $(".myngl-chat.visible").each( function(){
            left_array.push($(this).offset().left);
          });

          left_array.sort(sortNumber);
          var counter = 0;
          var left = -1;
          var min = 0;
          while ( left == -1) {
            if (slot_taken(left_array, min, min+ 50)) {
              min = min + 375;
            }
            else {
              left = min+ 25;
            }
          }

          $("#myngl-event-solo-chat-" + uid).css('left', left + 'px');
          chat.close_invitee_info(uid);
          $("#myngl-event-solo-chat-" + uid).fadeIn(100);
          $("#myngl-event-solo-chat-" + uid).addClass('visible').removeClass('minimized');
          $("#myngl-event-solo-chat-" + uid).draggable();
          $("#myngl-event-solo-chat-" + uid).css('top', '200px');

          // remove minimized button
          $('.minimized-solo-chat#minimized-solo-chat-' + uid).remove();

          if ($(".myngl-chat.visible").length >1) {
            $("#close-and-minimize-all").show();
          }
        }
        return false;
      },
    invitee_click: function (uid){
      if ($("#social-area-chat-list #uid-" + uid).hasClass("selected")){
        $("#social-area-chat-list #uid-" + uid).removeClass("selected");
      }
      else {
        $("#social-area-chat-list #uid-" + uid).addClass("selected");
      }
    },
    name_list_submit : function(event){
      event.preventDefault();
      var selected_invitees = [];
      if ($("#social-area-chat-list .selected.in-lounge").length >5){
        alert("Please limit your group chat members to 5 people or less.");
        return false;
      }
      $("#social-area-chat-list .selected.in-lounge").each(function() {
        $(this).removeClass('selected');
        selected_invitees[selected_invitees.length] = $(this).attr('value');
      });
      if (selected_invitees.length ==1) {
        chat.solo_show(selected_invitees[0]);
      }

      else if (selected_invitees.length >1) { //group chat
        selected_invitees[selected_invitees.length]=Drupal.settings.user_id; //add the current user
        $.ajax({
          url: '/myngl-chat/group-create/' + Drupal.settings.myngl_id ,
          cache: false,
          type: 'POST',
          data :  { selected_invitees : selected_invitees},
          success: function(json) {
            var new_chat = jQuery.parseJSON(json );
            chat.group_show(new_chat);}
        });
      }
      return false;
    },
    group_show : function(new_chat) {
      var new_chat_div = "<div id='myngl-event-group-chat-" + new_chat.chat_id + "' class='myngl-event-group-chat myngl-chat branded visible' style='width:325px; height:340px; clear:both;'>";
      var group_chat_user_list = "";
      for (var key in new_chat.users){
        if (key != Drupal.settings.user_id ) {
          group_chat_user_list = group_chat_user_list + new_chat.users[key] + ", ";
        }
      }
      group_chat_user_list = group_chat_user_list.slice(0, -2);
      group_chat_user_list = group_chat_user_list + ":";

      // name list and the close button
      new_chat_div = new_chat_div +
        "<div class='myngl-event-group-chat-intro branded'><a href='#' " +
        "onclick='chat.group_leave(" + new_chat.chat_id + ");' class='overlay-close'>X</a>" +
        "<div style='color:#ffffff'> Chat with<div class='group_chat_user_list' style='inline-block;'>" + group_chat_user_list + "</div></div>";
      // messages
      new_chat_div = new_chat_div +
      "<div class='myngl-event-group-chat-messages myngl-chat-messages branded-tertiary' style='height:210px; overflow:scroll; background-color:#ffffff;'></div>";
      // submit form

      new_chat_div = new_chat_div +
        '<div class="myngl-event-group-chat-form myngl-chat-form">' +
        '  <form action="#" onsubmit="return chat.group_post(' + new_chat.chat_id +')" style="margin-top:10px;">' +
        '   <label>Enter Message</label>' +
        '   <input type="hidden" class="chat-to-group" name="chat-to-group" value="' + new_chat.chat_id + '" />'+
        '   <input type="text" id ="group-chat-message-input-'+  new_chat.chat_id +
              '" class="group-chat-message-input branded-tertiary form-light"' +
              ' name="message-input" size="40" style="background-color:#ffffff;"'+
              'onfocus="chat.group_chat_input_focus('+new_chat.chat_id+')" ' +
              'onblur="chat.group_chat_input_onblur('+new_chat.chat_id+')" value="Enter Message"/>' +
        '   <input type="submit" value="Send" />' +
        '   </form>'+
        '</div>';

      new_chat_div = new_chat_div + "</div><!-- /.myngl-event-group-chat-intro -->";
      new_chat_div = new_chat_div +   "</div><!-- /#myngl-event-group-chat-" + new_chat.chat_id + "-->";

      var left_array = [];
      $(".myngl-chat.visible").each( function(){
        left_array.push($(this).offset().left);
      });

      left_array.sort(sortNumber);
      var counter = 0;
      var left = -1;
      var min = 0;
      while ( left == -1) {
        if (slot_taken(left_array, min, min+ 50)) {
          min = min + 375;
        }
        else {
          left = min+ 25;
        }
      }

      $('#block-system-main').append(new_chat_div);
      $('#myngl-event-group-chat-'+new_chat.chat_id).css('top', '200px').css('position','absolute');
      $('#myngl-event-group-chat-'+new_chat.chat_id).draggable();
      $("#myngl-event-group-chat-" + new_chat.chat_id).css('left', left + 'px');
      return false;
    },

    group_chat_input_focus: function(chat_id){
      if ($("#myngl-event-group-chat-" + chat_id + " :text").val() == $("#myngl-event-group-chat-" + chat_id + " :text").siblings('label').html().replace(/<span.*/,'')) {
        $("#myngl-event-group-chat-" + chat_id + " :text").val('').removeClass('form-light');
      }
    },
    group_chat_input_onblur: function(chat_id){
      if ($("#myngl-event-group-chat-" + chat_id + " :text").val() == '') {
        $("#myngl-event-group-chat-" + chat_id + " :text").val($("#myngl-event-group-chat-" + chat_id + " :text").siblings('label').html().replace(/<span.*/,'')).addClass('form-light');
      }
    },

    open_chat : function() {
      $('#myngl-event-chat-button-invitees').fadeOut(200, function() {
        myngl.overlay('myngl-event-chat', 500, 450);
      });
      return false;
    },
    /*  i think theese two functions are replaced by solo fetch and solo post
    get_message : function() {
      if ($("#myngl-event-chat").is(':visible')) {
        var myngl_id = Drupal.settings.myngl_id;
        $.ajax({
          type: "GET",
          url: "/myngl-chat/get-message/" + myngl_id ,
          success: function(data) {
            $("#myngl-event-chat-messages").html('');
            data.forEach(function(entry) {
              $("#myngl-event-chat-messages").append('  <div id="chat-message - ' + entry.mcid + '" class="chat-message"> <img src="' + $("#invitee-thumb-" + entry.user_id  + " img").attr('src') + '" class="chat myngl-event-profile-pic"  /> <strong>' + $("#invitee-name-" + entry.user_id).html()  + ':</strong>  ' +  entry.message + '</div>');
            });
          }
        });
      }
    },

    send_message : function() {
      var myngl_id = Drupal.settings.myngl_id;
      if ($('#chat-message-input').val() != 'Enter Message') {
          $.ajax({
            type: "POST",
            url: "/myngl-chat/send-message/" + myngl_id + "/" + $("#chat-uid").val(),
            data: {'message' : $('#chat-message-input').val()}
          });

          $('#chat-message-input').val('Enter Message');
          $('#chat-message-input').addClass('form-light');
        }
        return false;
      },
      */
      solo_post : function(to_uid) {
        myngl.add_rewards_points(Drupal.settings.myngl_id, Drupal.settings.user_id, 'sending_ct_msg');
        var myngl_id = Drupal.settings.myngl_id;
        var from_uid = Drupal.settings.user_id;

        if ($('#solo-chat-message-input-' + to_uid).val() != 'Enter Message') {
          $.ajax({
            type: "POST",
            url: "/myngl-chat/solo-post/" + myngl_id + "/" + from_uid + "/" + to_uid,
            data: {'message' : $('#solo-chat-message-input-' + to_uid).val()}
          });

          $('#solo-chat-message-input-' + to_uid).val('Enter Message');
          $('#solo-chat-message-input-' + to_uid).addClass('form-light');
        }
        return false;
      },

      group_post : function(chat_id) {
        myngl.add_rewards_points(Drupal.settings.myngl_id, Drupal.settings.user_id, 'sending_ct_msg');
        var myngl_id = Drupal.settings.myngl_id;
        var from_uid = Drupal.settings.user_id;

        if ($('#group-chat-message-input-' + chat_id).val() != 'Enter Message' &&
            $('#group-chat-message-input-' + chat_id).val() != '') {
          $.ajax({
            type: "POST",
            url: "/myngl-chat/group-post/" + myngl_id + "/" + from_uid + "/" + chat_id,
            data: {'message' : $('#group-chat-message-input-' + chat_id).val()}
          });
          $('#group-chat-message-input-' + chat_id).val('');
        }
        return false;
      },

      group_fetch_my_group_chats: function (data){
        var r = [];
        for (var i = 0;  i < data.length; i ++){
          if (data[i][0]== Drupal.settings.user_id) {
            r.push(data[i][1]);
          }
        }
        return r;
      },
      group_chat_users_in_chat:function (data, chat_id){
        var r = new Object();
        for (var i = 0; i < data.length; i ++){
          if (data[i][1] == chat_id) {

            r[data[i][0]] = $("span#invitee-name-"+data[i][0]).text();
          }
        }
        return r;
      },
      //new version
      group_fetch : function() {
        var url = "/chats/group/group_list_"+Drupal.settings.myngl_id+".json?time="+ (new Date().getTime());
        $.ajax({
          type: "GET",
          url: url,
          error: function(jqxhr, status, error){
            setTimeout(function(){chat.group_fetch()},4000);
          },
          success: function (data) {
            /*
              data = array(
                [0] => array(a0, b0)
                [1] => array(a1, b1)
              )
              where ai = user id, and bi = chat id.

              From here, we need to construct two list:
              1. what chat room this user is in
              2. for each chat room the use is in, what users are also in the chat room.
            */
            var my_group_chats = chat.group_fetch_my_group_chats(data);
            waiting_group_chat_update == my_group_chats.length;
            for(var i = 0; i < my_group_chats.length; i ++){

              var users_list = chat.group_chat_users_in_chat(data, my_group_chats[i]);

               $.ajax({
                type: "GET",
                url: "/chats/group/"+Drupal.settings.myngl_id+"_"+my_group_chats[i]+".json?time="+ (new Date().getTime()),
                chat_id:my_group_chats[i],
                users:  users_list,
                success: function (data) {
                  chat.group_fetch_success(data, this.chat_id, this.users);
                },
                complete: function(jqxhr, status){
                  waiting_group_chat_update --;
                  console.log("waiting group # = " + waiting_group_chat_update);
                  if (waiting_group_chat_update==0) {
                    setTimeout(function(){chat.group_fetch()},4000);
                  }

                },
              });


            }

          }
        });
      },

      preprocess_group_fetch_data: function(data, chat_id, users){

        /*right now it is:
          data = array(
            [0] array(
              id=>
              message=>
              user_id=>
            )
          )
        /* should be like:
        data = object(
          [chat_id] => num,
            [users] => array(
              uid => name,
              uid => name,
              uid => name,
            )
          [last_message_id] => 0,
          [messages] =>array(
            [0] => array(
              user_id =>
              name =>
              message=>

            )
            [1] => array(
            user_id,
            name=>
            message =>
            )
          )
         */


        for(var i = 0; i < data.length; i ++){
          data[i].name = users[data[i].user_id];
        }
        var chat = new Object();
        chat.chat_id = chat_id;
        chat.users = users;
        chat.messages = data;
        return chat;
      },
      group_fetch_success : function(data, chat_id, users){


        var c = chat.preprocess_group_fetch_data(data, chat_id, users);


        if ($('#myngl-event-group-chat-' + chat_id ).length == 0 ) {
          if (c.messages.length !=0) {


          chat.group_show(c);
          }
        }

        var group_chat_user_list = "";
        for (var key in c.users){
          if (key != Drupal.settings.user_id ) {
            group_chat_user_list = group_chat_user_list + c.users[key] + ", ";
          }
        }
        group_chat_user_list = group_chat_user_list.slice(0, -2);
        group_chat_user_list = group_chat_user_list + ":";


        $('#myngl-event-group-chat-' + c.chat_id + ' .group_chat_user_list').text(group_chat_user_list) ;


        for (var key in c.messages){

          var element = $('#myngl-event-group-chat-' + c.chat_id).find('.group-message#group-message-'+ c.chat_id+'-'+c.messages[key].id).length;
          if (element ==0) {
            $('#myngl-event-group-chat-' + c.chat_id + ' .myngl-event-group-chat-messages').append(
              '<div class="group-message" id="group-message-'+ c.chat_id+'-'+c.messages[key].id+'"> <img src="' +
              $("#invitee-thumb-" + c.messages[key]['user_id']  +
                " img").attr('src') + '" class="group-chat myngl-event-profile-pic"  /><div class="text"> <strong>' +
              $("#invitee-name-" + c.messages[key]['user_id']).html()  +
              ':</strong>  ' +  c.messages[key]['message'] + '</div></div>');

            $('#myngl-event-group-chat-' + c.chat_id + ' .myngl-event-group-chat-messages').animate(
              { scrollTop: $('#myngl-event-group-chat-' + c.chat_id + ' .myngl-event-group-chat-messages')[0].scrollHeight}, 10);
          }
        }


      },
      /*  being refactored
      group_fetch : function() {
        $.ajax({
          type: "POST",
          url: "/myngl-chat/group-fetch/" + Drupal.settings.myngl_id + "/" + Drupal.settings.user_id,
          data: {'last_message_ids': group_chat_last_message_ids },
          success: function (data) {
            chat.group_fetch_success(data);
          }
        });
      },

      group_fetch_success : function(data){
        var parsed_data = jQuery.parseJSON(data );
        for (var chat_index in parsed_data.chats){
          group_chat_last_message_ids[parsed_data.chats[chat_index].chat_id] = parsed_data.chats[chat_index].last_message_id;
          if ($('#myngl-event-group-chat-' + parsed_data.chats[chat_index].chat_id ).length == 0 ) {
            if (parsed_data.chats[chat_index]['messages'].length !=0) {
              chat.group_show(parsed_data.chats[chat_index]);
            }
          }

          var group_chat_user_list = "";
          for (var key in parsed_data.chats[chat_index]['users']){
            if (key != Drupal.settings.user_id ) {
              group_chat_user_list = group_chat_user_list + parsed_data.chats[chat_index]['users'][key] + ", ";
            }
          }
          group_chat_user_list = group_chat_user_list.slice(0, -2);
          group_chat_user_list = group_chat_user_list + ":";
          $('#myngl-event-group-chat-' + parsed_data.chats[chat_index].chat_id + ' .group_chat_user_list').text(group_chat_user_list) ;


          for (var key in parsed_data.chats[chat_index]['messages']){
            //BADDDDDDDDDD CHEATING FIX.... it compares the existing message to the new-coming message and see if same string exist. .... it should be implemented by message ID instead.

            if ($('#myngl-event-group-chat-' + parsed_data.chats[chat_index].chat_id + ' .myngl-event-group-chat-messages').text().indexOf(parsed_data.chats[chat_index]['messages'][key]['message'])==-1) {
              $('#myngl-event-group-chat-' + parsed_data.chats[chat_index].chat_id + ' .myngl-event-group-chat-messages').append(
                '<div class="group-message"> <img src="' +
                $("#invitee-thumb-" + parsed_data.chats[chat_index]['messages'][key]['user_id']  +
                  " img").attr('src') + '" class="group-chat myngl-event-profile-pic"  /><div class="text"> <strong>' +
                $("#invitee-name-" + parsed_data.chats[chat_index]['messages'][key]['user_id']).html()  +
                ':</strong>  ' +  parsed_data.chats[chat_index]['messages'][key]['message'] + '</div></div>');

              $('#myngl-event-group-chat-' + parsed_data.chats[chat_index].chat_id + ' .myngl-event-group-chat-messages').animate(
                { scrollTop: $('#myngl-event-group-chat-' + parsed_data.chats[chat_index].chat_id + ' .myngl-event-group-chat-messages')[0].scrollHeight}, 10);
            }
          }
        }
      },
      */
      group_leave: function (chat_id){
        $('#myngl-event-group-chat-' + chat_id ).remove();
        $.ajax({
          type: "GET",
          url: "/myngl-chat/group-leave/" + Drupal.settings.myngl_id + "/" + Drupal.settings.user_id + "/" + chat_id,
          success: function (data) {}
        });
      },


      // New Solo fetch
      solo_fetch : function () {
        console.log("solo fetching!");
        var myngl_id = Drupal.settings.myngl_id;
        var user_id = Drupal.settings.user_id;
        var url = "/chats/solo/" + myngl_id + "_" + user_id + ".json?time="+ (new Date().getTime());
        //console.log(url);
        $.ajax({
          type: "GET",
          dataType: "json",
          url: url,
          complete: function(jqxhr, status){
            setTimeout(function(){chat.solo_fetch()},4000);
          },
          success: function (data) {
            data.forEach( function(entry) {
              if (entry.to_user_id != user_id) {
                chat.solo_show(entry.to_user_id);
              } else {
                chat.solo_show(entry.from_user_id);
              }
            });
            data.forEach( function(entry) {
              if (entry.to_user_id != user_id) {
                if (latest_mcsid == 0) {
                  //BUGGY!! This causes the window to minimize after first message is sent.
                  //chat.solo_minimize(entry.to_user_id);
                }
              } else {
                if (latest_mcsid == 0) {
                  chat.solo_minimize(entry.from_user_id);   
                }
              }
            });
            data.forEach( function(entry) {
              if (parseInt(entry.mcsid) > latest_mcsid) {
                latest_mcsid =  parseInt(entry.mcsid);
              }
            });
            //console.log(data);
            data.forEach( function(entry) {

              if (entry.to_user_id != user_id) {
                var element = $(".myngl-event-solo-chat#myngl-event-solo-chat-"+entry.to_user_id).find("#solo-message-"+entry.mcsid).length;

                if (element == 0) {
                  $("#myngl-event-solo-chat-messages-" + entry.to_user_id).append(
                      '<div id="solo-message-' + entry.mcsid + '" class="solo-message"> <img src="' +
                      $("#invitee-thumb-" + entry.from_user_id  + " img").attr('src') +
                      '" class="solo-chat myngl-event-profile-pic"  /><div class="text"><strong>' +
                      $("#invitee-name-" + entry.from_user_id).html()  +
                      ':</strong>  ' +  entry.message +
                      '</div></div>'
                  );
                  $("#myngl-event-solo-chat-messages-" + entry.to_user_id).animate({ scrollTop: $("#myngl-event-solo-chat-messages-" + entry.to_user_id)[0].scrollHeight}, 10);
                }
              } else {
                var element = $(".myngl-event-solo-chat#myngl-event-solo-chat-"+entry.from_user_id).find("#solo-message-"+entry.mcsid).length;
                if (element ==0) {
                  $("#myngl-event-solo-chat-messages-" + entry.from_user_id).append('<div id="solo-message-' + entry.mcsid + '" class="solo-message"> <img src="' + $("#invitee-thumb-" + entry.from_user_id  + " img").attr('src') + '" class="solo-chat myngl-event-profile-pic"  /><div class="text"><strong>' + $("#invitee-name-" + entry.from_user_id).html()  + ':</strong>  ' +  entry.message + '</div></div>');
                  $("#myngl-event-solo-chat-messages-" + entry.from_user_id).animate({ scrollTop: $("#myngl-event-solo-chat-messages-" + entry.from_user_id)[0].scrollHeight}, 10);
                }
              }
            });
          }
        });
      },
      /* This function is being refactored
      solo_fetch : function () {
        var myngl_id = Drupal.settings.myngl_id;
        var user_id = Drupal.settings.user_id;
        $.ajax({
          type: "GET",
          url: "/myngl-chat/solo-fetch/" + myngl_id + "/" + user_id + "/" + latest_mcsid,
          success: function (data) {
            data.forEach( function(entry) {
              if (entry.to_user_id != user_id) {
                chat.solo_show(entry.to_user_id);
              } else {
                chat.solo_show(entry.from_user_id);
              }
            });
            data.forEach( function(entry) {
              if (entry.to_user_id != user_id) {
                if (latest_mcsid == 0) {
                  //BUGGY!! This causes the window to minimize after first message is sent.
                  //chat.solo_minimize(entry.to_user_id);
                }
              } else {
                if (latest_mcsid == 0) {
                  chat.solo_minimize(entry.from_user_id);
                }
              }
            });
            data.forEach( function(entry) {
              if (parseInt(entry.mcsid) > latest_mcsid) {
                latest_mcsid =  parseInt(entry.mcsid);
              }
            });

            data.forEach( function(entry) {
              if (entry.to_user_id != user_id) {
                //SUPER UGLY BAD BAD BAD CHEATING BUG FIX.  NEED TO REVISE!!!, same as line 353. (only if we have time though.)
                if ($("#myngl-event-solo-chat-messages-" + entry.to_user_id).text().indexOf(entry.message) == -1) {
                  $("#myngl-event-solo-chat-messages-" + entry.to_user_id).append(
                      '<div id="solo-message-' + entry.mcsid + '" class="solo-message"> <img src="' +
                      $("#invitee-thumb-" + entry.from_user_id  + " img").attr('src') +
                      '" class="solo-chat myngl-event-profile-pic"  /><div class="text"><strong>' +
                      $("#invitee-name-" + entry.from_user_id).html()  +
                      ':</strong>  ' +  entry.message +
                      '</div></div>'
                  );
                  $("#myngl-event-solo-chat-messages-" + entry.to_user_id).animate({ scrollTop: $("#myngl-event-solo-chat-messages-" + entry.to_user_id)[0].scrollHeight}, 10);
                }
              } else {
                //SUPER UGLY BAD BAD BAD CHEATING BUG FIX.  NEED TO REVISE!!!
                if ($("#myngl-event-solo-chat-messages-" + entry.from_user_id).text().indexOf(entry.message) == -1) {
                  $("#myngl-event-solo-chat-messages-" + entry.from_user_id).append('<div id="solo-message-' + entry.mcsid + '" class="solo-message"> <img src="' + $("#invitee-thumb-" + entry.from_user_id  + " img").attr('src') + '" class="solo-chat myngl-event-profile-pic"  /><div class="text"><strong>' + $("#invitee-name-" + entry.from_user_id).html()  + ':</strong>  ' +  entry.message + '</div></div>');
                  $("#myngl-event-solo-chat-messages-" + entry.from_user_id).animate({ scrollTop: $("#myngl-event-solo-chat-messages-" + entry.from_user_id)[0].scrollHeight}, 10);
                }
              }
            });
          }
        });
      }, */

      show_invitee_info : function(uid) {
        if (uid==id_of_showing_invitee_info) {
          return false;
        }
        if (id_of_showing_invitee_info!=-1&& id_of_showing_invitee_info!=uid) {
          chat.close_invitee_info( id_of_showing_invitee_info);
        }
        chat.set_id_of_showing_invitee_info(uid);

        $("#myngl-event-invitee-info-" + uid).fadeIn(100);
        var o = $("#invitee-thumb-" + uid).offset();
        $("#myngl-event-invitee-info-" + uid).css('top', (o.top - 200) + 'px');
        $("#myngl-event-invitee-info-" + uid).css('left', o.left + 'px');
        return false;
      },
      reset_id_of_showing_invitee_info : function(){
        chat.set_id_of_showing_invitee_info(-1);

        return false;
      },
      close_invitee_info: function (uid){
        setTimeout(function(){
          if (id_of_showing_invitee_info!=uid) {
          $("#myngl-event-invitee-info-" + uid).fadeOut(100);
          }
        }, 100);
        return false;
      }
    }
}(jQuery));

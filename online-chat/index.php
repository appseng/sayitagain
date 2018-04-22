<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>

    <title>SIA: Online Chat for English Learners</title>
    <meta name="keywords" content="free english conversation find partner learn spoken english speak speaking write writing skill enjoy language exchange partner grammar school slang exercises lessons on skype via icq vocabulary expansion dialogs study pronunciation spoken native speakers every taste different preparation exam ket pet fce cae cfe toefl IELTS BEC TOEIC EFL ESL">
    <meta name="description" content="Online chat for english learners">
  </head>
  <body>
    <?php
        $file = 'online-chat/';
        include_once '../inc/menu.php';
    ?>
    <div id="chat_sayitagain"></div>
    <script type="text/javascript">
        var chatovodOnLoad = chatovodOnLoad || [];
        chatovodOnLoad.push(function() {
            chatovod.addChatToDivId("chat_sayitagain", {host: "sayitagain.chatovod.com",
                width: "100%", height: 480, defaultLanguage: "en"});
        });
        (function() {
            var po = document.createElement('script');
            po.type = 'text/javascript'; po.charset = "UTF-8"; po.async = true;
            po.src = (document.location.protocol=='https:'?'https:':'http:') + '//st1.chatovod.com/api/js/v1.js?2';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
        })();
    </script>
</body>
</html>
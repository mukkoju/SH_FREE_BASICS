<html>
    <head>
        <title>I support Digital India but not Free Basics</title>
        <link rel="icon" type="image/png" href="favicon.ico">
        <meta property="og:site_name" content="SaddaHaq.co" />
        <meta property="og:title" content='I support Digital India but not Free Basics' />
        <meta property="og:image" content="http://saddahaq.co/grid.jpg" />
        <meta property="og:url" content='http://saddahaq.co' />
        <meta property="og:description" content='Change your profie picture in protest of Free Basics' />
        <!--twitter-->
        <meta property="twiter:twitter:domain" content="SaddaHaq.co" />
        <meta property="twiter:title" content='I support Digital India but not Free Basics' />
        <meta property="twiter:image:src" content="http://saddahaq.co/grid.jpg" />
        <meta property="twiter:url" content='http://saddahaq.co' />
        <meta property="twiter:description" content='Change your profie picture in protest of Free Basics' />
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
        <link href='https://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
        <style type="text/css">
            .cntr{
                text-align: center;
            }
            .modal.large {
               text-align: center;
            }   
            .modal-title{
               text-align: left !important;
               font-size: 1.8em !important;
               font-family: 'Candal', sans-serif !important; 
               font-weight: 400 !important;
            }
            .checkbox{
                font-size: 1em !important;
                font-family: 'Candal', sans-serif !important; 
               font-weight: 400 !important;
            }
            .modal-header{
                background-color: rgb(255, 80, 80);
                color: white;
            }
            .ttl{
                text-align: center;
               font-size: 2.6em !important;
               font-family: 'Candal', sans-serif !important; 
               font-weight: 400 !important;  
               margin-top: 120px;
               text-shadow: 0px 2px 3px #353535;
            }
            .img-lst{
              width: 48%;
              margin: auto;
              margin-top: 32px;
            }
            .img-lst img{
                max-width: 14%;
                margin: 1px;
            }
        </style>
    </head>
    <body data-host="<?= "http://".$_SERVER[HTTP_HOST] ?>">
        <!-- Modal -->
        <div class="cntr">
        <h1 class="ttl">I support Digital India but not Free Basics</h1>
        <h4>Login with facebook to change your profile picture in protest of free Basics</h4>
        <button type="button" class="btn btn-primary btn-lg" id="login" style="background-color: #4e69a2; margin-top: 24px;">LOGIN WITH FACEBOOK</button><br/>
        <!--<a href="/debate.php" target="__blank" class="btn btn-success btn-md" id="" style="margin-top: 24px;">THE DEBATE</a>-->
        <!--<a href="http://www.savetheinternet.in/" target="__blank" class="btn btn-success btn-md" id="" style="margin-top: 24px;">SIGN PETITION</a>-->
        <div class="img-lst">
          <?php 
          require 'user.php';
          $images = (new User())->getRecent();
          ?>
           <div style="display: none"><?php var_dump($images)?></div>
           <?php $i= 0; foreach ($images as $image){ ?>
            <img src="images/<?= $image['id']?>_Pic.png"/>
             <?php }?>
        </div>
        </div>
        <div class="modal fade large" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Share Picture</h4>
                    </div>
                    <div class="modal-body">
                        <img id="gen-img" src="say_no.jpg" style="max-width: 64%"/>
                        <textarea style="width: 64%; margin: 16px auto;" class="form-control" rows="2" id="comment" placeholder="Say something about this"></textarea>
                        <div class="checkbox">
                          <!--<label><input type="checkbox" value="">Set as my profile picture</label>-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-lg" id="share" style="background-color: #4e69a2">POST ON FACEBOOK</button>
                        <button type="button" class="btn btn-default" id="close" data-dismiss="modal" style="display: none">Close</button>
                    </div>
                </div>
            </div>
        </div>

            <script type="text/javascript" defer>
                //async init once loading is done
                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
                window.fbAsyncInit = function () {
                    FB.init({
                        appId: '526365847530316', //'335115563365267',
                        xfbml: true,
                        cookie: true,
                        version: 'v2.1'
                    });
                };
                $('#login').click(function(){  
                  FB.login(function (response) {
                              if (response.authResponse) {
                                  FB.api('/me?fields=name,email,id', function (resp) {
                                      $.ajax({
                                          url: '/image.php',
                                          type: 'post',
                                          data: resp,
                                          success: function(r) {
                                            $('#gen-img').attr('src', '/images/'+resp.id+'_Pic.png');
                                            $('.modal').modal('show');  
                                          }
                                      });
                                  });
                              } else {
//                                window.location.reload();
                              }
                  }, {scope: 'email,publish_actions'});
                });
                
                    
                    
                    
                    $("#share").on("click", function () {
                      var hst = $('body').data('host');
                      var img = $('#gen-img').attr('src');
                      var msg = $('#comment').val();
                      FB.api('/me/photos', 'post', {
                            url: hst+img,
                            message: msg,
                            is_hidden: true
                        }, function (response) {
                            if (response && response.id){
                              
                              FB.api('/me/feed', 'post', {
                                    link:hst,
                                    picture:hst+img,
                                    name: 'Click here to change your profile picture in protest of free Basics',
                                    description: 'I support Digital India but not Free Basics'
                               },function(data) {
                                    console.log(data);
                               });
                              
                              
                              
                                $('#close').click();
//                                window.open('https://m.facebook.com/photo.php?fbid='+response.id+'&prof=1', "_blank", "width=400, height=400");
                                  window.location = 'https://m.facebook.com/photo.php?fbid='+response.id+'&prof=1';
                                console.log('Photo uploaded', response.id);
                              }
                            else{
                              console.log(response);
                            }    
                        });
                    });  
            </script>
    </body>
    </html>
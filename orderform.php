<!DOCTYPE html>
<head>
    <meta encoding='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Order </title>
    <!-- Uploadcare library -->
    <script src="https://ucarecdn.com/widget/2.10.0/uploadcare/uploadcare.full.min.js" charset="utf-8"></script>
    <script>
      // Widget settings
      UPLOADCARE_LOCALE = "en";
      UPLOADCARE_TABS = "file";
      UPLOADCARE_PUBLIC_KEY = "your uploadcare key";
      // Uploadcare script start
      $ = uploadcare.jQuery;
      // Create uploaded image list and append additional form fields to each item
      
      function installWidgetPreviewMultiple(widget, list) {
        widget.onChange(function(fileGroup) {

          var groupPromise = fileGroup.promise();
          groupPromise.done(function(fileGroupInfo) {
          // Upload successfully completed and all files in the group are ready.
          });
          list.empty();
          if (fileGroup) {
            $.when.apply(null, fileGroup.files()).done(function() {

              $.each(arguments, function(i, fileInfo) {
                $('.main').addClass('fixed');
                $( "#submit" ).fadeIn( "slow" );
                // display file preview
                var $filename = fileInfo.name;// display file name
                var $fileurl = fileInfo.cdnUrl;// get file url
                var $src = fileInfo.cdnUrl + '-/resize/100x100/filename.jpg';// preview image source, resize to 100X100px and jpeg file type
                // append preview and name and form fields to each file uploaded inside thumb_list 
                list.append(
                  $('<li class="thumb_list_item"><img src="' + $src+ '" alt="File Preview" class="preview-img">' + '<h4 class="filename">' + $filename + '</h4>' + '<div class="get-layer-wraper"><ul class="get-layer"><li class="layer-name"><label for="white-layer" class="layer-title">White Layer : </label></li><li><input id="white-layer" name="white-layer[]" class="layer" type="number" value="0"></li><li>PX</li></ul><div class="clear"></div><ul class="get-layer"><li class="layer-name"><label for="adhesive-layer" class="layer-title">Adhesive Layer : </label></li><li><input id="adhesive-layer" name="adhesive-layer[]" class="layer" type="number" value="0"></li><li>PX</li></ul><div class="clear"></div><ul class="get-layer"><li class="layer-name"><label for="block-layer" class="layer-title">Blocking Layer : </label></li><li><input id="block-layer" name="block-layer[]" class="layer" type="number" value="0"></li><li>PX</li></ul><div class="clear"></div><ul class="get-layer"><li class="layer-name"><label for="clear-layer" class="layer-title">Clear Layer : </label></li><li><input id="clear-layer" name="clear-layer[]" class="layer" type="number" value="0"></li><li>PX</li></ul><div class="clear"></div><ul class="get-layer"><li class="layer-name"><label for="line-layer" class="layer-title">Outline Size : </label></li><li><input id="line-layer" name="line-layer[]" class="layer" type="number" value="0"></li><li>PX</li></ul><div class="clear"></div><ul class="get-layer"><li class="layer-name"><label for="pantone" class="layer-title">Pantone Color : </label></li><li><input id="pantone" name="pantone[]" class="layer" type="type"></li><li></li></ul><div class="clear"></div><ul class="get-layer"><li class="layer-name"><label for="cmyk" class="layer-title">CMYK Color : </label></li><li><input type="text" id="cmyk-c" name="cmyk-c[]" class="min-put" value="C"></li><li><input type="text" id="cmyk-m" name="cmyk-m[]" class="min-put" value="M"></li><li><input type="text" id="cmyk-y" name="cmyk-y[]" class="min-put" value="Y"></li><li><input type="text" id="cmyk-k" name="cmyk-k[]" class="min-put" value="K"></li></ul><div class="clear"></div></li>').appendTo(".thumb_list")
                  );
              });
            });
          }
        });
      }
    $(function() {
      $('.upload-area').each(function() {
        installWidgetPreviewMultiple(
          uploadcare.MultipleWidget($(this).children('input')),
          $(this).children('.thumb_list')
        );
      });
    });
    $( "#submit" ).click(function() {
      $( ".thumb_list" ).empty();
    });
    
</script>
    <!-- Page styles -->
    <style type="text/css">
      .uploadcare-dialog-footer{display: none!important;}
      li{list-style: none;}
        .clear { clear: both;}/* Clear floats*/
        /*Common styles*/
        .thumb_list_item,.get-layer-part,.get-layer li,.main-part{float: left;}
        .uploadcare-widget-button-open,.submit-btn{background: transparent;}
        .uploadcare-widget-button-open{border: 2px solid #f15b22;}
        .layer{border: 1px solid #3b8686;}
        .uploadcare-widget-button-open,.submit-btn,.filename{text-align: center;}
        .uploadcare-widget-button-open,.submit-btn{text-transform: uppercase;}
        .uploadcare-widget-text,.layer,.layer-title{font-size: 20px;}
        .uploadcare-widget-button-open, .submit-btn{font-weight:bold;}
        .order-title,.filename,.uploadcare-widget-text,.layer,.layer-title{color:#0c153c;}
        
        /* Page style */

       .order-page{margin:0;}
       .form-wraper{margin-bottom: 40px 0px;}
       .order-page,.fixed{border-top: 5px solid #0c153c;}
       header{margin:80px 40px;border-bottom: 1px solid #0c153c;}
        /* Form styles */
        /* File preview column styles */
        .thumb_list_item{padding: 20px;margin:20px 20px 40px 20px;border: 1px solid #3b8686;}
        /* Uploade file name */
        .filename{
            font-size: 18px;
            white-space: pre-wrap; /* css-3 */    
            white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
            white-space: -pre-wrap; /* Opera 4-6 */    
            white-space: -o-pre-wrap; /* Opera 7 */    
            word-wrap: break-word; /* Internet Explorer 5.5+ */
        }
        /* Text before Uploadcare widget text link */
/*        .uploadcare-widget-text:before{content: 'Total uploaded:';margin-right: 10px;}
*/        /* Uploadcare widget button*/
        .uploadcare-widget-button-open{color:#f15b22;}
        .uploadcare-widget-button-open{
            width:200px;
            height:30px;
            padding: 20px 100px;       
            font-size:28px;     
        }
        .thumb_list{min-height: 700px;}
        /*Form Submit button*/
        .submit-btn{
            float:right;
            width:150px;
            height:52px;
            padding:5px;
            border-radius: 10px; 
            font-size:24px;   
            text-align:center;
            color:#fff;
            background: #f15b22;
            opacity: .8;
            border: 1px solid #f15b22;
            }
            p{color: #414141;font-size: 18px;}
            .fixed .submit-btn{
            float:none;}
            .fixed .lp{text-align: right;}
            .fixed .rp{text-align: left;}
        .submit-btn:hover{opacity:1;transition: opacity .9s ease-in-out;}
        .uploadcare-widget-button-open:hover{background: #f15b22; color:#fff;transition: background .2s linear;}
        /* Layur input fields wraper*/
        .layer{width:100px;padding: 5px;border: 1px solid #79bd9a}
        .min-put{width:30px;padding: 5px;border: 1px solid #79bd9a}
        /* Single layer row list */
        .get-layer{ display: block;}
        .get-layer-part,.get-layer li{margin: 10px 0px;text-align: right;}
        /* Single layer row list items */
        .get-layer-part,.main-part{width: 50%;}
        /* Remove deafult list padding */
        ul{padding-left: 0}
        .get-layer li{margin-right: 5px;}
        .layer-name{width: 150px;}/* Layer list item label  */
        .preview-img{margin: 0 auto !important;width:100px;height:100px;}
        .main,.thumb_list{padding:20px 40px;}
        .fixed{position: fixed;bottom: 0;width: 100%;margin:0; background: #f3f6f6;    
          -webkit-animation: fadein .4s; /* Safari, Chrome and Opera > 12.1 */
         -moz-animation: fadein .4s; /* Firefox < 16 */
          -ms-animation: fadein .4s; /* Internet Explorer */
           -o-animation: fadein .4s; /* Opera < 12.1 */
              animation: fadein .4s;
        }
        .top{display:none;position: fixed;bottom: 0;right: 5%;padding:5px 10px;background: #a8dba8;font-size: 18px;color: #fff;}
        .showme{display: block;}
        #submit{display: none;}
        
        @media screen and (max-width: 699px){
          .get-layer-part,.main-part{width: 100%;float: none;}
          .main-part{text-align: left;}
        }
    </style>
</head>
<body class="order-page">
    <header>
      <h1 class="order-title">Metrodesk Order Form </h1>
    </header>

    <div class="form-wraper"><!-- Upload form wraper -->        
            <div class="form-body">
                <form method="POST" action="mailer.php" id="uc_form">
                  <input type="hidden" name="token" value="<?php echo uniqid();?>"><!-- order token id --> 
                 <ul class="main">                    
                    <li class="main-part lp">
                        <div class="upload-area">
                            <input type="hidden" id="uploader" name="uploader" role="uploadcare-uploader" data-multiple="true" data-system-dialog="true" title="Click here to upload your file or Drag and drop your files"><!-- uploadcare wdiget --> 
                        </div>
                    </li>
                    <li class="main-part rp">
                      <input type="submit" id="submit" class="submit-btn" value="SUBMIT"><!-- submit form --> 
                    </li>
                    <div class="clear">
                  </ul>  
                  <ul class="thumb_list">
                      <!-- list uploaded files here --> 
                  </ul>                   
                </form>
            </div>
    </div> 
<a href="#" class="top"> Top </a>

    <!-- end form wraper --> 
</body>
</html>

$(document).ready(function () {
  $('.attribute-croppie-image-wrap').each(function () {
    var $wrap = $(this);
    var $container = $wrap.find('.attribute-croppie-image');

    $uploadCrop = $container.croppie({
      viewport: {
        width: $wrap.data('viewport-width'),
        height: $wrap.data('viewport-height'),
        type: 'square'
      },
      boundary: {
        width: $wrap.data('boundary-width'),
        height: $wrap.data('boundary-height')
      },
      showZoomer: true,
      enableResize: false
    });

    $uploadCrop.on('update.croppie', function (ev, cropData) {
      $wrap.find('.fileSettings').val(JSON.stringify(cropData));
      $uploadCrop.croppie('result', 'base64').then(function (base64) {
        $wrap.find('.fileNameThumbnail').val(base64);
      });
    });

    $wrap.find('.uploadAvatarButton').on('change', function () {
      var input = this;
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $wrap.find('.attribute-croppie-image').removeClass('hidden');
          $wrap.find('.changeAvatarWrapper').addClass('hidden');
          $wrap.find('.uploadAvatar').removeClass('hidden');

          $uploadCrop.croppie('bind', {
            url: e.target.result
          }).then(function () {

          });

          $wrap.find('.originalFileName').val(e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
      else {
        alert("Sorry - you're browser doesn't support the FileReader API");
      }
    });


  });
});
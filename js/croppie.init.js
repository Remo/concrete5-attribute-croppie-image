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

    $wrap.find('.applyAvatar').on('click', function (event) {
      event.preventDefault();

      $uploadCrop.croppie('result', 'base64').then(function (base64) {
        $wrap.find('.attribute-croppie-image').addClass('hidden');
        $wrap.find('.changeAvatarWrapper').removeClass('hidden');
        $wrap.find('.uploadAvatar').addClass('hidden');
        $wrap.find('.applyAvatar').addClass('hidden');
        $wrap.find('.deleteAvatar').removeClass('hidden');
        $wrap.find('.uploadAvatarButtonWrapper').removeClass('hidden');

        $wrap.find('.changeAvatarWrapper img').attr('src', base64);
      });
    });

    $wrap.find('.deleteAvatar').on('click', function (event) {
      event.preventDefault();

      $wrap.find('.deleteAvatar').addClass('hidden');
      $wrap.find('.changeAvatarWrapper img').attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
      $wrap.find('.fileNameThumbnail').val('');
    });

    $wrap.find('.uploadAvatarButton').on('change', function () {
      var input = this;
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $wrap.find('.attribute-croppie-image').removeClass('hidden');
          $wrap.find('.changeAvatarWrapper').addClass('hidden');
          $wrap.find('.uploadAvatar').removeClass('hidden');
          $wrap.find('.applyAvatar').removeClass('hidden');
          $wrap.find('.uploadAvatarButtonWrapper').addClass('hidden');

          $uploadCrop.croppie('bind', {
            url: e.target.result
          }).then(function () {

          });
        };
        reader.readAsDataURL(input.files[0]);
      }
      else {
        alert('Sorry - you\'re browser doesn\'t support the FileReader API');
      }
    });
  });
});
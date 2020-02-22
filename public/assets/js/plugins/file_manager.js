var FileManager = function (context, clickCallback) {
  // you can get current editor's elements from layoutInfo
  var layoutInfo = context.layoutInfo;
  var $editor = layoutInfo.editor;
  var $editable = layoutInfo.editable;
  var $toolbar = layoutInfo.toolbar;

  // ui is a set of renderers to build ui elements.
  var ui = $.summernote.ui;

  // this method will be called when editor is initialized by $('..').summernote();
  // You can attach events and created elements on editor elements(eg, editable, ...).
  this.initialize = function () {
    // create button
    var button = ui.button({
      className: 'file-manager-btn',
      contents: 'File Manager',
      click: function (e) {
        // invoke bold method of a module named editor
        //clickCallback(e);
        return clickCallback(e);
      }
    });

    // generate jQuery element from button instance.
    /*this.$button = button.render();
    $toolbar.append(this.$button);*/

  };

  // this method will be called when editor is destroyed by $('..').summernote('destroy');
  // You should detach events and remove elements on `initialize`.
  this.destroy = function () {
    this.$button.remove();
    this.$button = null;
  }
};

function removeFile(event, fileUrl, rowId) {
  event.preventDefault();

  const confirmAlert = confirm('Do you really want to remove this file?');
  if (confirmAlert) {
    $.ajax({
      type: "POST",
      url: '/admin/upload/files/remove',
      dataType: 'json',
      data: {fileUrl: fileUrl},
      success: function () {
        $('#row-' + rowId).remove();
      }
    });
  }
}

function removeDynamicFile(event) {
  event.preventDefault();
  const confirmAlert = confirm('Do you really want to remove this file?');
  if (confirmAlert) {
    $.ajax({
      type: "POST",
      url: event.target.href,
      dataType: 'json',
      success: function (resp) {
        $(event.target).trigger('file-removed-success',[resp]);
      }
    });
  }
}

function loadAsyncDataHtml(url, storageEl) {
  $.get(url , function( data ) {
    storageEl.html(data);
  });
}

function selectImage(el, image) {
  $(document).trigger("insert-image", [image]);
}

function onFileChange(el, route, holder) {
  if(el.files.length > 0)
  {
    uploadFile(el.files[0], route, $(el));
  }

  $(el).on('success-upload', function(ev, data){
    $(holder).append(data.html)
  });

  $(el).on('failed-upload', function(ev, data){
    if(data.responseJSON)
    {
      $.each(data.responseJSON.errors.file, function (i, err) {
          $(el).parent().next().find('span').text(err);
      })
    }

  })
}


////////BOOKING file manager ///////////

function fileOnChange(ev, id, route) {
  const file = ev.target.files.item(0);
  if(!hasExtension(file, ['application/pdf'])) {
    alert('Only pdf allowed');
    return;
  }
  $(ev.target).on('success-upload', function(ev, data){
    $(id).html(data.html)
  });
  return uploadFile(ev.target.files.item(0), route, $(ev.target));
}

function removeDynamicFileClone(event, id) {
  removeDynamicFile(event);
  $(event.target).on('file-removed-success',function (ev, data) {
    $(id).html(data.html);
  });
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
const elements = function (counter, name) {
        return '<div class="my-card">'+
            `<input type="hidden" name="${name}[${counter}][id]">`+
            '<div class="form-group required ">'+
            `<span style="color: #3097d1; cursor: pointer" data-data="${name}" data-id="${counter}" onclick="removeReviewSection(this)" class="pull-right"><i class="glyphicon glyphicon-remove"></i></span>`+
            '<label for="exampleInputName">Title</label>'+
            `<input type="text" name="${name}[${counter}][name]" class="form-control" required>`+
            '</div>'+
            '<div class="form-group required">'+
            '<label>Body</label>'+
            `<textarea id="${name}_${counter}" type="text" name="${name}[${counter}][body]" class="form-control"></textarea>`+
            '</div>'+
            '<div class="form-group">'+
            '<label>Link</label>'+
            `<input class="form-control" type="text" name="${name}[${counter}][url]">`+
            '</div>'+
            '<div class="form-group required">'+
            '<label>Attachment</label>'+
            `<input type="file" name="${name}[${counter}][attachments]" class="form-control-file" />`+
            '</div>'+
            '</div>'+
            '<br>';
};
const elementsVideo = function (counter, name) {
    return '<div class="my-card">'+
        `<input type="hidden" name="${name}[${counter}][id]">`+
        '<div class="form-group required ">'+
        `<span style="color: #3097d1; cursor: pointer" data-data="${name}" data-id="${counter}" onclick="removeReviewSection(this)" class="pull-right"><i class="glyphicon glyphicon-remove"></i></span>`+
        '<label for="exampleInputName">URL</label>'+
        `<input type="text" name="${name}[${counter}][url]" class="form-control" required>`+
        '</div>'+
        '<div class="form-check form-check-inline">'+
        `<input id="video-top" type="radio" value="top" name="${name}[${counter}][position]" class="form-check-input" />`+
        '<label for="video-top" class="form-check-label"> Position Top</label>'+
        '</div>'+
        '<div class="form-check form-check-inline">'+
        `<input id="video-bottom" type="radio" value="bottom" name="${name}[${counter}][position]" class="form-check-input" />`+
        '<label for="video-bottom" class="form-check-label"> Position Bottom</label>'+
        '</div>'+
        '</div>'+
        '<br>';
};
function resetForm(url) {
    window.location.href = url;
}
function addSection(sectionType, has_summernote = true) {

    const section = document.createElement('div');
    section.className           = 'col-md-12';

    let div     = {};
    let inputs  = {};
    switch (sectionType) {
        case "inline_blocks":
            div                 = document.getElementById('inline-block-div');
            inputs              = div.querySelectorAll('input[type=text]');
            section.innerHTML   = elements(inputs.length, sectionType);
            break;
        case "videos":
            div                 = document.getElementById('video-div');
            inputs              = div.querySelectorAll('input[type=text]');
            section.innerHTML   = elementsVideo(inputs.length, sectionType);
            break;
        default:
            console.warn('No section type provided');
    }
    section.dataset.counter     = `${inputs.length}`;
    div.appendChild(section);

    if (has_summernote) {
        const editor = $(`#${sectionType}_${inputs.length}`);
        editor.summernote({
            height: 200,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Carlito'],
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize', 'fontname']],
                ['insert', ['picture', 'link', 'video']],
                ['table', ['table']],
                ['color', ['forecolor', 'backcolor']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['fullscreen', ['fullscreen', 'codeview']],
            ]
        });
    }
}

function removeReviewSection(element) {
    let row = {};
    if (element.dataset.data === 'inline_blocks') {
        row = document.getElementById('inline-block-div');
    } else if (element.dataset.data === 'videos') {
        row = document.getElementById('video-div');
    }
    if (row.contains(element)) {
        const col = row.querySelector(`[data-counter*='${element.dataset.id}']`);
        col.remove();
    }
}

function removeFile(element) {
    const request = $.ajax({
        type: "DELETE",
        url: element.dataset.delete_url,
        dataType: 'json'
    });
    request.done(function () {
        window.location.reload();
    });
    request.fail(function (jqXHR, resp) {
        alert("Request failed: " + resp.message);
    });
}

function changeParent(element) {
    console.log(element)
}

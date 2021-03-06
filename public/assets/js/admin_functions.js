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
            '<label for="exampleInputName">Ключевое слово</label>'+
            `<input type="text" name="${name}[${counter}][name]" class="form-control" required>`+
            '</div>'+
            '<div class="form-group required">'+
            '<label>Контент</label>'+
            `<textarea id="${name}_${counter}" type="text" name="${name}[${counter}][body]" class="form-control"></textarea>`+
            '</div>'+
            '<div class="form-group required">'+
            '<label>Фотография</label>'+
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
        '<label for="exampleInputName">Cсылка</label>'+
        `<input type="text" name="${name}[${counter}][url]" class="form-control" required>`+
        '</div>'+
        '<div class="form-group">'+
        '<label>Опциональный контент</label>'+
        `<input type="text" name="${name}[${counter}][header]" class="form-control">`+
        '</div>'+
        '<div class="form-check form-check-inline">'+
        `<input type="radio" value="top" name="${name}[${counter}][position]" class="form-check-input" />`+
        '<label class="form-check-label"> Положение «С верху»</label>'+
        '</div>'+
        '<div class="form-check form-check-inline">'+
        `<input type="radio" value="bottom" name="${name}[${counter}][position]" class="form-check-input" />`+
        '<label class="form-check-label"> Положение «С Низу»</label>'+
        '</div>'+
        '</div>'+
        '<br>';
};
const elementsOurWorksVideo = function (counter, name) {
    return '<div class="my-card">'+
        `<input type="hidden" name="${name}[${counter}][id]">`+
        '<div class="form-group required ">'+
        `<span style="color: #3097d1; cursor: pointer" data-data="${name}" data-id="${counter}" onclick="removeReviewSection(this)" class="pull-right"><i class="glyphicon glyphicon-remove"></i></span>`+
        '<label for="exampleInputName">Cсылка</label>'+
        `<input type="text" name="${name}[${counter}][url]" class="form-control" required>`+
        '</div>'+
        '<div class="form-group">'+
        '<label>Опциональный контент</label>'+
        `<select type="text" name="${name}[${counter}][header]" class="form-control">`+
        `<option value="Сип панели">Сип панели</option>`+
        `<option value="Отзывы клиентов">Отзывы клиентов</option>`+
        `</select>`+
        `</div>`+
        '<div class="form-check form-check-inline">'+
        `<input type="radio" value="top" name="${name}[${counter}][position]" class="form-check-input" />`+
        '<label class="form-check-label"> Положение «С верху»</label>'+
        '</div>'+
        '<div class="form-check form-check-inline">'+
        `<input type="radio" value="bottom" name="${name}[${counter}][position]" class="form-check-input" />`+
        '<label class="form-check-label"> Положение «С Низу»</label>'+
        '</div>'+
        '</div>'+
        '<br>';
};
function resetForm(url) {
    window.location.href = url;
}
function addSection(sectionType, has_summernote = true, is_our_works = false) {

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
            section.innerHTML   = is_our_works ? elementsOurWorksVideo(inputs.length, sectionType) : elementsVideo(inputs.length, sectionType);
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
            focus: false,
            fontNames: ['Arial', 'Open Sans', 'Raleway'],
            fontSizes: ['8', '9', '10', '11', '12', '13', '14', '15', '16', '17' , '18', '18', '20', '21', '22', '24', '26', '28', '30', '34', '38'],
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize', 'fontname']],
                ['insert', ['picture', 'link', 'video']],
                ['color', ['color']],
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
        console.log('Done!');
        window.location.reload();
    });
    request.fail(function (jqXHR, resp) {
        alert("Request failed: " + resp.message);
    });
}

function deleteItem(event, el, entity, skipReload, isRestore) {
    event.preventDefault();
    const messagePrefix = isRestore ? 'restore back' : 'remove';
    const confirmAlert = confirm('Do you really want to ' + messagePrefix + ' this ' + entity);
    if (confirmAlert) {
        console.log($(el).attr('href'));
        $.ajax({
            type: "DELETE",
            url: $(el).attr('href'),
            dataType: 'json',
            success: function (resp) {
                alert(resp.message);
                location.reload();
            },
            error: function (error) {
                console.warn(error);
            }
        });
    }
}
$( function() {
    $('.ui-helper-hidden-accessible').remove();
    let from = '';
    let to = '';
    let from_position = '';
    let to_position = '';
    $( ".connectedSortable" ).sortable({
        start: function (event, ui) {
            from_position = ui.item.index();
            from = event.target.id;
        },
        update: function (event, ui) {
            to_position = ui.item.index();
            to = event.target.id;
        },
        stop: function (event, ui) {
            let li = $(ui.item[0].parentElement.children);
            let data = [];
            for (let i = 0; i < li.length; i++) {
                let to_push = {
                    index: i,
                    id: li[i].id
                };
                data.push(to_push)
            }
            $.ajax({
                url: `${event.target.dataset.url}`,
                type: 'post',
                data: {data: data, from: from, to: to, from_position: from_position, to_position: to_position, id: ui.item[0].id},
                async: true,
                success: function (response) {

                }
            });
        },
        connectWith: ".connectedSortable"
    }).disableSelection();
});

function changeAttachmentPosition(url, element) {
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        data: {value: element.value},
        success: function (resp) {

        },
        error: function (error) {
            console.warn(error);
        }
    });
}



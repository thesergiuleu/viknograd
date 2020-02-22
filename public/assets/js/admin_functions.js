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
            `<input type="text" name="${name}[${counter}][title]" class="form-control" required>`+
            '</div>'+
            '<div class="form-group required">'+
            '<label>Body</label>'+
            `<textarea type="text" name="${name}[${counter}][body]" class="form-control"></textarea>`+
            '</div>'+
            '</div>'+
            '<br>';
};
function resetForm(url) {
    window.location.href = url;
}
function addReviewSection(sectionType) {

    const section = document.createElement('div');
    section.className           = 'col-md-12';

    let div     = {};
    let inputs  = {};
    switch (sectionType) {
        case "proofs":
            div                 = document.getElementById('proof-div');
            inputs              = div.querySelectorAll('input[type=text]');
            section.innerHTML   = elements(inputs.length, 'proofs');
            break;
        case "naratives":
            div                 = document.getElementById('narative-div');
            inputs              = div.querySelectorAll('input[type=text]');
            section.innerHTML   = elements(inputs.length, 'naratives');
            break;
        default:
            console.warn('No section type provided');
    }
    section.dataset.counter     = `${inputs.length}`;
    div.appendChild(section);
}

function removeReviewSection(element) {
    let row = {};
    if (element.dataset.data === 'proofs') {
        row = document.getElementById('proof-div');
    } else if (element.dataset.data === 'naratives') {
        row = document.getElementById('narative-div')
    }
    if (row.contains(element)) {
        const col = row.querySelector(`[data-counter*='${element.dataset.id}']`);
        col.remove();
    }
}

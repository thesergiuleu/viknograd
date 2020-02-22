<div class="modal fade" id="{{$modalId}}" tabindex="-1" role="dialog" aria-labelledby="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">{{$modalTitle}}</h4>
            </div>
            <div class="modal-body">
                <div id="modal-wrapper">
                    @include($view, $options);
                </div>
            </div>
        </div>
    </div>
</div>


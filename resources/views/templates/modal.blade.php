<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Task Editor</h4>
            </div>
            <div class="modal-body">

                @yield('modal-body')

            </div>
            <div class="modal-footer">

                @yield('modal-footer')

            </div>
        </div>
    </div>
</div>